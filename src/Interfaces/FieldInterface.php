<?php

namespace Yeganehha\DynamicForm\Interfaces;

use Yeganehha\DynamicForm\Handler\FormGroupHandler;

interface FieldInterface
{
    public function adminName() : string;
    public function adminIconHtml(): string|null;

    public function field(string $name, string|null $value = null, string|null $class = null, string|null $style = null, array $attributes = [], mixed $additional_data = null): string;

    public function value(mixed $value = null) : ?string;

    public function getBaseConfigFields(FormGroupHandler|null $form) : FormGroupHandler;

    public function getBaseStyleFields(FormGroupHandler|null $form) : FormGroupHandler;

    public function getBaseAdvanceFields(FormGroupHandler|null $form) : FormGroupHandler;

    public function getClass(): string ;

    public function toArray(): array ;
}
