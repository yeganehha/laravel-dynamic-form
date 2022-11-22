<?php

namespace Yeganehha\DynamicForm\Services;

use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Psy\Exception\FatalErrorException;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Enums\FieldStatusEnum;
use Yeganehha\DynamicForm\Exceptions\FieldNotFoundException;
use Yeganehha\DynamicForm\Exceptions\FildTypeNotFoundException;
use Yeganehha\DynamicForm\Exceptions\FormNotFoundException;
use Yeganehha\DynamicForm\Exceptions\UnknownFieldLoaded;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;
use Yeganehha\DynamicForm\Models\Field;
use Yeganehha\DynamicForm\Models\Form;

class FieldService
{
    /**
     * get list of all field types
     * @return Collection
     * @throws UnknownFieldLoaded
     */
    public static function getAllTypes():collection
    {
        $fields = [];
        foreach ( config(DefineProperty::$configFile.'.fields' , [] ) as $item) {
            if (class_exists($item) and is_subclass_of($item, FieldInterface::class))
                $fields[] = new $item();
            else
                throw new UnknownFieldLoaded();
        }
        return collect($fields);
    }

    /**
     * Create new form.
     * @param Form|int|array|object $form
     * @param FieldInterface|string $type_variable
     * @param string|null $label
     * @param Field|int|null $parent
     * @param FieldStatusEnum $status
     * @param ?string $description
     * @param mixed|null $value
     * @param string|null $font_icon
     * @param mixed|null $validate
     * @param int|null $order_number
     * @param string|null $class
     * @param string|null $style
     * @param mixed|null $field_attributes
     * @param mixed|null $additional_data
     * @return Field
     * @throws FatalErrorException
     * @throws \Throwable
     */
    public static function insert(mixed $form, mixed $type_variable,string $label = null ,  mixed $parent = null, FieldStatusEnum $status = FieldStatusEnum::Show, string $description = null, mixed $value = null, string $font_icon = null, mixed $validate = null, int $order_number = null , string $class = null, string $style = null, mixed $field_attributes = null, mixed $additional_data = null) : Field
    {
        if (is_int($form)){
            $form = FormService::findById($form);
        } elseif (is_array($form)) {
            if ( isset($form['id']) ){
                $form = FormService::findById($form['id']);
            } elseif( isset($form['name'] , $form['model']) ){
                $form = FormService::find($form['name'] ,$form['model'] );
            } elseif (isset($form[0]) and count($form) == 1){
                $form = FormService::findById($form[0]);
            } elseif (isset($form[0] , $form[1]) and count($form) == 2){
                $form = FormService::find($form[0] ,$form[1] );
            } else {
                throw new FormNotFoundException();
            }
        }
        elseif (is_object($form)) {
            if ( ! $form instanceof Form and isset($form->id) ){
                $form = FormService::findById($form->id);
            } elseif(! $form instanceof Form and isset($form->name , $form->model) ){
                $form = FormService::find($form->name , $form->model);
            } elseif(! $form instanceof Form) {
                throw new FormNotFoundException();
            }
        }


        if ( is_string($type_variable) and class_exists($type_variable) and is_subclass_of($type_variable, FieldInterface::class) ){
            $type_variable = new $type_variable();
        }
        elseif ( ! $type_variable instanceof FieldInterface )
            throw (new FildTypeNotFoundException())->setModel($type_variable);

        if ( is_int($parent) ){
            $parent = self::findById($parent);
        }
        elseif ( ! is_null($parent) and ! $parent instanceof Field  ){
            throw new FieldNotFoundException();
        }
        if ( is_null($label))
            $label = $type_variable->adminName();
        return Field::insert($form, $label, $type_variable, $parent , $status, $description, $value , $font_icon, $validate, $order_number, $class, $style, $field_attributes, $additional_data);
    }


    /**
     * Find special field by id
     * @param int $id
     * @return Field|null
     */
    public static function findById(int $id) : ?Field
    {
        return Field::findById($id);
    }


    /**
     * @param int|Field $field
     * @param int $order
     * @return Field
     */
    public static function updateOrder(mixed $field , int $order): Field
    {
        if ( is_int($field) ){
            $field = Field::findById($field);
        }
        elseif ( ! is_null($field) and ! $field instanceof Field  ){
            throw new FieldNotFoundException();
        }
        $field->updateOrder($order);
        return $field;
    }

    /**
     * @param array $sortingInformation array of all fields order => [ int $field_id, int $order]
     * @return bool|null
     */
    public static function updateAllFields(array $sortingInformation ): ?bool
    {
        DB::beginTransaction();
        foreach ($sortingInformation as $field)
            self::updateOrder((int)$field[0], (int)$field[1]);
        DB::commit();
        return true;
    }
}
