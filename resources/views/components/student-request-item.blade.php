<div class="relative flex flex-col gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 shadow-md">
    <div class="lg:[column-count:4] md:[column-count:3] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        {{-- <x-student-sub-item title="ID" :value="$student->id" /> --}}
        <x-student-sub-item :title="__(':name Name', ['name' => __('Student')])">
            <div class="font-bold text-secondary-500">
                {{ $student->name }}
            </div>
        </x-student-sub-item>
        <x-student-sub-item title="NISN" :value="$student->nisn" />
        <x-student-sub-item title="NIS" :value="$student->nis" />
        <x-student-sub-item :title="__('Grade Level')" :value="$student->grade->name" />
        <x-student-sub-item :title="__('Address')" :value="$student->address" />
        <x-student-sub-item :title="__('Place of Birth')" :value="$student->place_of_birth" />
        <x-student-sub-item :title="__('Date of Birth')" :value="$student->date_of_birth->translatedFormat('d F Y')" />
        <x-student-sub-item :title="__('Age')" :value="GeneralHelper::getAge($student->date_of_birth, true, true)" />
        <x-student-sub-item :title="__(':name Name', ['name' => __('School')])">
            <div class="flex items-center gap-3">
                <x-href href="{{ route('dashboard.school', ['search' => $student->school->name]) }}" wire:navigate>
                    {{ $student->school->name }}
                </x-href>
                <x-tooltip :title="__('View all students')">
                    <x-button color="primary-transparent" size="sm" icon="i-ph-list-magnifying-glass"
                        x-on:click="$wire.setSearchSchool('{{ $student->school_id }}')" />
                </x-tooltip>
            </div>
        </x-student-sub-item>
        <x-school-sub-item :title="__('Action')">
            <x-tooltip :title="__('Approve')">
                <x-button color="green" size="sm" x-on:click="$dispatch('toggle-approved-student-request-modal')"
                    wire:click="$dispatch('setApprovedStudentRequest',{ student: '{{ $student->id }}' })"
                    icon="i-ph-check" />
            </x-tooltip>
            <x-tooltip :title="__('Reject')">
                <x-button color="red" size="sm" x-on:click="$dispatch('toggle-rejected-student-request-modal')"
                    wire:click="$dispatch('setRejectedStudentRequest',{ student: '{{ $student->id }}' })"
                    icon="i-ph-x" />
            </x-tooltip>
        </x-school-sub-item>
    </div>
</div>
