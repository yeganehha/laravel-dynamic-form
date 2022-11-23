<?php

namespace Yeganehha\DynamicForm\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Psy\Exception\FatalErrorException;
use Yeganehha\DynamicForm\DefineProperty;
use Yeganehha\DynamicForm\Exceptions\UnknownFieldLoaded;
use Yeganehha\DynamicForm\Interfaces\FieldInterface;
use Yeganehha\DynamicForm\Models\Field;
use Yeganehha\DynamicForm\Models\Form;
use Yeganehha\DynamicForm\Services\FieldService;
use Yeganehha\DynamicForm\Services\FormService;

class FormMakerComponent extends Component
{
    public Form $form ;
    public array $type_fields = [];
    public Collection $fields;

    public ?string $activeModal;
    public array $modals = [];

    public function resetModals(): void
    {
        $this->modals = [];
        $this->activeModal = null;
    }
    /**
     * @throws UnknownFieldLoaded
     */
    public function mount(Request $request, Form $form)
    {
        $this->type_fields = FieldService::getAllTypes()->toArray();
        $this->form = $form;
        $this->mountData();
    }
    private function mountData()
    {
        $this->fields = FormService::fields($this->form);
    }

    public function render(): View
    {
        return view('DynamicForm::livewire.form-maker');
    }

    /**
     * @throws \Throwable
     * @throws FatalErrorException
     * @throws UnknownFieldLoaded
     */
    public function addField(string $field)
    {
        FieldService::insert($this->form,$field);
        $this->mountData();
    }

    /**
     * @param array $sorted_fields
     */
    public function updateFieldSortOrder(array $sorted_fields)
    {
        FieldService::updateAllFields(Collect($sorted_fields)->map(static function ($item) {
            return [ (int) $item['value'] ,(int) $item['order']];
        })->toArray());
        $this->mountData();
    }


    public function openModal(string $component, array $componentAttributes = []): void
    {
        $id = md5($component . serialize($componentAttributes));
        $this->modals[$id] = [
            'name'            => $component,
            'attributes'      => $componentAttributes,
        ];
        $this->activeModal = $id;
        $this->emit('activeEditFieldModalChanged' , $id);
    }

    public function deleteModal(string $id): void
    {
        unset($this->modals[$id]);
    }

    public function getListeners(): array
    {
        return [
            'openModal',
            'deleteModal'
        ];
    }
}
