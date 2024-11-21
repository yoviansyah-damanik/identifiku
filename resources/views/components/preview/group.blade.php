<li x-data="{ id: '{{ $group->id }}', isActive: false }"
    class="relative flex items-center justify-between gap-3 overflow-hidden border-b cursor-pointer last:border-b-0"
    x-on:click="groupActive = id" wire:click="$dispatch('setGroupActive',{ group: '{{ $group->id }}'})"
    x-init="$watch('groupActive', val => isActive = val == id ? true : false)">
    <div class="flex items-center justify-start flex-1 gap-3">
        <div class="flex flex-col flex-1 px-5 py-3">
            <div class="font-semibold">
                {{ $group->name }}
            </div>
            <div class="text-sm font-light">
                {{ $group->description }}
            </div>
            <div class="text-sm font-light">
                <div class="flex items-center gap-1 text-xs">
                    <span class="i-ph-list-checks-light"></span>
                    <div class="flex-1 font-light truncate">
                        {{ $group->questions->count() }}
                        {{ $group->questions->count() > 1 ? __('Questions') : __('Question') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center gap-1 bg-gradient-to-r from-transparent from-10% to-primary-50 px-7"
            x-show="isActive" x-transition>
        </div>
    </div>
</li>
