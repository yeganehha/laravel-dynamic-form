<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class TextareaField extends Field
{

    public function adminName(): string
    {
        return trans('fields.textarea');
    }

    public function adminIconHtml(): string|null
    {
        return '
        <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-380.000000, -5199.000000)" fill="#000000">
                    <g  transform="translate(56.000000, 160.000000)">
                        <path d="M334,5049 L330,5049 C325,5049 325,5041 330,5041 L334,5041 L334,5049 Z M330,5039 C322,5039 322,5051 330,5051 L334,5051 L334,5059 L336,5059 L336,5041 L338,5041 L338,5059 L340,5059 L340,5041 L344,5041 L344,5039 L330,5039 Z"></path>
                    </g>
                </g>
            </g>
        </svg>
        ';
    }

    public function field(string $name, string|null $value = null, string|null $class = null, string|null $style = null, array $attributes = [], mixed $additional_data = null): string
    {
        return Blade::render(
            '<textarea wire:model="{{ $name }}" name="{{ $name }}" @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach >@if($value){{ $value }}@endif</textarea>',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
