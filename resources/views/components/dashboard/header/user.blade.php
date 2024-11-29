{{-- <a class="flex items-center gap-3 p-1 rounded-full cursor-pointer bg-primary-700" wire:navigate
    href="{{ route('dashboard.account') }}">
    <img class="rounded-full size-10" src="{{ Vite::image('default-avatar.jpg') }}" alt="User Icon" />
    <div class="flex flex-col py-1 font-semibold w-44 sm:w-52 lg:w-60">
        <div class="pr-6 text-sm line-clamp-1 sm:text-base text-primary-100">
            {{ auth()->user()->{Str::lower(auth()->user()->roleName)}->name }}
        </div>
        <div class="text-xs font-light line-clamp-1 text-primary-50">
            {{ __(auth()->user()->roleName) }}
        </div>
    </div>
</a> --}}

<div x-data="{ id: $id('userDropdown'), userDropdownShow: false }" x-on:click.outside="userDropdownShow = false">
    <div x-ref="userDropdown" class="flex items-center gap-3 p-1 rounded-full cursor-pointer bg-primary-700 flex-nowrap"
        x-on:click="userDropdownShow = !userDropdownShow">
        <img class="flex-none rounded-full size-12" src="{{ Vite::image('default-avatar.jpg') }}" alt="User Icon" />
        <div class="box-border flex-1 hidden py-1 font-semibold lg:block">
            <div class="line-clamp-1 sm:text-base text-primary-100">
                {{ auth()->user()->{Str::lower(auth()->user()->roleName)}->name }}
            </div>
            <div class="text-sm font-light line-clamp-1 sm:text-xs text-primary-50">
                {{ __(auth()->user()->roleName) }}
            </div>
        </div>
    </div>
    <div class="w-full p-1 mt-1 bg-white border shadow-md max-w-64 rounded-3xl"
        x-anchor.no-style.offset="$refs.userDropdown" x-show="userDropdownShow"
        x-bind:style="{
            position: 'fixed',
            {{-- top: (parseInt($refs.userDropdown.scrollTop) + parseInt($refs.userDropdown.height)) + 'px', --}}
            left: $anchor.x + 'px'
        }"
        x-transition>
        <ul>
            @foreach ($navigations as $nav)
                <li>
                    <a class="flex items-center justify-between px-5 py-2 transition-all rounded-full hover:bg-primary-50 hover:text-primary-500"
                        href="{{ $nav['url'] }}" @if ($nav['title'] != __('Home')) wire:navigate @endif>
                        <div class="flex-none {{ $nav['icon'] }}"></div>
                        <div class="flex-1 text-end">
                            {{ $nav['title'] }}
                        </div>
                    </a>
                </li>
            @endforeach
            <li class="pt-3 mt-3 border-t">
                <livewire:auth.logout menu="main" />
            </li>
        </ul>
    </div>
</div>
