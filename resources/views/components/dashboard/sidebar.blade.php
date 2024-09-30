<div x-data
    class="fixed inset-0 flex-col bg-white shadow lg:sticky lg:top-0 lg:flex dark:bg-slate-900 z-sidebar group h-dvh transition-all"
    :class="sidebarToggle ? 'lg:w-full md:w-72 xl:w-[20rem] flex' : 'w-16 hidden'">
    <x-dashboard.sidebar.header />

    {{-- MENU LIST --}}
    <div class="relative flex-1 w-full h-full overflow-y-hidden">
        <ul class="relative w-full h-full pb-12 mt-3 overflow-y-auto sm:overflow-y-hidden sm:hover:overflow-y-auto">
            @foreach ($menu_group as $menus)
                @foreach ($menus as $menu)
                    <x-dashboard.sidebar.item :$menu />
                @endforeach
                @if (!$loop->last)
                    <li>
                        <div class="w-full h-[1px] bg-gray-100 my-3"></div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    {{-- LOGOUT --}}
    <div class="flex items-center justify-center w-full h-16">
        <livewire:auth.logout menu="dashboard" />
    </div>
</div>
