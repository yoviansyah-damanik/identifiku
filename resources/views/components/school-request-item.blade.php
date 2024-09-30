<div class="relative flex flex-col gap-5 p-5 bg-white rounded-lg lg:p-7 lg:flex-row pt-9 drop-shadow-md">
    <div
        class="lg:[column-count:4] md:[column-count:3] sm:[column-count:2] [column-count:2] [column-gap:1.5rem] w-full lg:w-auto flex-1">
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
        <x-school-sub-item :title="__('Username')" :value="$school->username" />
        <x-school-sub-item :title="__('Email')" :value="$school->email" />
        <x-school-sub-item :title="__('Action')">
            <x-tooltip :title="__('Approve')">
                <x-button color="green" size="sm" x-on:click="$dispatch('toggle-approved-school-request-modal')"
                    wire:click="$dispatch('setApprovedSchoolRequest',{ school: '{{ $school->id }}' })"
                    icon="i-ph-check" />
            </x-tooltip>
            <x-tooltip :title="__('Reject')">
                <x-button color="red" size="sm" x-on:click="$dispatch('toggle-rejected-school-request-modal')"
                    wire:click="$dispatch('setRejectedSchoolRequest',{ school: '{{ $school->id }}' })"
                    icon="i-ph-x" />
            </x-tooltip>
        </x-school-sub-item>
    </div>
</div>
