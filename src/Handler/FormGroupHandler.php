<?php


namespace Yeganehha\DynamicForm\Handler;


use Yeganehha\DynamicForm\Models\Field;

class FormGroupHandler
{
    public $fields = [];

    /**
     * add new field.
     * @param Field $field field information.
     * @param string $uniqueName key attribute.
     * @return $this
     */
    public function add(string $uniqueName , Field $field) : self
    {
        $this->fields[$uniqueName] = $field;
        return $this;
    }

    public function getFields():array
    {
        return $this->fields;
    }
}
