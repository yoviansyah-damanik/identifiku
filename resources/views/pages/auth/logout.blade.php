@if ($menu == 'dashboard')
    <div class='w-full' :class="sidebarToggle ? 'mx-3' : ''">
        <button
            class="flex items-center justify-center w-full h-10 gap-1 py-3 text-white transition duration-150 bg-red-700 hover:bg-red-500 dark:bg-red-500 dark:hover:bg-red-700"
            :class="sidebarToggle ? 'rounded-full' : ''" wire:click='logout' wire:loading.attr="disabled">
            <span class="i-solar-square-bottom-down-line-duotone size-4"></span>
            <span class="texs-base" x-show="sidebarToggle">
                {{ __('Logout') }}
            </span>
        </button>
    </div>
@elseif($menu == 'main')
    <div class="w-full">
        <button
            class="flex items-center rounded-full justify-center w-full h-10 gap-1 py-3 text-white transition duration-150 bg-red-700 hover:bg-red-500 dark:bg-red-500 dark:hover:bg-red-700"
            wire:click='logout' wire:loading.attr="disabled">
            <span class="i-solar-square-bottom-down-line-duotone size-4"></span>
            <span class="texs-base">
                {{ __('Logout') }}
            </span>
        </button>
    </div>
@endif
