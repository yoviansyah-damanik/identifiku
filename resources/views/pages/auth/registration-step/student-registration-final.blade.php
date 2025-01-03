<form x-data="{
    step: $wire.entangle('step').live,
}" autocomplete="off" wire:submit.prevent='submit' class="w-full space-y-3 sm:space-y-4">
    <div class="space-y-3 sm:space-y-4" x-show="step == 1">
        <div class="flex flex-wrap items-center gap-3 sm:gap-4">
            <x-form.input class="flex-1" block :loading="$isLoading" :label="__('Local NIS')" :placeholder="__('Entry :entry', ['entry' => __('Local NIS')])" type='number'
                wire:model.blur='nis' error="{{ $errors->first('nis') }}" />
            <x-form.input class="flex-1" block :loading="$isLoading" label="NISN" :placeholder="__('Entry :entry', ['entry' => 'NISN'])" type='number'
                wire:model.blur='nisn' error="{{ $errors->first('nisn') }}" />
            <x-form.select-with-search class="flex-none w-full lg:w-auto lg:flex-1" block searchVar="gradeLevelSearch"
                :items="$gradeLevels" wire:model="gradeLevel" error="{{ $errors->first('gradeLevel') }}" :label="__('Choose a :item', ['item' => __('Grade Level')])"
                :buttonText="__('Choose a :item', ['item' => __('Grade Level')])" />
        </div>
        <x-form.input :loading="$isLoading" :label="__(':name Name', ['name' => __('Student')])" block :placeholder="__('Entry :entry', ['entry' => __(':name Name', ['name' => __('Student')])])" type='text' wire:model.blur='name'
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
            <x-button type="button" color="red" radius="rounded-full" icon='i-ph-arrow-left' :withBorderIcon="false"
                :loading="$step == 1" wire:click="prev" :target="['prev', 'next', 'submit']">
                {{ __('Previous') }}
            </x-button>
            @if ($step != $stepMax)
                <x-button type="button" color="green" radius="rounded-full" icon='i-ph-arrow-right' :withBorderIcon="false"
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
