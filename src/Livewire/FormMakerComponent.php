<?php

namespace Yeganehha\DynamicForm\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Exceptions\UnknownFieldLoaded;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;
use Yeganehha\DynamicForm\Models\Field;
use Yeganehha\DynamicForm\Models\Form;

class FormMakerComponent extends Component
{
    public Form $form ;
    public array $type_fields = [];

    public Collection $fields;

    public function mount(Request $request,Form $form)
    {
        foreach ( config(DefineProperty::$configFile.'.fields' , [] ) as $item) {
            if (class_exists($item) and is_subclass_of($item, FieldInterface::class))
                $this->type_fields[] = (new $item())->toArray();
            else
                throw new UnknownFieldLoaded();
        }
        $this->form = $form;
        $this->mountData();
    }
    private function mountData()
    {
        $this->fields = $this->form->fields()->get();
    }

    public function render(): View
    {
        return view('DynamicForm::livewire.form-maker');
    }

    public function addField(string $field)
    {
        if (class_exists($field) and is_subclass_of($field, FieldInterface::class)) {
            $field = new $field();
            Field::insert($this->form,$field->adminName(),$field);
            $this->mountData();
        } else
            throw new UnknownFieldLoaded();
    }

    /**
     * @throws UnknownFieldLoaded
     */
    public function updateFieldSortOrder($sorted_fields)
    {
        if ( is_array($sorted_fields)) {
            DB::beginTransaction();
            foreach ($sorted_fields as $field)
                Field::updateOrder((int)$field['value'], (int)$field['order']);
            DB::commit();
        }
        $this->mountData();
    }

}
