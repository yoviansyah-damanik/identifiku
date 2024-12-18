<div <div x-data="{
    id: $id('subtitle')
}" :id="id"
    class="mb-5 text-base font-normal text-center text-shadow-sm shadow-primary-50 max-w-[80%] sm:max-w-[70%] mx-auto">
    @if ($slot->isEmpty())
        {{ $text }}
    @else
        {{ $slot }}
    @endif
</div>
