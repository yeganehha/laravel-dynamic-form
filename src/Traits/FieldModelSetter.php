<?php


namespace Yeganehha\DynamicForm\Traits;


use Yeganehha\DynamicForm\Models\Field;

trait FieldModelSetter
{
    /**
     * @return Field
     */
    public static function init(): Field
    {
        return new Field();
    }

    /**
     * @param int $form_id
     * @return Field
     */
    public function setFormId(int $form_id): Field
    {
        $this->form_id = $form_id;
        return $this;
    }

    /**
     * @param string $label
     * @return Field
     */
    public function setLabel(string $label): Field
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string $description
     * @return Field
     */
    public function setDescription(string $description): Field
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $font_icon
     * @return Field
     */
    public function setFontIcon(string $font_icon): Field
    {
        $this->font_icon = $font_icon;
        return $this;
    }

    /**
     * @param mixed $value
     * @return Field
     */
    public function setValue(mixed $value): Field
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param mixed $validate
     * @return Field
     */
    public function setValidate(mixed $validate): Field
    {
        $this->validate = $validate;
        return $this;
    }

    /**
     * @param string $type_variable
     * @return Field
     */
    public function setTypeVariable(string $type_variable): Field
    {
        $this->type_variable = $type_variable;
        return $this;
    }

    /**
     * @param string $status
     * @return Field
     */
    public function setStatus(string $status): Field
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param int $order_number
     * @return Field
     */
    public function setOrderNumber(int $order_number): Field
    {
        $this->order_number = $order_number;
        return $this;
    }

    /**
     * @param string $class
     * @return Field
     */
    public function setClass(string $class): Field
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @param string $style
     * @return Field
     */
    public function setStyle(string $style): Field
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @param mixed $field_attributes
     * @return Field
     */
    public function setFieldAttributes(mixed $field_attributes): Field
    {
        $this->field_attributes = $field_attributes;
        return $this;
    }

    /**
     * @param mixed $additional_data
     * @return Field
     */
    public function setAdditionalData(mixed $additional_data): Field
    {
        $this->additional_data = $additional_data;
        return $this;
    }

    /**
     * @param int $parent_id
     * @return Field
     */
    public function setParentId(int $parent_id): Field
    {
        $this->parent_id = $parent_id;
        return $this;
    }

}
