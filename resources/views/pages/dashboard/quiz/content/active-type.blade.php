<div>
    @if ($type)
        <div class="p-6 mb-4 rounded-lg shadow-md bg-primary-500 sm:p-8 dark:bg-slate-800">
            <div class="text-xl font-bold text-secondary-500">
                {{ $type->name }}
            </div>
            <div class="text-sm font-light text-white">
                {{ $type->description }}
            </div>
        </div>

        <x-button block color="secondary" icon="i-ph-plus" x-on:click="$dispatch('toggle-add-group-modal')"
            wire:click="$dispatch('setAddGroup', { questionType: '{{ $type->id }}'})">
            {{ __('Add :add', ['add' => __('Question Group')]) }}
        </x-button>
    @else
        <x-no-data />
    @endif
</div>
