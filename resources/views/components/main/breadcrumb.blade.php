<div id="breadcrumb"
    class="min-h-24 lg:min-h-32 !pt-28 lg:!pt-36 bg-primary-50 p-7 lg:p-9 flex items-center justify-center mb-12 shadow-md bg-pattern bg-cover bg-bottom bg-repeat-x">
    <x-container>
        <ul class="text-lg lg:text-xl">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!empty($breadcrumb['url']))
                    <li class="after:content-['/'] last:after:content-none after:mx-1 inline-block">
                        <a class="font-semibold transition-all text-secondary-500 hover:text-secondary-700"
                            href="{{ $breadcrumb['url'] }}" wire:navigate>
                            {{ $breadcrumb['title'] }}
                        </a>
                    </li>
                @else
                    <li class="after:content-['/'] last:after:content-none after:mx-1 inline-block">
                        {{ $breadcrumb['title'] }}
                    </li>
                @endif
            @endforeach
        </ul>
    </x-container>
</div>
