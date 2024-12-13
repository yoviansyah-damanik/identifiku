<div class="w-full">
    @if (!auth()->check())
        <div class="lg:ms-5">
            <x-button :withNavigated="false" base="!block text-center lg:!inline-block text-xl lg:text-base px-7 lg:px-9"
                color="primary" href="{{ route('login') }}" radius="rounded-full">
                <span class="hidden lg:block">
                    {{ __('Login') }}
                </span>
                <span class="block lg:hidden i-ph-arrow-square-in">
                </span>
            </x-button>
        </div>
    @else
        <div class="w-full" x-data="{ id: $id('userDropdown'), userDropdownShow: false }" x-on:click.outside="userDropdownShow = false">
            <div x-ref="userDropdown"
                class="flex items-center gap-3 p-1 rounded-full cursor-pointer bg-primary-700 flex-nowrap"
                x-on:click="userDropdownShow = !userDropdownShow">
                <img class="flex-none rounded-full size-12" src="{{ Vite::image('default-avatar.jpg') }}"
                    alt="User Icon" />
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
                                href="{{ $nav['url'] }}" wire:navigate>
                                <div class="flex-none {{ $nav['icon'] }} size-6"></div>
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
    @endif
</div>
