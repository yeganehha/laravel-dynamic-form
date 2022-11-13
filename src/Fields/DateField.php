<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class DateField extends Field
{

    public function AdminMenuName(): string
    {
        return trans('fields.date');
    }

    public function field(string $name, mixed $value = null, mixed $default_values = null, string $class = null, string $style = null, array $attributes): string
    {
        return Blade::render(
            '<input type="date" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name', 'value' ,'class' ,'style' ,'attributes' , 'default_values')
        );
    }

    public function value(mixed $value = null): string
    {
        return (string) $value ?? "-";
    }
}
