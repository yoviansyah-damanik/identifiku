<li>
    <div x-data="{ id: $id('sidebar-menu-item'), tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="cursor-pointer"
        x-ref="tooltip" :id="id">
        <a href="{{ $menu['to'] }}" @class([
            'relative flex items-center justify-start h-12 gap-0 transition duration-150 dark:text-gray-100',
            $menu['isActive']
                ? 'bg-primary-100 dark:bg-slate-800'
                : 'hover:bg-primary-50 dark:hover:bg-slate-700',
        ]) wire:navigate {{-- x-on:click="sidebarToggle = false" --}} x-ref="item">
            <div @class([
                'relative grid flex-none w-16 h-full overflow-hidden place-items-center',
                $menu['isActive'] ? 'bg-primary-700 text-white' : '',
            ]) :class="sidebarToggle ? 'rounded-r-full' : 'rounded-none'">
                <span class="{{ $menu['icon'] }} size-6"></span>
            </div>
            <div class="flex-1 p-3 truncate" x-show="sidebarToggle" x-transition x-transition.origin.left>
                {{ $menu['title'] }}
            </div>
        </a>
        <div role="tooltip" x-show="tooltip && !sidebarToggle" x-anchor.no-style.right.offset.10="$refs.tooltip"
            x-bind:style="{ position: 'fixed', top: $anchor.y + 'px', left: $anchor.x + 'px' }"
            class="hidden p-2 text-sm text-gray-100 rounded-md shadow z-[999] sm:block bg-slate-800 dark:bg-slate-600 dark:shadow-slate-500 text-nowrap">
            {{ $menu['title'] }}
        </div>
    </div>
</li>
