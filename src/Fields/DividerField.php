<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;
use Yeganehha\DynamicForm\DefineProperty;

class DividerField extends Field
{

    public $styleField = true ;

    public function adminName(): string
    {
        return trans('fields.divider');
    }


    public function adminIconHtml(): string|null
    {
        return '
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 12H3.01M7.5 12H7.51M16.5 12H16.51M12 12H12.01M21 12H21.01M21 21V20.2C21 19.0799 21 18.5198 20.782 18.092C20.5903 17.7157 20.2843 17.4097 19.908 17.218C19.4802 17 18.9201 17 17.8 17H6.2C5.0799 17 4.51984 17 4.09202 17.218C3.7157 17.4097 3.40973 17.7157 3.21799 18.092C3 18.5198 3 19.0799 3 20.2V21M21 3V3.8C21 4.9201 21 5.48016 20.782 5.90798C20.5903 6.28431 20.2843 6.59027 19.908 6.78201C19.4802 7 18.9201 7 17.8 7H6.2C5.0799 7 4.51984 7 4.09202 6.78201C3.71569 6.59027 3.40973 6.28431 3.21799 5.90798C3 5.48016 3 4.92011 3 3.8V3" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        ';
    }

    public function field(string $name, string|null $value = null, string|null $class = null, string|null $style = null, array $attributes = [], mixed $additional_data = null): string
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
