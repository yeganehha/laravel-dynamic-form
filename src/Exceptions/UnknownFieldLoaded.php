<?php

namespace Yeganehha\DynamicForm\Exceptions;

use Exception;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;

class UnknownFieldLoaded extends Exception
{
    public static function make(): self
    {
        return new static('Field must be implement '. FieldInterface::class .' !');
    }
}
