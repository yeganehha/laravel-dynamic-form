<?php

namespace Yeganehha\DynamicForm\Livewire;

use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditFieldModal extends ModalComponent
{
    public function render(): View
    {
        return view('DynamicForm::livewire.edit-field-modal');
    }
}
