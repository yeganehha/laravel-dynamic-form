<div>
    <div class="YLDF-grid lg:YLDF-grid-cols-3 max-lg:YLDF-grid-cols-1"
         x-data="{showList: false}">
        <div class="YLDF-max-h-screen YLDF-overflow-y-auto lg:YLDF-block max-lg:YLDF-hidden"
             x-bind:class="{'max-lg:YLDF-hidden': !showList}">
            <div class="YLDF-grid YLDF-grid-cols-2">
                @foreach($type_fields as $type_field)
                    <div>
                        <button class="YLDF-text-gray-900 YLDF-bg-white hover:YLDF-bg-gray-100 YLDF-border YLDF-border-gray-200 YLDF-font-medium YLDF-rounded-lg YLDF-text-sm YLDF-px-5 YLDF-py-2.5 YLDF-text-center YLDF-inline-flex YLDF-items-center YLDF-mx-2 YLDF-my-2 YLDF-w-11/12"
                                wire:click="addField('{{$type_field['class']}}')"
                                x-on:click="showList = !showList">
                            @if( $type_field['admin']['icon']  )
                                <div class="YLDF-mr-2 YLDF--ml-1 YLDF-w-6 YLDF-h-5">
                                    {!! $type_field['admin']['icon'] !!}
                                </div>
                            @endif
                            {{ $type_field['admin']['name']}}
                        </button>
                    </div>
                @endforeach
            </div>
            <div class="lg:YLDF-hidden max-lg:YLDF-block">
                <div class="YLDF-px-2">
                    <button class="YLDF-text-gray-900 YLDF-bg-gray-300 hover:YLDF-bg-gray-100 YLDF-border YLDF-border-gray-200 YLDF-font-medium YLDF-rounded-lg YLDF-text-sm YLDF-px-5 YLDF-py-2.5 YLDF-justify-center YLDF-inline-flex YLDF-items-center YLDF-my-2 YLDF-w-full"
                            x-on:click="showList = !showList">
                        <div class="YLDF-mr-2 YLDF--ml-1 YLDF-w-6 YLDF-h-5">
                            <svg width="20px" height="20px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="112 160 48 224 112 288" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/>
                                <path d="M64,224H358c58.76,0,106,49.33,106,108v20" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/>
                            </svg>
                        </div>
                        {{ trans('form.back_to_form') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="lg:YLDF-col-span-2 YLDF-mx-2 YLDF-border-dashed YLDF-border-2 YLDF-border-gray-200 YLDF-rounded YLDF-bg-gray-50 YLDF-mt-2"  x-bind:class="{'YLDF-hidden md:YLDF-block': showList}">
            <div wire:sortable="updateFieldSortOrder" class="YLDF-grid YLDF-grid-cols-2"  >
                @forelse($fields as $field)
                    <div wire:sortable.item="{{ $field->id }}" class="YLDF-mx-2  YLDF-cursor-move YLDF-border-dashed YLDF-border-2 YLDF-border-gray-200 YLDF-rounded YLDF-bg-white YLDF-my-2" >
                        <div class="YLDF-m-3 YLDF-w-fit YLDF-cursor-pointer"  wire:click='openModal("edit-field-modal",{ field_id: {{ $field->id }} })'>
                            @if( $field->type and  $field->type->adminIconHtml() )
                                <span class="YLDF-mr-1 YLDF-pt-1.5 YLDF-h-5 YLDF-inline-block">
                                    {!! $field->type->adminIconHtml() !!}
                                </span>
                            @endif
                            <span class="YLDF-inline-block">
                                {{ $field->label }}
                            </span>
                            <span class="YLDF-inline-block YLDF-pt-1 YLDF-text-sm">
                                <svg width="10" height="10" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M58.8801 5.11988C57.5188 3.76057 55.6738 2.99707 53.7501 2.99707C51.8264 2.99707 49.9813 3.76057 48.6201 5.11988L25.5401 28.1899C25.3769 28.3596 25.2628 28.5704 25.2101 28.7999L22.7801 39.7299C22.7416 39.9123 22.7441 40.101 22.7873 40.2824C22.8306 40.4637 22.9136 40.6332 23.0303 40.7786C23.147 40.924 23.2945 41.0417 23.4622 41.1232C23.6299 41.2047 23.8136 41.248 24.0001 41.2499C24.0898 41.2597 24.1803 41.2597 24.2701 41.2499L35.2001 38.7899C35.4295 38.7372 35.6404 38.6231 35.8101 38.4599L58.8801 15.3799C59.5555 14.7072 60.0915 13.9077 60.4572 13.0274C60.8229 12.1471 61.0112 11.2032 61.0112 10.2499C61.0112 9.2966 60.8229 8.3527 60.4572 7.47236C60.0915 6.59202 59.5555 5.79256 58.8801 5.11988V5.11988ZM34.3001 36.4299L25.6501 38.3499L27.5701 29.6999L44.3101 12.9999C45.2025 12.1061 46.4135 11.6035 47.6765 11.6025C48.9396 11.6016 50.1513 12.1024 51.0451 12.9949C51.9388 13.8873 52.4415 15.0983 52.4424 16.3613C52.4434 17.6244 51.9425 18.8361 51.0501 19.7299L34.3001 36.4299ZM57.1201 13.6199L54.9101 15.8199C54.795 14.0728 54.049 12.427 52.811 11.189C51.5729 9.95091 49.9272 9.20493 48.1801 9.08988L50.3801 6.87988C51.2769 5.99196 52.488 5.49388 53.7501 5.49388C55.0121 5.49388 56.2232 5.99196 57.1201 6.87988C58.0104 7.77548 58.5102 8.98703 58.5102 10.2499C58.5102 11.5127 58.0104 12.7243 57.1201 13.6199V13.6199Z" fill="black"/>
                                    <path d="M54.91 28.75C54.5785 28.75 54.2605 28.8817 54.0261 29.1161C53.7917 29.3505 53.66 29.6685 53.66 30V57.27C53.66 57.6625 53.5041 58.039 53.2265 58.3165C52.9489 58.5941 52.5725 58.75 52.18 58.75H6.72998C6.33746 58.75 5.96102 58.5941 5.68346 58.3165C5.40591 58.039 5.24998 57.6625 5.24998 57.27V22.73C5.24998 22.3375 5.40591 21.961 5.68346 21.6835C5.96102 21.4059 6.33746 21.25 6.72998 21.25H24C24.3315 21.25 24.6494 21.1183 24.8839 20.8839C25.1183 20.6495 25.25 20.3315 25.25 20C25.25 19.6685 25.1183 19.3505 24.8839 19.1161C24.6494 18.8817 24.3315 18.75 24 18.75H6.72998C5.66911 18.75 4.6517 19.1714 3.90155 19.9216C3.15141 20.6717 2.72998 21.6891 2.72998 22.75V57.27C2.72998 58.3309 3.15141 59.3483 3.90155 60.0984C4.6517 60.8486 5.66911 61.27 6.72998 61.27H52.18C53.2408 61.27 54.2583 60.8486 55.0084 60.0984C55.7586 59.3483 56.18 58.3309 56.18 57.27V30C56.18 29.8342 56.147 29.67 56.083 29.517C56.0189 29.364 55.925 29.2253 55.8068 29.109C55.6886 28.9926 55.5485 28.901 55.3945 28.8393C55.2405 28.7777 55.0758 28.7473 54.91 28.75Z" fill="black"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="YLDF-flex YLDF-text-gray-300 YLDF-font-bold YLDF-items-center YLDF-justify-center YLDF-h-40 YLDF-w-full YLDF-col-span-2">
                        {{ trans('form.select_any_field') }}
                    </div>
                @endforelse
            </div>
            <div class="lg:YLDF-hidden max-lg:YLDF-block">
                <div class="YLDF-px-2">
                    <button class="YLDF-text-gray-900 YLDF-bg-gray-300 hover:YLDF-bg-gray-100 YLDF-border YLDF-border-gray-200 YLDF-font-medium YLDF-rounded-lg YLDF-text-sm YLDF-px-5 YLDF-py-2.5 YLDF-justify-center YLDF-inline-flex YLDF-items-center YLDF-my-2 YLDF-w-full"
                        x-on:click="showList = !showList">
                        <div class="YLDF-mr-2 YLDF--ml-1 YLDF-w-6 YLDF-h-5">
                            <svg version="1.1" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 490 490" xml:space="preserve">
                                <path d="M227.8,174.1v53.7h-53.7c-9.5,0-17.2,7.7-17.2,17.2s7.7,17.2,17.2,17.2h53.7v53.7c0,9.5,7.7,17.2,17.2,17.2
                                    s17.1-7.7,17.1-17.2v-53.7h53.7c9.5,0,17.2-7.7,17.2-17.2s-7.7-17.2-17.2-17.2h-53.7v-53.7c0-9.5-7.7-17.2-17.1-17.2
                                    S227.8,164.6,227.8,174.1z"/>
                                <path d="M71.7,71.7C25.5,118,0,179.5,0,245s25.5,127,71.8,173.3C118,464.5,179.6,490,245,490s127-25.5,173.3-71.8
                                    C464.5,372,490,310.4,490,245s-25.5-127-71.8-173.3C372,25.5,310.5,0,245,0C179.6,0,118,25.5,71.7,71.7z M455.7,245
                                    c0,56.3-21.9,109.2-61.7,149s-92.7,61.7-149,61.7S135.8,433.8,96,394s-61.7-92.7-61.7-149S56.2,135.8,96,96s92.7-61.7,149-61.7
                                    S354.2,56.2,394,96S455.7,188.7,455.7,245z"/>
                            </svg>
                        </div>
                        {{ trans('form.add_field') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div
        x-data="window.formMakerModal()"
        x-init="init()"
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="closeModalOnEscape()"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
        x-show="show"
        class="YLDF-fixed YLDF-inset-0 YLDF-z-10 YLDF-overflow-y-auto"
        style="display: none;">
        <div class="YLDF-flex YLDF-items-end YLDF-justify-center YLDF-min-h-screen YLDF-px-4 YLDF-pt-4 YLDF-pb-10 YLDF-text-center sm:YLDF-block sm:YLDF-p-0">
            <div
                x-show="show"
                x-on:click="closeModalOnClickAway()"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="YLDF-fixed YLDF-inset-0 YLDF-transition-all YLDF-transform">
                <div class="YLDF-absolute YLDF-inset-0 YLDF-bg-gray-500 YLDF-opacity-75"></div>
            </div>

            <span class="YLDF-hidden sm:YLDF-inline-block sm:YLDF-align-middle sm:YLDF-h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="show && showActiveModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="YLDF-inline-block  lg:YLDF-w-1/2 YLDF-align-bottom YLDF-bg-white YLDF-rounded-lg YLDF-overflow-hidden YLDF-shadow-xl YLDF-transform YLDF-transition-all sm:YLDF-my-8 sm:YLDF-align-middle"
                id="modal-container">
                @forelse($modals as $id => $component)
                    <div x-show.immediate="activeModal == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                        @livewire($component['name'], $component['attributes'], key($id))
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
