<div class="relative flex flex-col w-full gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 shadow-md">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ Vite::image('default-class.webp') }}" class="w-full" alt="Class Picture">
    </div>
    <div class="lg:[column-count:3] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        <x-class-sub-item title="ID" :value="$class->id" />
        <x-class-sub-item :title="__(':name Name', ['name' => __('Class')])">
            <div class="font-bold text-secondary-500">
                {{ $class->name }}
            </div>
        </x-class-sub-item>
        <x-class-sub-item :title="__('Description')" :value="$class->description" />
        <x-class-sub-item :title="__('Teacher')" :value="$class->teacher->name" />
        <x-class-sub-item :title="__('Expired Date')">
            {{ $class->expired_at ? $class->expired_at->translatedFormat('d M Y') . ' (' . $class->expired_at->diffForHumans() . ')' : '-' }}
        </x-class-sub-item>
        <x-class-sub-item :title="__('Status')">
            <x-badge :type="$class->isStatusActive ? 'success' : 'error'">
                {{ $class->isStatusActive ? __('Active') : __('Inactive') }}
            </x-badge>
        </x-class-sub-item>
        <x-school-sub-item :title="__('Activation')">
            <x-form.toggle :label="__('Active')" :label2="__('Inactive')" :isChecked="$class->isStatusActive" :isLoading="$class->isLimit"
                wire:change="setActivationStatus('{{ $class->slug }}')" />
        </x-school-sub-item>
        <x-class-sub-item :title="__('Number of :subject', ['subject' => __('Students')])">
            {{ GeneralHelper::numberFormat($class->students_count) .
                ' ' .
                ($class->students_count > 1 ? __('Students') : __('Student')) }}
        </x-class-sub-item>
        <x-class-sub-item :title="__('Number of :subject', ['subject' => __('Quizzes')])">
            {{ GeneralHelper::numberFormat($class->quizzes_count) .
                ' ' .
                ($class->quizzes_count > 1 ? __('Quizzes') : __('Quiz')) }}
        </x-class-sub-item>
        <x-class-sub-item :title="__('Action')">
            <div class="flex flex-col items-start gap-1">
                @haspermission('class show')
                    <x-button color="cyan" size="sm" icon="i-ph-eye"
                        href="{{ route('dashboard.class.show', $class->slug) }}">
                        {{ __('Show') }}
                    </x-button>
                @endhaspermission
                @haspermission('class edit')
                    <x-button color="yellow" size="sm" icon="i-ph-pen"
                        x-on:click="$dispatch('toggle-edit-class-modal')"
                        wire:click="$dispatch('setEditClass',{class:'{{ $class->slug }}'})">
                        {{ __('Edit') }}
                    </x-button>
                @endhaspermission
                @haspermission('class delete')
                    <x-button color="red" size="sm" x-on:click="$dispatch('toggle-delete-class-modal')"
                        wire:click="$dispatch('setDeleteClass',{class:'{{ $class->slug }}'})" icon="i-ph-trash">
                        {{ __('Disband') }}
                    </x-button>
                @endhaspermission
            </div>
        </x-class-sub-item>
    </div>
</div>
