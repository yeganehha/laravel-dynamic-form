<?php

namespace Yeganehha\DynamicForm\Traits;

use Yeganehha\DynamicForm\Exceptions\FormNameRepeated;
use Yeganehha\DynamicForm\Exceptions\NameOfFormCanNotBeNull;
use Yeganehha\DynamicForm\Models\Form;
use Yeganehha\DynamicForm\Services\FormService;

trait HasDynamicForm
{
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootHasDynamicForm()
    {
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
    public function form($name) : Form
    {
        return FormService::findOrRegister($name , self::class);
    }

    /**
     * return special model's form exist or not
     *
     * @param string $name Name Of Form (support string)
     * @return bool
     * @throws \Throwable
     */
    public function formExist($name) : bool
    {
        return FormService::formExist($name , self::class);
    }
}
