<?php

namespace Yeganehha\DynamicForm\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Yeganehha\DynamicForm\Handler\FormGroupHandler;
use Yeganehha\DynamicForm\Models\Field;
use Illuminate\Support\Facades\Request;
use Yeganehha\DynamicForm\Services\FieldService;
use Yeganehha\DynamicForm\Services\FormService;

class EditFieldModal extends Component
{
    public Field $field;
    public array $configForm;
    public array $styleForm;
    public array $advanceForm;
    public array $setting = [];

    protected $rules = [];

    public function hydrate() {
        $this->setInformation();
    }
    public function mount(int $field_id)
    {
        $this->field = FieldService::findById($field_id);
        $this->setInformation();
    }

    private function setInformation()
    {
        $this->configForm = $this->field->type->getBaseConfigFields()->getFields();
        $this->styleForm = $this->field->type->getBaseStyleFields()->getFields();
        $this->advanceForm = $this->field->type->getBaseAdvanceFields()->getFields();
        foreach ($this->configForm as $name => $field)
            $this->rules['field.'.$name] = $field->validation;
        foreach ($this->styleForm as $name => $field)
            $this->rules['field.'.$name] = $field->validation;
        foreach ($this->advanceForm as $name => $field)
            $this->rules['field.'.$name] = $field->validation;
    }
    public function updated($field, $value)
    {
        //$this->field->${$field} = $value;
        $this->field->save();

    }

    public function render(): View
    {
        return view('DynamicForm::livewire.edit-field-modal');
    }

    public function deleteField()
    {
        $this->field->delete();
        $this->emit('deleteModal');
    }
}
