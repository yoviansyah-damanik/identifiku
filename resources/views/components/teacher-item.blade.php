<div class="relative flex flex-col gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 shadow-md group">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ Vite::image('default-avatar.jpg') }}" class="w-full transition-all group-hover:scale-125"
            alt="Teacher Picture">
    </div>
    <div class="lg:[column-count:4] md:[column-count:3] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        <x-teacher-sub-item :title="__(':name Name', ['name' => __('Teacher')])">
            <div class="font-bold text-secondary-500">
                {{ $teacher->name }}
            </div>
        </x-teacher-sub-item>
        <x-teacher-sub-item :title="__('Subject')" :value="$teacher->subject" />
        <x-teacher-sub-item title="NUPTK" :value="$teacher->nuptk" />
        <x-teacher-sub-item :title="__('Address')" :value="$teacher->address" />
        <x-teacher-sub-item :title="__('Place of Birth')" :value="$teacher->place_of_birth" />
        <x-teacher-sub-item :title="__('Date of Birth')" :value="$teacher->date_of_birth->translatedFormat('d F Y')" />
        <x-teacher-sub-item :title="__('Age')" :value="GeneralHelper::getAge($teacher->date_of_birth, true, true)" />
        <x-teacher-sub-item :title="__(':name Name', ['name' => __('School')])">
            <div class="flex items-center gap-3">
                @if (auth()->user()->isAdmin)
                    <x-href href="{{ route('dashboard.school', ['search' => $teacher->school->name]) }}" wire:navigate>
                        {{ $teacher->school->name }}
                    </x-href>
                    <x-tooltip :title="__('View all teachers')">
                        <x-button color="primary-transparent" size="sm" icon="i-ph-list-magnifying-glass"
                            x-on:click="$wire.setSearchSchool('{{ $teacher->school_id }}')" />
                    </x-tooltip>
                @else
                    {{ $teacher->school->name }}
                @endif
            </div>
        </x-teacher-sub-item>
        <x-teacher-sub-item :title="__('User Status')">
            <x-badge :type="$teacher->user->is_suspended ? 'error' : 'success'">
                {{ $teacher->user->is_suspended ? __('Suspended') : __('Active') }}
            </x-badge>
        </x-teacher-sub-item>
        <x-school-sub-item :title="__('Action')">
            <div class="flex flex-col items-start gap-1">
                <x-button color="red" size="sm" x-on:click="$dispatch('toggle-delete-teacher-modal')"
                    wire:click="$dispatch('setDeleteTeacher',{ teacher: '{{ $teacher->id }}' })" icon="i-ph-trash">
                    {{ __('Delete') }}
                </x-button>
                <x-button size="sm" icon="i-ph-key" color="cyan"
                    x-on:click="$dispatch('toggle-forgot-password-modal')"
                    wire:click="$dispatch('setForgotPassword',{ user: '{{ $teacher->user->id }}' })">
                    {{ __('Forgot Password') }}
                </x-button>
                @if ($teacher->user->type != \App\Models\Staff::class)
                    <x-button size="sm" icon="i-ph-user-check" color="green"
                        x-on:click="$dispatch('toggle-user-activation-modal')"
                        wire:click="$dispatch('setUserActivation',{ user: '{{ $teacher->user->id }}' })">
                        {{ __('Activation Menu') }}
                    </x-button>
                @endif
            </div>
        </x-school-sub-item>
    </div>
</div>
