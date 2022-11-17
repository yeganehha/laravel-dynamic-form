<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class TextareaField extends Field
{

    public function AdminMenuName(): string
    {
        return trans('fields.textarea');
    }

    public function field(string $name, string $value = null, string $class = null, string $style = null, array $attributes, mixed $additional_data): string
    {
        return Blade::render(
            '<textarea name="{{ $name }}" @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach >@if($value){{ $value }}@endif</textarea>',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
