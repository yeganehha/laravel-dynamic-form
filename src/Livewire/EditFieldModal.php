<?php

namespace Yeganehha\DynamicForm\Livewire;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Yeganehha\DynamicForm\Models\Field;
use Illuminate\Support\Facades\Request;
use Yeganehha\DynamicForm\Services\FieldService;

class EditFieldModal extends ModalComponent
{
    public Field $field;

    public function mount(int $field_id)
    {
        $this->field = FieldService::findById($field_id);
    }

    public function render(): View
    {
        return view('DynamicForm::livewire.edit-field-modal');
    }
}
