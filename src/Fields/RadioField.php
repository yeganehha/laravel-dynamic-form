<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class RadioField extends Field
{

    public function adminName(): string
    {
        return trans('fields.radio');
    }

    public function adminIconHtml(): string|null
    {
        return '
            <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-340.000000, -4322.000000)">
                        <g transform="translate(100.000000, 4266.000000)">
                            <g transform="translate(238.000000, 54.000000)">
                                <g>
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path d="M12,2 C17.52,2 22,6.48 22,12 C22,17.52 17.52,22 12,22 C6.48,22 2,17.52 2,12 C2,6.48 6.48,2 12,2 Z M12,20 C16.42,20 20,16.42 20,12 C20,7.58 16.42,4 12,4 C7.58,4 4,7.58 4,12 C4,16.42 7.58,20 12,20 Z M12,17 C9.23857625,17 7,14.7614237 7,12 C7,9.23857625 9.23857625,7 12,7 C14.7614237,7 17,9.23857625 17,12 C17,14.7614237 14.7614237,17 12,17 Z" fill="#1D1D1D"></path>
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
            '<input type="radio" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($value == $value ) checked @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
