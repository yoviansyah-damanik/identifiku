<li x-data="{ id: '{{ $type['_id'] }}', isActive: false, groupActive: '' }"
    class="flex items-center justify-between gap-3 px-5 py-3 border-b cursor-default last:border-b-0"
    x-on:click="typeActive = id" x-init="$watch('typeActive', val =>
        isActive = val == id ? true : false)" :class="isActive ? 'bg-primary-50' : 'bg-white'"
    x-sort:item="'{{ $type['_id'] }}'">
    <div class="flex items-center flex-1 gap-3">
        <span class="i-ph-dots-three-outline-vertical pe-2 cursor-grab" x-sort:handle></span>
        {{ $type['name'] }}
    </div>
    <x-tooltip :title="__('Add :add', ['add' => __('Group')])">
        <x-button color="primary" icon="i-ph-plus" size="sm"
            wire:click="$dispatch('setAddGroup',{ typeId: '{{ $type['_id'] }}'})"
            x-on:click="$dispatch('toggle-add-group-modal')">
        </x-button>
    </x-tooltip>
</li>
