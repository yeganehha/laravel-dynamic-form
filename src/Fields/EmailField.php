<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class EmailField extends Field
{

    public function adminName(): string
    {
        return trans('fields.email');
    }

    public function adminIconHtml(): string|null
    {
        return '
        <svg width="20px" height="20px" viewBox="0 0 20 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-102.000000, -1217.000000)">
                    <g transform="translate(100.000000, 1162.000000)">
                        <g transform="translate(0.000000, 54.000000)">
                            <g>
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M12,1.95 C6.48,1.95 2,6.43 2,11.95 C2,17.47 6.48,21.95 12,21.95 L17,21.95 L17,19.95 L12,19.95 C7.66,19.95 4,16.29 4,11.95 C4,7.61 7.66,3.95 12,3.95 C16.34,3.95 20,7.61 20,11.95 L20,13.38 C20,14.17 19.29,14.95 18.5,14.95 C17.71,14.95 17,14.17 17,13.38 L17,11.95 C17,9.19 14.76,6.95 12,6.95 C9.24,6.95 7,9.19 7,11.95 C7,14.71 9.24,16.95 12,16.95 C13.38,16.95 14.64,16.39 15.54,15.48 C16.19,16.37 17.31,16.95 18.5,16.95 C20.47,16.95 22,15.35 22,13.38 L22,11.95 C22,6.43 17.52,1.95 12,1.95 Z M12,14.95 C10.34,14.95 9,13.61 9,11.95 C9,10.29 10.34,8.95 12,8.95 C13.66,8.95 15,10.29 15,11.95 C15,13.61 13.66,14.95 12,14.95 Z" fill="#1D1D1D"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
        ';
    }

    public function field(string $name, string|null $value = null, string|null $class = null, string|null $style = null, array $attributes = [], mixed $additional_data = null): string
    {
        return Blade::render(
            '<input type="email" wire:model.lazy="{{ $name }}" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
