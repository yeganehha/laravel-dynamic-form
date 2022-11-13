<?php

namespace Yeganehha\DynamicForm\Interfaces;

interface FieldInterface
{
    public function AdminMenuName() : string;

    public function field(string $name , mixed $value = null , string $class = null , string $style = null , array $atterbutes) : string;

    public function value(mixed $value = null) : string;
}
