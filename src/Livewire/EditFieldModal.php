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

    public function mount(int $field_id)
    {
        $this->field = FieldService::findById($field_id);
        $configForm = new FormGroupHandler();
        $styleForm = new FormGroupHandler();
        $advanceForm = new FormGroupHandler();
        $this->field->type->getBaseConfigFields($configForm);
        $this->field->type->getBaseStyleFields($styleForm);
        $this->field->type->getBaseAdvanceFields($advanceForm);
        $this->configForm = $configForm->getFields();
        $this->styleForm = $styleForm->getFields();
        $this->advanceForm = $advanceForm->getFields();

    }

    public function render(): View
    {
        return view('DynamicForm::livewire.edit-field-modal');
    }

    public function deleteField()
    {
        $this->field->delete();
        $this->emit('deleteModal',1);
    }
}
