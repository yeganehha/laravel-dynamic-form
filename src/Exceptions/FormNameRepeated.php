<?php

namespace Yeganehha\DynamicForm\Exceptions;

use Exception;

class FormNameRepeated extends Exception
{
    public static function make(): self
    {
        return new static('The title of the form is repeated.');
    }
}
