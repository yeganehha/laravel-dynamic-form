<?php

namespace Yeganehha\DynamicForm;

class DefineProperty
{

    /**
     * Retrieve Default migration file name.
     *
     */
    public static $defaultMigrationFileName = 'create_dynamic_form_table.php';

    public static $configFile = 'forms';

    /**
     * Retrieve Default migration's path.
     *
     * @return string
     */
    public static function getDefaultMigrationPath() : string
    {
        return dirname(__DIR__).'/Database/migrations/'.self::$defaultMigrationFileName.'.stub';
    }


    /**
     * Retrieve Default config's path.
     *
     * @return string
     */
    public static function getDefaultConfigurationPath() : string
    {
        return dirname(__DIR__).'/config/'.self::$configFile.'.php';
    }


    /**
     * Retrieve Default stub's path.
     *
     * @param string $name
     * @return string
     */
    public static function getStubPath(string $name) : string
    {
        return dirname(__DIR__).'/stub/'.$name.'.stub';
    }

    public static function getDefaultViewPath(): string
    {
        return dirname(__DIR__).'/Resources/views';
    }


}
