<?php

namespace Yeganehha\DynamicForm\Abstracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Fields\TextField;
use Yeganehha\DynamicForm\Models\Field as FieldModel;
use Yeganehha\DynamicForm\Handler\FormGroupHandler;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;
use Yeganehha\DynamicForm\Enums\FieldStatusEnum;

abstract class Field implements FieldInterface,Arrayable
{
    /**
     * Is it responsible for sorting and formatting the form?
     * @var bool
     */
    public $styleField = false;

    /**
     * Does this field contain a group of fields?
     * @var bool
     */
    public $hasChildField = false;

    /**
     * Can this field be duplicated and repeated?
     * @var bool
     */
    public $canMakeDuplicate = false;

    public function field(string $name, string $value = null, string $class = null, string $style = null, array $attributes, mixed $additional_data): string
    {
        return Blade::render(
            '<input type="text" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }

    protected function baseConfigFields(FormGroupHandler $form) : void
    {}

    public function getBaseConfigFields(FormGroupHandler $form): void
    {
        $form->add('label', FieldModel::init()
            ->setLabel(trans('field.label'))
            ->setValidate(['required' , 'string' , 'max:500'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Required)
            ->setClass('')
        );
        $form->add('description' , FieldModel::init()
            ->setLabel(trans('field.description'))
            ->setValidate(['nullable' , 'string'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Show)
            ->setClass('')
        );
        $form->add('value' , FieldModel::init()
            ->setLabel(trans('field.default_value'))
            ->setValidate(['nullable' , 'string'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Show)
            ->setClass('')
        );
        $this->baseConfigFields($form);
    }

    protected function baseStyleFields(FormGroupHandler $form) : void
    {}

    public function getBaseStyleFields(FormGroupHandler $form): void
    {
        $form->add('class' , FieldModel::init()
            ->setLabel(trans('field.class_css'))
            ->setValidate(['required' , 'string' , 'max:500'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Show)
            ->setClass('')
        );
        $form->add('style' , FieldModel::init()
            ->setLabel(trans('field.style'))
            ->setValidate(['nullable' , 'string' , 'max:500'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Show)
            ->setClass('')
        );
        $form->add('font_icon' , FieldModel::init()
            ->setLabel(trans('field.font_icon'))
            ->setValidate(['nullable' , 'string' , 'max:500'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Show)
            ->setClass('')
        );
        $this->baseStyleFields($form);
    }

    protected function baseAdvanceFields(FormGroupHandler $form) : void
    {}

    public function getBaseAdvanceFields(FormGroupHandler $form): void
    {
        $form->add('validate' , FieldModel::init()
            ->setLabel(trans('field.validate'))
            ->setValidate(['nullable' , 'string' , 'max:500'])
            ->setTypeVariable(TextField::class)
            ->setStatus(FieldStatusEnum::Show)
            ->setClass('')
        );
        $this->baseAdvanceFields($form);
    }

    public function getClass(): string
    {
        return str_replace('\\' , '\\\\' , get_class($this));
    }

    public function toArray() :array
    {
        return [
            'styleField' => $this->styleField,
            'hasChildField' => $this->hasChildField,
            'canMakeDuplicate' => $this->canMakeDuplicate,
            'class' => $this->getClass(),
            'admin' => [
                'name' => $this->adminName(),
            ]
        ];
    }
}
