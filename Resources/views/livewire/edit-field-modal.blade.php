<div>
    <div class="YLDF-m-3" x-data="{ activeTab:  0 }">
        <div class="YLDF-border-b YLDF-border-gray-200">
            <ul class="YLDF-flex YLDF-flex-wrap YLDF--mb-px YLDF-text-sm YLDF-font-medium YLDF-text-center YLDF-text-gray-500">
                <li class="mr-2">
                    <a href="#" @click="activeTab = 0" :class="{ 'YLDF-text-blue-600 YLDF-border-blue-600 YLDF-border-b-2 YLDF-active': activeTab === 0 , 'hover:YLDF-text-gray-600 hover:YLDF-border-gray-300' : activeTab !== 0 }" class="YLDF-inline-flex YLDF-p-4 YLDF-rounded-t-lg YLDF-border-b-2 YLDF-border-transparent YLDF-group">
                        <svg :class="{ 'YLDF-text-blue-600': activeTab === 0 , 'YLDF-text-gray-400 group-hover:YLDF-text-gray-500' : activeTab !== 0 }" class="YLDF-mr-2 YLDF-w-5 YLDF-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ trans('form.basic') }}
                    </a>
                </li>
                <li class="mr-2">
                    <a href="#" @click="activeTab = 1" :class="{ 'YLDF-text-blue-600 YLDF-border-blue-600 YLDF-border-b-2 YLDF-active': activeTab === 1 , 'hover:YLDF-text-gray-600 hover:YLDF-border-gray-300' : activeTab !== 1 }" class="YLDF-inline-flex YLDF-p-4 YLDF-rounded-t-lg YLDF-border-b-2 YLDF-border-transparent YLDF-group">
                        <svg :class="{ 'YLDF-text-blue-600': activeTab === 1 , 'YLDF-text-gray-400 group-hover:YLDF-text-gray-500' : activeTab !== 1  }" class="YLDF-mr-2 YLDF-w-5 YLDF-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        {{ trans('form.style') }}
                    </a>
                </li>
                <li class="mr-2">
                    <a href="#" @click="activeTab = 2" :class="{ 'YLDF-text-blue-600 YLDF-border-blue-600 YLDF-border-b-2 YLDF-active': activeTab === 2 , 'hover:YLDF-text-gray-600 hover:YLDF-border-gray-300' : activeTab !== 2 }" class="YLDF-inline-flex YLDF-p-4 YLDF-rounded-t-lg YLDF-border-b-2 YLDF-border-transparent YLDF-group">
                        <svg :class="{ 'YLDF-text-blue-600': activeTab === 2 , 'YLDF-text-gray-400 group-hover:YLDF-text-gray-500' : activeTab !== 2 }" aria-hidden="true" class="YLDF-mr-2 YLDF-w-5 YLDF-h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
                        {{ trans('form.advance') }}
                    </a>
                </li>
                <li class="mr-2">
                    <a href="#" @click="activeTab = 3" :class="{ 'YLDF-text-red-600 YLDF-border-red-600 YLDF-border-b-2 YLDF-active': activeTab === 3 , 'hover:YLDF-text-red-600 hover:YLDF-border-red-300 YLDF-text-red-400' : activeTab !== 3 }" class="YLDF-inline-flex YLDF-p-4 YLDF-rounded-t-lg YLDF-border-b-2 YLDF-border-transparent YLDF-group">
                        <svg :class="{ 'YLDF-text-red-600': activeTab === 3 , 'YLDF-text-red-400 group-hover:YLDF-text-red-500' : activeTab !== 3 }" class="YLDF-mr-2 YLDF-w-5 YLDF-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        {{ trans('form.advance') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="YLDF-mt-2 YLDF-text-left">
            <div :class="{'YLDF-hidden' : activeTab !== 0 }" class="YLDF-p-4 YLDF-bg-gray-50 YLDF-rounded-lg" >
                <p style="display: none;" class="YLDF-bg-gray-50 YLDF-border YLDF-border-gray-300 YLDF-text-gray-900 YLDF-text-sm YLDF-rounded-lg YLDF-focus:ring-blue-500 YLDF-focus:border-blue-500 YLDF-block YLDF-w-full YLDF-p-2.5"></p>
                @foreach( $configForm as $name => $CField )
                    <div class="YLDF-mb-5">
                        <label for="email" class="YLDF-block YLDF-mb-2 YLDF-text-sm YLDF-font-medium YLDF-text-gray-900">
                            {{ $CField->label }}
                        </label>
                        {!!  $CField->type->field('field.'.$name , '' , 'YLDF-bg-gray-50 YLDF-border YLDF-border-gray-300 YLDF-text-gray-900 YLDF-text-sm YLDF-rounded-lg YLDF-focus:ring-blue-500 YLDF-focus:border-blue-500 YLDF-block YLDF-w-full YLDF-p-2.5' ) !!}
                        @if ( $CField->label )
                        <p class="YLDF-mt-2 YLDF-text-sm YLDF-text-gray-500">
                            {{ $CField->description }}
                        </p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div :class="{'YLDF-hidden' : activeTab !== 1 }" class="YLDF-p-4 YLDF-bg-gray-50 YLDF-rounded-lg" >
                @foreach( $styleForm as $name => $CField )
                    <div class="YLDF-mb-5">
                        <label for="email" class="YLDF-block YLDF-mb-2 YLDF-text-sm YLDF-font-medium YLDF-text-gray-900">
                            {{ $CField->label }}
                        </label>
                        {!!  $CField->type->field('field.'.$name , '' , 'YLDF-bg-gray-50 YLDF-border YLDF-border-gray-300 YLDF-text-gray-900 YLDF-text-sm YLDF-rounded-lg YLDF-focus:ring-blue-500 YLDF-focus:border-blue-500 YLDF-block YLDF-w-full YLDF-p-2.5' ) !!}
                        @if ( $CField->label )
                            <p class="YLDF-mt-2 YLDF-text-sm YLDF-text-gray-500">
                                {{ $CField->description }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div :class="{'YLDF-hidden' : activeTab !== 2 }" class="YLDF-p-4 YLDF-bg-gray-50 YLDF-rounded-lg" >
                @foreach( $advanceForm as $name => $CField )
                    <div class="YLDF-mb-5">
                        <label for="email" class="YLDF-block YLDF-mb-2 YLDF-text-sm YLDF-font-medium YLDF-text-gray-900">
                            {{ $CField->label }}
                        </label>
                        {!!  $CField->type->field('field.'.$name , '' , 'YLDF-bg-gray-50 YLDF-border YLDF-border-gray-300 YLDF-text-gray-900 YLDF-text-sm YLDF-rounded-lg YLDF-focus:ring-blue-500 YLDF-focus:border-blue-500 YLDF-block YLDF-w-full YLDF-p-2.5' ) !!}
                        @if ( $CField->label )
                            <p class="YLDF-mt-2 YLDF-text-sm YLDF-text-gray-500">
                                {{ $CField->description }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
            <div :class="{'YLDF-hidden' : activeTab !== 3 }" class="YLDF-p-4 YLDF-bg-red-200 YLDF-rounded-lg" >
                <strong class="YLDF-text-red-900">
                    {{ trans('form.areyousure') }}
                    <button wire:click='deleteField()' type="button" class="focus:YLDF-outline-none YLDF-text-white YLDF-bg-red-700 YLDF-hover:bg-red-800 focus:YLDF-ring-4 focus:YLDF-ring-red-300 YLDF-font-medium YLDF-rounded-lg YLDF-text-sm YLDF-px-5 YLDF-py-2.5 YLDF-mr-2 YLDF-mb-2 YLDF-text-center iYLDF-nline-flex YLDF-items-center YLDF-mr-2 ">
                        <svg class="YLDF-mr-2 YLDF--ml-1 YLDF-w-5 YLDF-h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        {{ trans('form.delete') }}
                    </button>
                </strong>
            </div>
        </div>
    </div>
</div>
