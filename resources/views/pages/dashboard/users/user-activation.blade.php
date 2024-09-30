<div>
    <x-modal.body>
        @if (!$isLoading)
            <div class="space-y-3 sm:space-y-4">
                <div>
                    <div class="flex items-center overflow-hidden shadow rounded-xl">
                        @foreach ($activationTypes as $idx => $item)
                            <label for="type-{{ $idx + 1 }}"
                                class="relative flex-1 gap-1 overflow-hidden border-r cursor-pointer last:border-r-0">
                                <input name="type" wire:loading.attr='disabled' wire:model.live='activationType'
                                    class="hidden peer/type" id="type-{{ $idx + 1 }}" type="radio"
                                    value="{{ $item['code'] }}" @disabled($isLoading) />
                                <div
                                    class="w-full px-3 py-2 font-medium text-center text-gray-700 bg-primary-50 peer-checked/type:text-gray-100 peer-checked/type:bg-primary-700 peer-checked/type:opacity-100 ">
                                    {{ __(Str::ucfirst($item['label'])) }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('activationType')
                        <div class="mt-1 text-red-700">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    {{ __('Are you sure you want to update this :item?', ['item' => Str::lower(__('User'))]) }}
                </div>

                <div class="space-y-1">
                    <div class="flex">
                        <div class="w-48">{{ __('Username') }}</div>
                        <div class="flex-1 font-semibold">{{ $user->username }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-48">{{ __('Email') }}</div>
                        <div class="flex-1 font-semibold">{{ $user->email }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-48">{{ __('Fullname') }}</div>
                        <div class="flex-1 font-semibold">{{ $user->dataRelation->name }}</div>
                    </div>
                </div>
            </div>
        @else
            <x-loading />
        @endif
    </x-modal.body>
    <x-modal.footer>
        <x-button x-on:click="closeModal" :loading="$isLoading">
            {{ __('Close') }}
        </x-button>
        <x-button color="primary" wire:click='save' :loading="$isLoading">
            {{ __('Submit') }}
        </x-button>
    </x-modal.footer>
</div>
