<?php

namespace Yeganehha\DynamicForm\Exceptions;

use Exception;

class NameOfFormCanNotBeNull extends Exception
{
    public static function make(): self
    {
        return new static('Name of form can not be Null or empty!');
    }
}
