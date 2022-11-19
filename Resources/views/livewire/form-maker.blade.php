<div>
    <div class="row">
        <div class="col-md-4 col-sm-12 h-75">
            <div class="row">
                @foreach($type_fields as $type_field)
                    <div class="col-md-6">
                        <button class="btn btn-secondary m-3 w-100 text-center" wire:click="addField('{{$type_field->getClass()}}')">{{ $type_field->AdminMenuName() }}</button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            @foreach($fields as $field)
                <div class="bg-gradient bg-secondary bg-opacity-50 border-3 m-3 pointer-event">{{ $field->AdminMenuName() }}</div>
            @endforeach
        </div>
    </div>
</div>
