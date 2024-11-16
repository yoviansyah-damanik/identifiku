<div x-data="{ expanded: {{ $isOpen ? 'true' : 'false' }} }" class="overflow-hidden transition-all bg-white border shadow"
    :class="expanded ? 'rounded-lg' : 'rounded-t-lg'">
    <div class="px-6 py-3 font-semibold text-white cursor-pointer bg-primary-500" x-on:click="expanded = !expanded">
        <div class="flex items-center justify-between">
            {{ $title }}
            <span :class="expanded ? 'rotate-180' : 'rotate-0'" class="transition-all i-ph-caret-down"></span>
        </div>
    </div>

    <div class="px-6 py-3" x-show="expanded" x-collapse>
        {{ $slot }}
    </div>
</div>
