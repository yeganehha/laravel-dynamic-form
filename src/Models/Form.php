<?php

namespace Yeganehha\DynamicForm\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Yeganehha\DynamicForm\DefineProperty;

/**
 * @property int $id
 * @property string $name
 * @property string $model
 * @property Collection $fields
 * @property bool $external_table
 */
class Form extends Model
{
    protected $fillable = ['name' , 'model' , 'external_table' ];

    protected $casts = [
        'external_table' => 'boolean',
    ];

    public function __construct(array $attributes = [])
    {
        $this->table = config(DefineProperty::$configFile.'.database.table_name.form');
        parent::__construct($attributes);
    }

    /**
     * Find Form
     * @param string $name Form name
     * @param string $model Model name
     * @return Form|null
     */
    public static function find(string $name , string $model)
    {
        return self::query()->whereName($name)->whereModel($model)->first();
    }


    /**
     * Create new form.
     * @param string $formName
     * @param string $model
     * @param bool $useExternalTable
     * @return Form
     * @throws \Throwable
     */
    public static function insert(string $formName , string $model , bool $useExternalTable) : Form
    {
        $form = new Form();
        $form->name = $formName;
        $form->model = $model;
        $form->external_table = $useExternalTable;
        $form->saveOrFail();
        return $form;
    }

    public static function FindByModel(string $model)
    {
        return self::query()->where('model' , $model)->latest()->get();
    }

    public function fields(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Field::class)->orderBy('order_number');
    }
}
