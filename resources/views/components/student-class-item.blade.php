<div class="relative flex flex-col w-full gap-5 p-5 bg-white rounded-lg shadow-md lg:p-7 lg:flex-row pt-9">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ Vite::image('default-class.webp') }}" class="w-full" alt="Class Picture">
    </div>
    <div class="lg:[column-count:3] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        <x-available-class-sub-item :title="__(':name Name', ['name' => __('Class')])">
            <div class="font-bold text-secondary-500">
                {{ $class->name }}
            </div>
        </x-available-class-sub-item>
        <x-available-class-sub-item :title="__('Description')" :value="$class->description" />
        <x-available-class-sub-item :title="__('Teacher')" :value="$class->teacher->name" />
        @if (auth()->user()->isAdmin)
            <x-available-class-sub-item :title="__('School')" :value="$class->teacher->school->name" />
        @endif
        <x-available-class-sub-item :title="__('Expired Date')">
            {{ $class->expired_at ? $class->expired_at->translatedFormat('d M Y') . ' (' . $class->expired_at->diffForHumans() . ')' : '-' }}
        </x-available-class-sub-item>
        <x-available-class-sub-item :title="__('Status')">
            <x-badge :type="$class->isStatusActive ? 'success' : 'error'">
                {{ $class->isStatusActive ? __('Active') : __('Inactive') }}
            </x-badge>
        </x-available-class-sub-item>
        <x-available-class-sub-item :title="__('Number of :subject', ['subject' => __('Assessments')])">
            {{ GeneralHelper::numberFormat($class->quizzes_count) .
                ' ' .
                ($class->quizzes_count > 1 ? __('Assessments') : __('Assessment')) }}
        </x-available-class-sub-item>
        <x-available-class-sub-item :title="__('Number of :subject', ['subject' => __('Students')])">
            {{ GeneralHelper::numberFormat($class->students_count) .
                ' ' .
                ($class->students_count > 1 ? __('Students') : __('Student')) }}
        </x-available-class-sub-item>
        <x-available-class-sub-item>
            <div class="flex flex-col items-start gap-1">
                @role('Student')
                    @if ($class->is_active)
                        <x-button color="cyan" size="sm" icon="i-ph-eye"
                            href="{{ route('dashboard.student-class.show', $class) }}">
                            {{ __('Show') }}
                        </x-button>
                    @endif
                    <x-button color="red" size="sm" icon="i-ph-arrow-square-out"
                        x-on:click="$dispatch('toggle-exit-class-modal')"
                        wire:click="$dispatch('setExitClass',{class: '{{ $class->slug }}'})">
                        {{ __('Exit') }}
                    </x-button>
                @else
                    <x-badge type="warning">
                        {{ __('Only students can use this feature') }}
                    </x-badge>
                @endrole
            </div>
        </x-available-class-sub-item>
    </div>
</div>
