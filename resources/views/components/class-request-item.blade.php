<div class="relative flex flex-col gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 shadow-md">
    <div class="flex items-center justify-center w-full overflow-hidden rounded-lg lg:flex-none h-44 lg:w-72">
        <img src="{{ Vite::image('default-avatar.jpg') }}" class="w-full" alt="Student Picture">
    </div>
    <div class="md:[column-count:3] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
        {{-- <x-class-request-sub-item title="ID" :value="$student->id" /> --}}
        <x-class-request-sub-item :title="__(':name Name', ['name' => __('Student')])">
            <div class="font-bold text-secondary-500">
                {{ $request->student->name }}
            </div>
        </x-class-request-sub-item>
        <x-class-request-sub-item title="NISN" :value="$request->student->nisn" />
        <x-class-request-sub-item title="NIS" :value="$request->student->nis" />
        <x-class-request-sub-item :title="__('Grade Level')" :value="$request->student->grade->name" />
        <x-class-request-sub-item :title="__('Class Request')">
            <div class="font-bold text-secondary-500">
                {{ $request->class->name }}
            </div>
        </x-class-request-sub-item>
        <x-class-request-sub-item :title="__('Teacher')" :value="$request->class->teacher->name" />

        <x-class-request-sub-item :title="__('Action')">
            <div class="flex flex-col items-start gap-1">
                <x-button color="green" size="sm" icon="i-ph-check"
                    x-on:click="$dispatch('toggle-approve-class-modal')"
                    wire:click="$dispatch('setApproveClass',{request: '{{ $request->id }}'})">
                    {{ __('Approve') }}
                </x-button>
                <x-button color="red" size="sm" icon="i-ph-x"
                    x-on:click="$dispatch('toggle-reject-class-modal')"
                    wire:click="$dispatch('setRejectClass',{request: '{{ $request->id }}'})">
                    {{ __('Reject') }}
                </x-button>
            </div>
        </x-class-request-sub-item>
    </div>
</div>
