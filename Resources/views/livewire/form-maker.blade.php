<div>
    <div class="grid grid-cols-3">
        <div class="max-h-48 overscroll-y-auto">
            <div class="grid grid-cols-2">
                @foreach($type_fields as $type_field)
                    <div>
                        <button class="text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mx-2 my-2 w-11/12"
                                wire:click="addField('{{$type_field['class']}}')">{{ $type_field['admin']['name']}}</button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-span-2 mx-2 border-dashed border-2 border-gray-100 rounded bg-gray-50 mt-2">
            <div wire:sortable="updateFieldSortOrder" class="grid grid-cols-2"  >
                @foreach($fields as $field)
                    <div wire:sortable.item="{{ $field->id }}" class="mx-2  cursor-move border-dashed border-2 border-gray-100 rounded bg-white my-2"  >
                        <div class="m-3 cursor-pointer"  wire:click='openModal("edit-field-modal",{ field_id: {{ $field->id }} })'>{{ $field->label }}</div>
                    </div>
                @endforeach
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
