<div x-data="{ id: 'sidebar' }"
    class="fixed inset-0 flex-col transition-all bg-white shadow lg:sticky lg:top-0 lg:flex dark:bg-slate-900 z-sidebar group h-dvh lg:w-full md:w-72 xl:w-[20rem]"
    :class="sidebarToggle ? 'flex' : 'lg:!w-16 lg:translate-x-0 -translate-x-full'">
    <x-dashboard.sidebar.header />

    {{-- MENU LIST --}}
    <div class="relative flex-1 w-full h-full overflow-y-hidden">
        <ul class="relative w-full h-full pb-12 mt-3 overflow-y-auto">
            {{-- Dashboard Default --}}
            <x-dashboard.sidebar.item :menu="[
                'title' => __('Home'),
                'icon' => 'i-fluent-emoji-flat-antenna-bars',
                'to' => route('dashboard'),
                'isActive' => request()->routeIs('dashboard'),
            ]" />
            @foreach ($menu_group as $menus)
                <li
                    class="w-full my-3 px-3 h-6 relative flex text-primary-500 gap-3 items-center after:w-full after:h-[1px] after:bg-secondary-500 font-semibold">
                    <span :class="sidebarToggle ? '' : 'hidden'">
                        {{ $menus['title'] }}
                    </span>
                </li>
                @foreach ($menus['items'] as $menu)
                    <x-dashboard.sidebar.item :$menu />
                @endforeach
            @endforeach
        </ul>
    </div>

    {{-- LOGOUT --}}
    <div class="flex items-center justify-center w-full h-16">
        <livewire:auth.logout menu="dashboard" />
    </div>
</div>
