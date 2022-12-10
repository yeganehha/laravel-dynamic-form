<?php

namespace Yeganehha\DynamicForm\Fields;

use Illuminate\Support\Facades\Blade;
use Yeganehha\DynamicForm\Abstracts\Field;

class DateField extends Field
{

    public function adminName(): string
    {
        return trans('fields.date');
    }

    public function adminIconHtml(): string|null
    {
        return '
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"  viewBox="0 0 24 24"><defs><style>.cls-1{fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><title>68.calendar</title><g id="_68.calendar" data-name="68.calendar"><rect class="cls-1" x="1" y="3" width="22" height="20" rx="3" ry="3"/><line class="cls-1" x1="1" y1="9" x2="23" y2="9"/><line class="cls-1" x1="12" y1="5" x2="12" y2="1"/><line class="cls-1" x1="6" y1="5" x2="6" y2="1"/><line class="cls-1" x1="18" y1="5" x2="18" y2="1"/><line class="cls-1" x1="5" y1="14" x2="7" y2="14"/><line class="cls-1" x1="11" y1="14" x2="13" y2="14"/><line class="cls-1" x1="17" y1="14" x2="19" y2="14"/><line class="cls-1" x1="5" y1="18" x2="7" y2="18"/><line class="cls-1" x1="11" y1="18" x2="13" y2="18"/><line class="cls-1" x1="17" y1="18" x2="19" y2="18"/></g></svg>
        ';
    }

    public function field(string $name, string|null $value = null, string|null $class = null, string|null $style = null, array $attributes = [], mixed $additional_data = null): string
    {
        return Blade::render(
            '<input type="date" wire:model.lazy="{{ $name }}" name="{{ $name }}" @if($value) value="{{ $value }}" @endif @if($class) class="{{ $class }}" @endif @if($style) style="{{ $style }}" @endif @foreach($attributes as $attribute => $attribute_value) {{ $attribute}}="{{ $attribute_value }} @endforeach />',
            compact('name' ,'class' ,'style' ,'attributes' , 'value' , 'additional_data' )
        );
    }

    public function value(mixed $value = null): ?string
    {
        return (string) $value ?? null;
    }
}
