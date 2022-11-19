<?php

namespace Yeganehha\DynamicForm\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Exceptions\UnknownFieldLoaded;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;

class FormMakerComponent extends Component
{

    public array $type_fields = [];

    public array $fieldsClassName = [];
    public array $fields = [];

    public function mount(Request $request)
    {
        $this->mountData();
    }
    private function mountData()
    {
        $this->type_fields = [];
        $this->fields = [];
        foreach ( config(DefineProperty::$configFile.'.fields' , [] ) as $item) {
            if (class_exists($item) and is_subclass_of($item, FieldInterface::class))
                $this->type_fields[] = new $item();
            else
                throw new UnknownFieldLoaded();
        }
        foreach ( $this->fieldsClassName as $item) {
            if (class_exists($item) and is_subclass_of($item, FieldInterface::class))
                $this->fields[] = new $item();
            else
                throw new UnknownFieldLoaded();
        }
    }

    public function render(): View
    {
        return view('DynamicForm::livewire.form-maker');
    }

    public function addField(string $field)
    {
        if (class_exists($field) and is_subclass_of($field, FieldInterface::class)) {
            $this->fieldsClassName[] = $field;
            $this->mountData();
        } else
            throw new UnknownFieldLoaded();
    }

    public function updateFieldSortOrder($fieldsClassName)
    {
        $this->fieldsClassName = collect($fieldsClassName)->map(function ($index) {
            return $this->fieldsClassName[(int) $index['value']] ?? null ;
        })->toArray();
        $this->mountData();
    }

}
