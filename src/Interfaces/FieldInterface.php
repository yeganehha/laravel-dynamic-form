<?php

namespace Yeganehha\DynamicForm\Interfaces;

use Yeganehha\DynamicForm\Handler\FormGroupHandler;

interface FieldInterface
{
    public function adminName() : string;
    public function adminIconHtml(): string|null;

    public function field(string $name, string $value = null, string $class = null, string $style = null, array $attributes, mixed $additional_data): string;

    public function value(mixed $value = null) : ?string;

    public function getBaseConfigFields(FormGroupHandler $form) : void;

    public function getBaseStyleFields(FormGroupHandler $form) : void;

    public function getBaseAdvanceFields(FormGroupHandler $form) : void;

    public function getClass(): string ;

    public function toArray(): array ;
}
