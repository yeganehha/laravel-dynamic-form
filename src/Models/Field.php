<?php


namespace Yeganehha\DynamicForm\Models;

use Illuminate\Database\Eloquent\Model;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Enums\FieldStatusEnum;
use Yeganehha\DynamicForm\Exceptions\UnknownFieldLoaded;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;
use Yeganehha\DynamicForm\Traits\FieldModelSetter;

/**
 * @property int id
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


    /**
     * Create new form.
     * @param Form $form
     * @param string $label
     * @param FieldInterface $type_variable
     * @param Field|null $parent
     * @param FieldStatusEnum $status
     * @param ?string $description
     * @param mixed|null $value
     * @param string|null $font_icon
     * @param mixed|null $validate
     * @param int|null $order_number
     * @param string|null $class
     * @param string|null $style
     * @param mixed|null $field_attributes
     * @param mixed|null $additional_data
     * @return Field
     * @throws \Throwable
     */
    public static function insert(Form $form, string $label, FieldInterface $type_variable, Field $parent = null, FieldStatusEnum $status = FieldStatusEnum::Show, string $description = null, mixed $value = null, string $font_icon = null, mixed $validate = null, int $order_number = null , string $class = null, string $style = null, mixed $field_attributes = null, mixed $additional_data = null) : Field
    {
        $field = new Field();
        $field->form_id = $form->id;
        $field->label = $label;
        $field->type_variable = get_class($type_variable);
        if ( $parent )
            $field->parent_id = $parent;
        $field->status = $status;
        $field->description = $description;
        $field->value = $value;
        $field->font_icon = $font_icon;
        $field->validate = $validate;
        if ( $order_number )
            $field->order_number = $order_number;
        else
        {
            $maxOrder = self::query()->where('form_id', $form->id)->max('order_number');
            $field->order_number = ++$maxOrder;
        }
        $field->class = $class;
        $field->style = $style;
        $field->field_attributes = $field_attributes;
        $field->additional_data = $additional_data;
        $field->saveOrFail();
        return $field;
    }

    /**
     * @param int $order
     * @return static
     */
    public function updateOrder(int $order): self
    {
        $this->order_number = $order;
        $this->save();
        return $this;
    }

    /**
     * @param int $id
     * @return self
     */
    public static function findById(int $id): Model
    {
        return self::query()->findOrFail($id);
    }
}
