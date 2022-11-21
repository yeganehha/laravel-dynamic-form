<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class UrlField extends Field
{

    public function adminName(): string
    {
        return trans('fields.url');
    }

    public function field(string $name, string $value = null, string $class = null, string $style = null, array $attributes, mixed $additional_data): string
    {
        return Blade::render(
            '<input type="url" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
