<div class="relative flex flex-col w-full gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 drop-shadow-md">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ Vite::image('default-school.webp') }}" class="w-full" alt="School Picture">
    </div>
    <div
        class="2xl:[column-count:5]  lg:[column-count:4] md:[column-count:3] sm:[column-count:2] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        {{-- <x-school-sub-item title="ID" :value="$school->id" /> --}}
        <x-school-sub-item :title="__(':name Name', ['name' => __('School')])">
            <div class="font-bold text-secondary-500">
                {{ $school->name }}
            </div>
        </x-school-sub-item>
        <x-school-sub-item title="NPSN" :value="$school->npsn" />
        <x-school-sub-item title="NSS" :value="$school->nss" />
        <x-school-sub-item title="NIS" :value="$school->nis" />
        <x-school-sub-item :title="__('Address')" :value="$school->fullAddress" />
        <x-school-sub-item :title="__('Phone Number')" :value="$school->phone_number" />
        <x-school-sub-item :title="__('School Status')" :value="$school->status->name" />
        <x-school-sub-item :title="__('Education Level')" :value="$school->educationLevel->name" />
        <x-school-sub-item :title="__('Number of :subject', ['subject' => __('Students')])">
            <x-href href="{{ route('dashboard.student', ['school' => $school->id]) }}" wire:navigate>
                {{ GeneralHelper::numberFormat($school->students_count) .
                    ' ' .
                    ($school->students_count > 1 ? __('Students') : __('Student')) }}
            </x-href>
        </x-school-sub-item>
        <x-school-sub-item :title="__('Number of :subject', ['subject' => __('Teachers')])">
            <x-href href="{{ route('dashboard.teacher', ['school' => $school->id]) }}" wire:navigate>
                {{ GeneralHelper::numberFormat($school->teachers_count) .
                    ' ' .
                    ($school->teachers_count > 1 ? __('Teachers') : __('Teacher')) }}
            </x-href>
        </x-school-sub-item>
        <x-school-sub-item :title="__('Activation')">
            <x-form.toggle :label="__('Active')" :label2="__('Inactive')" :isChecked="$school->is_active"
                wire:change="setActivationStatus('{{ $school->id }}')" />
        </x-school-sub-item>
        <x-school-sub-item :title="__('Open')">
            <x-form.toggle :label="__('Open')" :label2="__('Close')" :isChecked="$school->is_open"
                wire:change="setOpenStatus('{{ $school->id }}')" />
            <x-school-sub-item :title="__('Username')">
                <x-href href="{{ route('dashboard.users', ['search' => $school->user->username]) }}" wire:navigate>
                    {{ $school->user->username }}
                </x-href>
            </x-school-sub-item>
        </x-school-sub-item>
        @if ($school->is_open)
            <x-school-sub-item :title="__('Token')">
                <x-token-field :$school />
            </x-school-sub-item>
        @endif
        <x-school-sub-item :title="__('Action')">
            <div class="flex flex-col items-start gap-1">
                <x-button color="red" size="sm" x-on:click="$dispatch('toggle-delete-school-modal')"
                    wire:click="$dispatch('setDeleteSchool',{ school: '{{ $school->id }}' })" icon="i-ph-trash">
                    {{ __('Delete') }}
                </x-button>
                <x-button size="sm" icon="i-ph-key" color="cyan"
                    x-on:click="$dispatch('toggle-forgot-password-modal')"
                    wire:click="$dispatch('setForgotPassword',{ user: '{{ $school->user->id }}' })">
                    {{ __('Forgot Password') }}
                </x-button>
                <x-button size="sm" icon="i-ph-user-check" color="green"
                    x-on:click="$dispatch('toggle-user-activation-modal')"
                    wire:click="$dispatch('setUserActivation',{ user: '{{ $school->user->id }}' })">
                    {{ __('Activation Menu') }}
                </x-button>
            </div>
        </x-school-sub-item>
    </div>
</div>
