<?php

return [
    'database' => [
        'table_name' => [
            'form' => 'forms',
            'field' => 'fields',
            'value' => 'values'
        ]
    ],
    'fields' => [
        \Yeganehha\DynamicForm\Fields\CheckBoxField::class,
        \Yeganehha\DynamicForm\Fields\DateField::class,
        \Yeganehha\DynamicForm\Fields\EmailField::class,
        \Yeganehha\DynamicForm\Fields\FileField::class,
        \Yeganehha\DynamicForm\Fields\NumberField::class,
        \Yeganehha\DynamicForm\Fields\PasswordField::class,
        \Yeganehha\DynamicForm\Fields\RadioField::class,
        \Yeganehha\DynamicForm\Fields\SelectBoxField::class,
        \Yeganehha\DynamicForm\Fields\TextareaField::class,
        \Yeganehha\DynamicForm\Fields\TextField::class,
        \Yeganehha\DynamicForm\Fields\TimeField::class,
        \Yeganehha\DynamicForm\Fields\UrlField::class,
    ],
];
