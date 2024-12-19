<div>
    <div class="flex flex-col items-center justify-between gap-3 lg:flex-row sm:gap-4">
        <x-form.toggle :label="__('Active')" :label2="__('Inactive')" :isChecked="auth()->user()->school->is_active"
            wire:change="setActivationStatus('{{ auth()->user()->school->id }}')" />
        <x-form.toggle :label="__('Open')" :label2="__('Close')" :isChecked="auth()->user()->school->is_open"
            wire:change="setOpenStatus('{{ auth()->user()->school->id }}')" />
        <x-token-field :school="auth()->user()->school" />
    </div>

    <div class="block border-b my-9"></div>

    <form autocomplete="off" wire:submit.prevent='submit' class="block w-full space-y-3 sm:space-y-4">
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.input class="flex-1" block :loading="$isLoading" label="NPSN" :placeholder="__('Entry :entry', ['entry' => 'NPSN'])" type='number'
                wire:model.blur='npsn' error="{{ $errors->first('npsn') }}" />
            <x-form.input class="flex-1" block :loading="$isLoading" label="NSS" :placeholder="__('Entry :entry', ['entry' => 'NSS'])" type='number'
                wire:model.blur='nss' error="{{ $errors->first('nss') }}" />
            <x-form.input class="flex-1" block :loading="$isLoading" label="NIS" :placeholder="__('Entry :entry', ['entry' => 'NIS'])" type='number'
                wire:model.blur='nis' error="{{ $errors->first('nis') }}" />
        </div>
        <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('School')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('School')])])" type='text'
            wire:model.blur='name' error="{{ $errors->first('name') }}" />
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.select-with-search :loading="$isLoading" block class="flex-1" block searchVar="educationLevelSearch"
                :items="$educationLevels" wire:model="educationLevelSearch" error="{{ $errors->first('educationLevel') }}"
                :label="__('Choose a :item', ['item' => __('Education Level')])" />
            <x-form.select-with-search :loading="$isLoading" block class="flex-1" block searchVar="schoolStatusSearch"
                :items="$schoolStatuses" wire:model="schoolStatusSearch" error="{{ $errors->first('schoolStatus') }}"
                :label="__('Choose a :item', ['item' => __('School Status')])" />
        </div>
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.input class="flex-1" block :loading="$isLoading" :label="__('Address')" :placeholder="__('Entry :entry', ['entry' => __('Address')])" type='text'
                wire:model.blur='address' error="{{ $errors->first('address') }}" />
            <x-form.input class="w-36" block :loading="$isLoading" :label="__('Postal Code')" :placeholder="__('Entry :entry', ['entry' => __('Postal Code')])" type='text'
                wire:model.blur='postalCode' error="{{ $errors->first('postalCode') }}" />
        </div>
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.select-with-search :loading="$isLoading" block class="flex-1" block searchVar="provinceSearch"
                :items="$provinces" wire:model="provinceSearch" error="{{ $errors->first('province') }}"
                :label="__('Choose a :item', ['item' => __('Province')])" />
            <x-form.select-with-search :loading="$isLoading" block class="flex-1" block searchVar="regencySearch"
                :items="$regencies" wire:model="regencySearch" error="{{ $errors->first('regency') }}"
                :label="__('Choose a :item', ['item' => __('Regency')])" />
        </div>
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.select-with-search :loading="$isLoading" block class="flex-1" block searchVar="districtSearch"
                :items="$districts" wire:model="districtSearch" error="{{ $errors->first('district') }}"
                :label="__('Choose a :item', ['item' => __('District')])" />
            <x-form.select-with-search :loading="$isLoading" block class="flex-1" block searchVar="villageSearch"
                :items="$villages" wire:model="villageSearch" error="{{ $errors->first('village') }}"
                :label="__('Choose a :item', ['item' => __('Village')])" />
        </div>
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.input class="flex-1" block :loading="$isLoading" :label="__('Phone Number')" :placeholder="__('Entry :entry', ['entry' => __('Phone Number')])" type='text'
                wire:model.blur='phoneNumber' error="{{ $errors->first('phoneNumber') }}" />
        </div>

        <div class="text-end !mt-7">
            <x-button color="primary">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</div>
