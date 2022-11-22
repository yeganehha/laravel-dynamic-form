<div>
    <div class="grid grid-cols-3">
        <div class="max-h-48 overscroll-y-auto">
            <div class="grid grid-cols-2">
                @foreach($type_fields as $type_field)
                    <div>
                        <button class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mx-2 my-2 w-11/12"
                                wire:click="addField('{{$type_field['class']}}')">
                            @if( $type_field['admin']['icon']  )
                                <div class="mr-2 -ml-1 w-6 h-5">
                                    {!! $type_field['admin']['icon'] !!}
                                </div>
                            @endif
                            {{ $type_field['admin']['name']}}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-span-2 mx-2 border-dashed border-2 border-gray-100 rounded bg-gray-50 mt-2">
            <div wire:sortable="updateFieldSortOrder" class="grid grid-cols-2"  >
                @forelse($fields as $field)
                    <div wire:sortable.item="{{ $field->id }}" class="mx-2  cursor-move border-dashed border-2 border-gray-100 rounded bg-white my-2"  >
                        <div class="m-3 w-fit cursor-pointer"  wire:click='openModal("edit-field-modal",{ field_id: {{ $field->id }} })'>
                            @if( $field->type and  $field->type->adminIconHtml() )
                                <span class="mr-1 pt-1.5 h-5 inline-block">
                                    {!! $field->type->adminIconHtml() !!}
                                </span>
                            @endif
                            <span class="inline-block">
                                {{ $field->label }}
                            </span>
                            <span class="inline-block pt-1 text-sm">
                                <svg width="10" height="10" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M58.8801 5.11988C57.5188 3.76057 55.6738 2.99707 53.7501 2.99707C51.8264 2.99707 49.9813 3.76057 48.6201 5.11988L25.5401 28.1899C25.3769 28.3596 25.2628 28.5704 25.2101 28.7999L22.7801 39.7299C22.7416 39.9123 22.7441 40.101 22.7873 40.2824C22.8306 40.4637 22.9136 40.6332 23.0303 40.7786C23.147 40.924 23.2945 41.0417 23.4622 41.1232C23.6299 41.2047 23.8136 41.248 24.0001 41.2499C24.0898 41.2597 24.1803 41.2597 24.2701 41.2499L35.2001 38.7899C35.4295 38.7372 35.6404 38.6231 35.8101 38.4599L58.8801 15.3799C59.5555 14.7072 60.0915 13.9077 60.4572 13.0274C60.8229 12.1471 61.0112 11.2032 61.0112 10.2499C61.0112 9.2966 60.8229 8.3527 60.4572 7.47236C60.0915 6.59202 59.5555 5.79256 58.8801 5.11988V5.11988ZM34.3001 36.4299L25.6501 38.3499L27.5701 29.6999L44.3101 12.9999C45.2025 12.1061 46.4135 11.6035 47.6765 11.6025C48.9396 11.6016 50.1513 12.1024 51.0451 12.9949C51.9388 13.8873 52.4415 15.0983 52.4424 16.3613C52.4434 17.6244 51.9425 18.8361 51.0501 19.7299L34.3001 36.4299ZM57.1201 13.6199L54.9101 15.8199C54.795 14.0728 54.049 12.427 52.811 11.189C51.5729 9.95091 49.9272 9.20493 48.1801 9.08988L50.3801 6.87988C51.2769 5.99196 52.488 5.49388 53.7501 5.49388C55.0121 5.49388 56.2232 5.99196 57.1201 6.87988C58.0104 7.77548 58.5102 8.98703 58.5102 10.2499C58.5102 11.5127 58.0104 12.7243 57.1201 13.6199V13.6199Z" fill="black"/>
                                    <path d="M54.91 28.75C54.5785 28.75 54.2605 28.8817 54.0261 29.1161C53.7917 29.3505 53.66 29.6685 53.66 30V57.27C53.66 57.6625 53.5041 58.039 53.2265 58.3165C52.9489 58.5941 52.5725 58.75 52.18 58.75H6.72998C6.33746 58.75 5.96102 58.5941 5.68346 58.3165C5.40591 58.039 5.24998 57.6625 5.24998 57.27V22.73C5.24998 22.3375 5.40591 21.961 5.68346 21.6835C5.96102 21.4059 6.33746 21.25 6.72998 21.25H24C24.3315 21.25 24.6494 21.1183 24.8839 20.8839C25.1183 20.6495 25.25 20.3315 25.25 20C25.25 19.6685 25.1183 19.3505 24.8839 19.1161C24.6494 18.8817 24.3315 18.75 24 18.75H6.72998C5.66911 18.75 4.6517 19.1714 3.90155 19.9216C3.15141 20.6717 2.72998 21.6891 2.72998 22.75V57.27C2.72998 58.3309 3.15141 59.3483 3.90155 60.0984C4.6517 60.8486 5.66911 61.27 6.72998 61.27H52.18C53.2408 61.27 54.2583 60.8486 55.0084 60.0984C55.7586 59.3483 56.18 58.3309 56.18 57.27V30C56.18 29.8342 56.147 29.67 56.083 29.517C56.0189 29.364 55.925 29.2253 55.8068 29.109C55.6886 28.9926 55.5485 28.901 55.3945 28.8393C55.2405 28.7777 55.0758 28.7473 54.91 28.75Z" fill="black"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="flex text-gray-300 font-bold items-center justify-center h-40 w-full col-span-2">
                        {{ trans('form.select_any_field') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <script>
        window.LivewireUIModal = () => {
            return {
                show: false,
                showActiveModal: true,
                activeModal: false,
                modalHistory: [],
                modalWidth: null ,
                getActiveModalAttribute(key) {
                    if (this.$wire.get('modals')[this.activeModal] !== undefined) {
                        return this.$wire.get('modals')[this.activeModal]['modalAttributes'][key];
                    }
                },
                closeModalOnEscape(trigger) {
                    if (this.getActiveModalAttribute('closeOnEscape') === false) {
                        return;
                    }

                    let force = this.getActiveModalAttribute('closeOnEscapeIsForceful') === true;
                    this.closeModal(force);
                },
                closeModalOnClickAway(trigger) {
                    if (this.getActiveModalAttribute('closeOnClickAway') === false) {
                        return;
                    }

                    this.closeModal(true);
                },
                closeModal(force = false, skipPreviousModals = 0, destroySkipped = false) {
                    if(this.show === false) {
                        return;
                    }

                    if (this.getActiveModalAttribute('dispatchCloseEvent') === true) {
                        const componentName = this.$wire.get('modals')[this.activeModal].name;
                        Livewire.emit('modalClosed', componentName);
                    }

                    if (this.getActiveModalAttribute('destroyOnClose') === true) {
                        Livewire.emit('destroyComponent', this.activeModal);
                    }

                    if (skipPreviousModals > 0) {
                        for (var i = 0; i < skipPreviousModals; i++) {
                            if (destroySkipped) {
                                const id = this.modalHistory[this.modalHistory.length - 1];
                                Livewire.emit('destroyComponent', id);
                            }
                            this.modalHistory.pop();
                        }
                    }

                    const id = this.modalHistory.pop();

                    if (id && force === false) {
                        if (id) {
                            this.setActiveModalComponent(id, true);
                        } else {
                            this.setShowPropertyTo(false);
                        }
                    } else {
                        this.setShowPropertyTo(false);
                    }
                },
                setActiveModalComponent(id, skip = false) {
                    this.setShowPropertyTo(true);

                    if (this.activeModal === id) {
                        return;
                    }

                    if (this.activeModal !== false && skip === false) {
                        this.modalHistory.push(this.activeModal);
                    }

                    let focusableTimeout = 50;

                    if (this.activeModal === false) {
                        this.activeModal = id
                        this.showActiveModal = true;
                        this.modalWidth = this.getActiveModalAttribute('maxWidthClass');
                    } else {
                        this.showActiveModal = false;

                        focusableTimeout = 400;

                        setTimeout(() => {
                            this.activeModal = id;
                            this.showActiveModal = true;
                            this.modalWidth = this.getActiveModalAttribute('maxWidthClass');
                        }, 300);
                    }

                    this.$nextTick(() => {
                        let focusable = this.$refs[id]?.querySelector('[autofocus]');
                        if (focusable) {
                            setTimeout(() => {
                                focusable.focus();
                            }, focusableTimeout);
                        }
                    });
                },
                focusables() {
                    let selector = 'a, button, input, textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

                    return [...this.$el.querySelectorAll(selector)]
                        .filter(el => !el.hasAttribute('disabled'))
                },
                firstFocusable() {
                    return this.focusables()[0]
                },
                lastFocusable() {
                    return this.focusables().slice(-1)[0]
                },
                nextFocusable() {
                    return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable()
                },
                prevFocusable() {
                    return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable()
                },
                nextFocusableIndex() {
                    return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1)
                },
                prevFocusableIndex() {
                    return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1
                },
                setShowPropertyTo(show) {
                    this.show = show;

                    if (show) {
                        document.body.classList.add('overflow-y-hidden');
                    } else {
                        document.body.classList.remove('overflow-y-hidden');

                        setTimeout(() => {
                            this.activeModal = false;
                            this.$wire.resetState();
                        }, 300);
                    }
                },
                init() {
                    this.modalWidth = this.getActiveModalAttribute('maxWidthClass');

                    Livewire.on('closeModal', (force = false, skipPreviousModals = 0, destroySkipped = false) => {
                        this.closeModal(force, skipPreviousModals, destroySkipped);
                    });

                    Livewire.on('activeModalComponentChanged', (id) => {
                        this.setActiveModalComponent(id);
                    });
                }
            };
        }
    </script>
    <div
        x-data="LivewireUIModal()"
        x-init="init()"
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="closeModalOnEscape()"
        x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
        x-show="show"
        class="fixed inset-0 z-10 overflow-y-auto"
        style="display: none;"
    >
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-10 text-center sm:block sm:p-0">
            <div
                x-show="show"
                x-on:click="closeModalOnClickAway()"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-all transform"
            >
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="show && showActiveModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-bind:class="modalWidth"
                class="inline-block w-full align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full"
                id="modal-container"
            >
                @forelse($modals as $id => $component)
                    <div x-show.immediate="activeModal == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                        @livewire($component['name'], $component['attributes'], key($id))
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</div>
