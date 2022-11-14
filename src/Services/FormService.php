<?php

namespace Yeganehha\DynamicForm\Services;

use Psy\Exception\FatalErrorException;
use Yeganehha\DynamicForm\Events\Form\registeringNewFormEvent;
use Yeganehha\DynamicForm\Events\Form\registerNewFormEvent;
use Yeganehha\DynamicForm\Exceptions\FormNameRepeated;
use Yeganehha\DynamicForm\Models\Form;

class FormService
{
    /**
     * Check form exist or not.
     *
     * @param string $formName
     * @param string|object $model
     * @return bool
     * @throws FatalErrorException
     */
    public static function formExist(string $formName, $model) : bool
    {
        $model = self::getModalAsString($model);
        $formObject = Form::find($formName, $model);
        if ( $formObject )
            return true;
        return false;
    }

    /**
     * Register new form for model.
     *
     * @param string $formName
     * @param string|object $model
     * @return Form
     * @throws FormNameRepeated|\Throwable
     */
    public static function registerForm(string $formName, $model ) : Form
    {
        event(new registeringNewFormEvent($formName , $model , false));
        $modelName = self::getModalAsString(registeringNewFormEvent::getModel());

        $formExist = self::formExist(registeringNewFormEvent::getName() , $modelName);
        if ( $formExist )
            throw new FormNameRepeated();

        $form = Form::insert(registeringNewFormEvent::getName() , $modelName , false);
        event(new registerNewFormEvent($form , $model));
        return registerNewFormEvent::getForm();
    }

    /**
     * get Form by name and model.
     * @param string $formName
     * @param string|object $model
     * @return Form|null
     * @throws FatalErrorException
     */
    public static function find(string $formName, $model ) : ?Form
    {
        $model = self::getModalAsString($model);
        return Form::find($formName, $model);
    }


    /**
     * Find Form and if not exist, generate new form.
     * @param string $formName
     * @param string|object $model
     * @return Form
     * @throws FormNameRepeated | \Throwable
     */
    public static function findOrRegister(string $formName, $model ) : Form
    {
        $form = self::find($formName,$model);
        if ( $form == null )
            $form = self::registerForm($formName,$model);
        return $form;
    }


    private static function getModalAsString($model):string
    {
        $model = is_object($model) ? get_class($model) : $model;
        if ( ! class_exists($model))
            throw new FatalErrorException(\sprintf('Class \'%s\' not found', $model));
        return $model;
    }
}
