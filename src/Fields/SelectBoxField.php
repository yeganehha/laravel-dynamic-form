<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;
use Yeganehha\DynamicForm\Exceptions\ArrayValuesOfSelectBoxAreMissing;

class SelectBoxField extends Field
{

    public function adminName(): string
    {
        return trans('fields.select');
    }

    /**
     * @throws ArrayValuesOfSelectBoxAreMissing
     */
    public function field(string $name, string $value = null, string $class = null, string $style = null, array $attributes, mixed $additional_data): string
    {
        if( ! is_array($value) )
            throw new ArrayValuesOfSelectBoxAreMissing();
        return Blade::render(
            '<select name="{{ $name }}" @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />'.
            '@foreach($value as $value => $label) <option value="{{ $value }}" @if( $value == $value ) selected @endif>{{ $label }}</option>'.
            '</select>',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
