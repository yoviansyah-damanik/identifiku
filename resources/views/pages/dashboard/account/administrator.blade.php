<form class="space-y-3 sm:space-y-4" wire:submit.prevent="submit">
    <x-form.input :loading="$isLoading" :label="__('Fullname')" block :placeholder="__('Entry :entry', ['entry' => Str::lower(__('Fullname'))])" type='name' wire:model='name'
        error="{{ $errors->first('name') }}" required />
    <div class="flex items-center gap-3 sm:gap-4">
        <x-form.input class="flex-1" block :loading="$isLoading" :label="__('Place of Birth')" :placeholder="__('Entry :entry', ['entry' => __('Place of Birth')])" type='text'
            wire:model.blur='placeOfBirth' error="{{ $errors->first('placeOfBirth') }}" />
        <x-form.input type="date" class="w-40" block :loading="$isLoading" :label="__('Date of Birth')" :placeholder="__('Entry :entry', ['entry' => __('Date of Birth')])"
            wire:model.blur='dateOfBirth' error="{{ $errors->first('dateOfBirth') }}" />
    </div>
    <div class="flex items-center gap-3 sm:gap-4">
        <x-form.input class="flex-1" block :loading="$isLoading" :label="__('Phone Number')" :placeholder="__('Entry :entry', ['entry' => __('Phone Number')])" type='text'
            wire:model.blur='phoneNumber' error="{{ $errors->first('phoneNumber') }}" />
        <x-form.radio translated :label="__('Gender')" :items="$genders" inline wire:model.blur="gender"
            error="{{ $errors->first('gender') }}" />
    </div>
    <x-form.input block :loading="$isLoading" :label="__('Address')" :placeholder="__('Entry :entry', ['entry' => __('Address')])" type='text'
        wire:model.blur='address' error="{{ $errors->first('address') }}" />

    <div class="text-end">
        <x-button :loading="$isLoading" type="submit" color="primary" radius="rounded-full" base="!mt-8 lg:!mt-10">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
