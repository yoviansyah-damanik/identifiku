<li x-data="{ id: '{{ $type->id }}', isActive: false, groupActive: '' }"
    class="relative flex items-center justify-between gap-3 overflow-hidden border-b cursor-pointer last:border-b-0"
    x-on:click="typeActive = id" x-init="$watch('typeActive', val => isActive = val == id ? true : false)" {{-- :class="isActive ? 'bg-primary-50' : 'bg-white'" --}} x-sort:item="'{{ $type->id }}'">
    <div class="flex items-center justify-start flex-1 gap-3">
        <div class="grid self-stretch w-12 bg-secondary-50 place-items-center cursor-grab [body:not(.sorting)_&]:hover:bg-secondary-100"
            x-sort:handle>
            <span class="h-8 i-ph-dots-three-outline-vertical pe-2"></span>
        </div>
        <div class="flex flex-col flex-1 px-5 py-3">
            <div class="font-semibold">
                {{ $type->name }} .
                {{ $type->order }}
            </div>
            <div class="text-sm font-light">
                {{ $type->description }}
            </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center gap-1 bg-gradient-to-r from-transparent from-10% to-primary-100 px-7"
            x-show="isActive" x-transition>

            <x-tooltip :title="__('Edit :edit', ['edit' => __(':type Type', ['type' => __('Question')])])">
                <x-button color="yellow" icon="i-ph-pen" size="sm" wire:click=""
                    x-on:click="$dispatch('toggle-edit-type-modal')" />
            </x-tooltip>
            <x-tooltip :title="__('Delete :delete', ['delete' => __(':type Type', ['type' => __('Question')])])">
                <x-button color="red" icon="i-ph-trash" size="sm" wire:click="delete" />
            </x-tooltip>
            {{-- <x-tooltip :title="__('Add :add', ['add' => __('Group')])">
                <x-button color="primary" icon="i-ph-plus" size="sm"
                    wire:click="$dispatch('setAddGroup',{ typeId: '{{ $type->id }}'})"
                    x-on:click="$dispatch('toggle-add-group-modal')">
                </x-button>
            </x-tooltip> --}}
        </div>
    </div>
</li>
