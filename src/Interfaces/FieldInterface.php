<?php

namespace Yeganehha\DynamicForm\Interfaces;

interface FieldInterface
{
    public function AdminMenuName() : string;

    public function field(string $name , mixed $value = null , mixed $default_values = null, string $class = null , string $style = null , array $attributes) : string;

    public function value(mixed $value = null) : string;
}
