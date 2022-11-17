<?php


namespace Yeganehha\DynamicForm\Models;

use Illuminate\Database\Eloquent\Model;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Enums\FieldStatusEnum;
use Yeganehha\DynamicForm\Traits\FieldModelSetter;

/**
 * @property int form_id
 * @property string label
 * @property string description
 * @property string font_icon
 * @property mixed value
 * @property mixed validate
 * @property string type_variable
 * @property string status
 * @property int order_number
 * @property string class
 * @property string style
 * @property mixed field_attributes
 * @property mixed additional_data
 * @property int parent_id
 */
class Field extends Model
{
    use FieldModelSetter;
    protected $fillable = [
        'form_id' ,
        'label' ,
        'description' ,
        'font_icon' ,
        'value' ,
        'validate',
        'type_variable',
        'status',
        'order_number' ,
        'class' ,
        'style' ,
        'field_attributes',
        'additional_data',
        'parent_id'
    ];

    protected $casts = [
        'form_id' => 'int',
        'parent_id' => 'int',
        'value' => 'json',
        'validate' => 'json',
        'status' => FieldStatusEnum::class,
        'order_number' => 'int',
        'field_attributes' => 'json',
        'additional_data' => 'json',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config(DefineProperty::$configFile.'.database.table_name.field');
        parent::__construct($attributes);
    }



}
