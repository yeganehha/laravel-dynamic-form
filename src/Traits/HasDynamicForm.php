<?php

namespace Yeganehha\DynamicForm\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Psy\Exception\FatalErrorException;
use Yeganehha\DynamicForm\Exceptions\FormNameRepeated;
use Yeganehha\DynamicForm\Models\Form;
use Yeganehha\DynamicForm\Services\FormService;

trait HasDynamicForm
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     * @throws FatalErrorException
     * @throws \Throwable
     */
    public static function bootHasDynamicForm(): void
    {
        static::deleting(function (Model $model) {
            /* @var HasDynamicForm $model */
            return $model->deleteForm();
        });
    }

    /**
     * Initialize the soft deleting trait for an instance.
     *
     * @return void
     */
    public function initializeHasDynamicForm()
    {
    }

    /**
     * return special model's form or Generate new model's form
     *
     * @param string $name Name Of Form (support string)
     * @return Form
     * @throws FormNameRepeated | \Throwable
     */
    public static function form(string $name) : Form
    {
        return FormService::findOrRegister($name , self::class);
    }

    /**
     * return all form of model
     *
     * @return Collection
     * @throws FatalErrorException
     */
    public static function allForm(): Collection
    {
        return FormService::getModelForms( self::class);
    }

    /**
     * return special model's form exist or not
     *
     * @param string $name Name Of Form (support string)
     * @return bool
     * @throws \Throwable
     */
    public static function formExist($name) : bool
    {
        return FormService::formExist($name , self::class);
    }

    /**
     * delete special model's form
     *
     * @param ?string $name Name Of Form (support string); In case of null, delete all forms!
     * @throws FatalErrorException
     * @throws \Throwable
     */
    public static function deleteForm(string $name = null) : self
    {
        if ( $name )
            FormService::delete($name , self::class);
        else
            FormService::deleteAll(self::class);
        return new static();
    }
}
