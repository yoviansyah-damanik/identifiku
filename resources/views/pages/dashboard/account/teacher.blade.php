<form class="space-y-3 sm:space-y-4" wire:submit.prevent="submit">
    <div class="flex flex-wrap items-center gap-3 sm:gap-4">
        <x-form.input class="flex-1" block :loading="$isLoading" label="NUPTK" :placeholder="__('Entry :entry', ['entry' => 'NUPTK'])" type='number'
            wire:model.blur='nuptk' error="{{ $errors->first('nuptk') }}" />
        <x-form.input class="flex-1" block :loading="$isLoading" :label="__('Subject')" :placeholder="__('Entry :entry', ['entry' => __('Subject')])" type='text'
            wire:model.blur='subject' error="{{ $errors->first('subject') }}" />
    </div>
    <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Teacher')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Teacher')])])" type='text' wire:model.blur='name'
        error="{{ $errors->first('name') }}" />
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

    <div class="text-end !mt-7">
        <x-button :loading="$isLoading" type="submit" color="primary" radius="rounded-full" base="!mt-8 lg:!mt-10">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
