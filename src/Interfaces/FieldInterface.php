<?php

namespace Yeganehha\DynamicForm\Interfaces;

interface FieldInterface
{
    public function AdminMenuName() : string;

    public function field(string $name , mixed $value = null , array $default_values = [], string $class = null , string $style = null , array $attributes) : string;

    public function value(mixed $value = null) : string;
}
