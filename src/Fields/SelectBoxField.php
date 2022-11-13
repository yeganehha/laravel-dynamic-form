<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;
use Yeganehha\DynamicForm\Exceptions\ArrayValuesOfSelectBoxAreMissing;

class SelectBoxField extends Field
{

    public function AdminMenuName(): string
    {
        return trans('fields.select');
    }

    /**
     * @throws ArrayValuesOfSelectBoxAreMissing
     */
    public function field(string $name, mixed $value = null, mixed $default_values = null, string $class = null, string $style = null, array $attributes): string
    {
        if( ! is_array($default_values) )
            throw new ArrayValuesOfSelectBoxAreMissing();
        return Blade::render(
            '<select name="{{ $name }}" @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />'.
            '@foreach($default_values as $default_value => $label) <option value="{{ $default_value }}" @if( $default_value == $value ) selected @endif>{{ $label }}</option>'.
            '</select>',
            compact('name', 'value' ,'class' ,'style' ,'attributes' , 'default_values')
        );
    }

    public function value(mixed $value = null): string
    {
        return (string) $value ?? "-";
    }
}
