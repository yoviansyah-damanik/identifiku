<form x-data="{
    step: $wire.entangle('step').live,
}" autocomplete="off" wire:submit.prevent='submit' class="w-full space-y-3 sm:space-y-4">
    <div class="space-y-3 sm:space-y-4" x-show="step == 1">
        <div class="flex items-center gap-3 sm:gap-4">
            <x-form.input class="flex-1" block :loading="$isLoading" label="NPSN" :placeholder="__('Entry :entry', ['entry' => 'NPSN'])" type='number'
                wire:model.blur='npsn' error="{{ $errors->first('npsn') }}" />
            <x-form.input class="flex-1" block :loading="$isLoading" label="NSS" :placeholder="__('Entry :entry', ['entry' => 'NSS'])" type='number'
                wire:model.blur='nss' error="{{ $errors->first('nss') }}" />
            <x-form.input class="flex-1" block :loading="$isLoading" label="NIS" :placeholder="__('Entry :entry', ['entry' => 'NIS'])" type='number'
                wire:model.blur='nis' error="{{ $errors->first('nis') }}" />
        </div>
        <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('School')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('School')])])" type='text' wire:model.blur='name'
            error="{{ $errors->first('name') }}" />
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
    </div>
    <div class="space-y-3 sm:space-y-4" x-show="step == 2">
        <x-form.input block :loading="$isLoading" :label="__('Email')" :placeholder="__('Entry :entry', ['entry' => __('Email')])" type='email'
            wire:model.blur='email' error="{{ $errors->first('email') }}" />
        <x-form.input type="text" block :loading="$isLoading" :label="__('Username')" :placeholder="__('Entry :entry', ['entry' => __('Username')])"
            wire:model.blur='username' error="{{ $errors->first('username') }}" />
        <x-form.input type="password" block :loading="$isLoading" :label="__('Password')" :placeholder="__('Entry :entry', ['entry' => __('Password')])"
            wire:model.blur='password' error="{{ $errors->first('password') }}" />
        <x-form.input type="password" block :loading="$isLoading" :label="__('Re-Password')" :placeholder="__('Entry :entry', ['entry' => __('Re-Password')])"
            wire:model.blur='rePassword' error="{{ $errors->first('rePassword') }}" />
    </div>
    <div x-show="step == 3">
        <x-alert type="success" :closeButton="false">
            {{ $successfulMessage }}
        </x-alert>
    </div>
    @if ($step <= $stepMax)
        <div class="flex justify-between items-center !mt-7">
            <x-button type="button" :withBorderIcon="false" radius="rounded-full" color="red" icon='i-ph-arrow-left'
                :loading="$step == 1" wire:click="prev" :target="['prev', 'next', 'submit']">
                {{ __('Previous') }}
            </x-button>
            @if ($step != $stepMax)
                <x-button type="button" :withBorderIcon="false" radius="rounded-full" color="green" icon='i-ph-arrow-right'
                    iconPosition='right' wire:click="next" :target="['prev', 'next', 'submit']">
                    {{ __('Next') }}
                </x-button>
            @else
                <x-button color="primary" radius="rounded-full" :target="['prev', 'next', 'submit']">
                    {{ __('Save') }}
                </x-button>
            @endif
        </div>
    @endif
</form>
