<div class="relative flex flex-col gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 drop-shadow-md">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ Vite::image('default-avatar.jpg') }}" class="w-full" alt="Student Picture">
    </div>
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
        <x-student-sub-item :title="__('Action')">
            <x-tooltip :title="__('Delete')">
                <x-button color="red" size="sm" x-on:click="$dispatch('toggle-delete-student-modal')"
                    wire:click="$dispatch('setDeleteStudent',{ student: '{{ $student->id }}' })" icon="i-ph-trash" />
            </x-tooltip>
        </x-student-sub-item>
    </div>
</div>