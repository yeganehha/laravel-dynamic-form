<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;
use Yeganehha\DynamicForm\DefineProperty;

class DividerField extends Field
{

    public $styleField = true ;

    public function AdminMenuName(): string
    {
        return trans('fields.divider');
    }

    public function field(string $name, string $value = null, string $class = null, string $style = null, array $attributes, mixed $additional_data): string
    {
        if ( config(DefineProperty::$configFile.'.style.divider.use_hr_tag' , false ) )
            return Blade::render(
                '<hr @if($class) class="{{ $class }}" @else class="{{ config(\Yeganehha\DynamicForm\DefineProperty::$configFile.\'.style.divider.class\' , \'row\') }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
                compact('class' ,'style' ,'attributes' , 'value')
            );
        return Blade::render(
            '<div @if($class) class="{{ $class }}" @else class="{{ config(\Yeganehha\DynamicForm\DefineProperty::$configFile.\'.style.divider.class\' , \'row\') }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach ></div>',
            compact('class' ,'style' ,'attributes' , 'value')
        );
    }

    public function value(mixed $value = null): ?string
    {
        return null;
    }
}
