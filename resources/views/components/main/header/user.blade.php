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
        <div class="w-full" x-data="{ userDropdownShow: false }" x-on:click.outside="userDropdownShow = false">
            <div x-ref="userDropdown"
                class="flex items-center gap-3 p-1 rounded-full cursor-pointer bg-primary-700 flex-nowrap"
                x-on:click="userDropdownShow = !userDropdownShow">
                <img class="rounded-full flex-none size-12" src="{{ Vite::image('default-avatar.jpg') }}"
                    alt="User Icon" />
                <div class="lg:block py-1 font-semibold flex-1 hidden box-border">
                    <div class="line-clamp-1 sm:text-base text-primary-100">
                        {{ auth()->user()->dataRelation->name }}
                    </div>
                    <div class="text-sm line-clamp-1 sm:text-xs font-light text-primary-50">
                        {{ __(auth()->user()->roleName) }}
                    </div>
                </div>
            </div>
            <div class="w-full max-w-64 bg-white rounded-xl p-1 shadow-md border"
                x-anchor.no-style.offset.10="$refs.userDropdown" x-show="userDropdownShow"
                x-bind:style="{ position: 'absolute', top: $anchor.y + 'px', left: $anchor.x + 'px' }" x-transition>
                <ul>
                    @foreach ($navigations as $nav)
                        <li>
                            <a class="py-2 px-5 hover:bg-primary-50 hover:text-primary-500 transition-all rounded-md flex items-center justify-between"
                                href="{{ $nav['url'] }}" wire:navigate>
                                <div class="flex-none {{ $nav['icon'] }}"></div>
                                <div class="flex-1 text-end">
                                    {{ $nav['title'] }}
                                </div>
                            </a>
                        </li>
                    @endforeach
                    <li class="mt-3 pt-3 border-t">
                        <livewire:auth.logout menu="main" />
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
