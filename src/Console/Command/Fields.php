<?php

namespace Yeganehha\DynamicForm\Console\Command;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Yeganehha\DynamicForm\DefineProperty;

class Fields extends GeneratorCommand
{
    protected $name = 'make:field';

    protected $description = 'Create a new field for dynamic forms';

    protected $type = 'Field';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('field');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return DefineProperty::getStubPath($stub);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $field = class_basename(Str::ucfirst($name));
        $NameSpace = str_replace("\\".$field , "" , $name);
        $typeVariable = trim($this->option('type') ," \t\n\r\0\x0B=" );

        $replace = [
            '{{ variable_type }}' => $typeVariable,
            '{{ NameSpace }}' => $NameSpace,
            '{{ FieldName }}' => $field
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = (string) Str::of($name)->replaceFirst($this->rootNamespace(), '')->finish('Field');
        return app_path(str_replace('\\', '/', $name).'.php');
    }

    /**
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'/Fields';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['type', 't', InputOption::VALUE_OPTIONAL, 'Type of variable (For exp.: text, date, number, file, checkbox, ...)'],
        ];
    }
}
