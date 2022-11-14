<?php

namespace Yeganehha\DynamicForm\Exceptions;

use Exception;

class ArrayValuesOfSelectBoxAreMissing extends Exception
{
    public static function make(): self
    {
        return new static('Select box option are missing!');
    }
}
