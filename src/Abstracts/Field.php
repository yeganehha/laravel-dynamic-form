<?php

namespace Yeganehha\DynamicForm\Abstracts;

use Illuminate\Support\Facades\Blade;

abstract class Field implements \Yeganehha\DynamicForm\Interfaces\FieldInterface
{

    public function field(string $name, mixed $value = null, array $default_values = [], string $class = null, string $style = null, array $attributes): string
    {
        return Blade::render(
            '<input type="text" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name', 'value' ,'class' ,'style' ,'attributes' , 'default_values')
        );
    }

    public function value(mixed $value = null): string
    {
        return (string) $value ?? "-";
    }
}
