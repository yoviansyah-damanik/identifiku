<div class="relative flex flex-col gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 drop-shadow-md">
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
                <x-href href="{{ route('dashboard.school', ['search' => $teacher->school->name]) }}" wire:navigate>
                    {{ $teacher->school->name }}
                </x-href>
                <x-tooltip :title="__('View all teachers')">
                    <x-button color="primary-transparent" size="sm" icon="i-ph-list-magnifying-glass"
                        x-on:click="$wire.setSearchSchool('{{ $teacher->school_id }}')" />
                </x-tooltip>
            </div>
        </x-teacher-sub-item>
        <x-school-sub-item :title="__('Action')">
            <x-tooltip :title="__('Approve')">
                <x-button color="green" size="sm" x-on:click="$dispatch('toggle-approved-teacher-request-modal')"
                    wire:click="$dispatch('setApprovedTeacherRequest',{ teacher: '{{ $teacher->id }}' })"
                    icon="i-ph-check" />
            </x-tooltip>
            <x-tooltip :title="__('Reject')">
                <x-button color="red" size="sm" x-on:click="$dispatch('toggle-rejected-teacher-request-modal')"
                    wire:click="$dispatch('setRejectedTeacherRequest',{ teacher: '{{ $teacher->id }}' })"
                    icon="i-ph-x" />
            </x-tooltip>
        </x-school-sub-item>
    </div>
</div>
