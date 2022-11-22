<div>
    <div class="row">
        <div class="col-md-4 col-sm-12 h-75">
            <div class="row">
                @foreach($type_fields as $type_field)
                    <div class="col-md-6">
                        <button class="btn btn-secondary m-3 w-100 text-center" wire:click="addField('{{$type_field['class']}}')">{{ $type_field['admin']['name']}}</button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div wire:sortable="updateFieldSortOrder" class="row"  >
                @foreach($fields as $field)
                    <div wire:sortable.item="{{ $field->id }}" class="col-md-6"  >
                        <div class="bg-gradient bg-secondary bg-opacity-50 border-3 m-3 pointer-event"  onclick='Livewire.emit("openModal", "edit-field-modal",{ field_id: {{ $field->id }} })'>{{ $field->label }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @livewire('livewire-ui-modal')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</div>
