<x-content>
    <x-content.title :title="$class->name" :description="$class->description" />

    <div class="">
        <div class="">
            {{ $quiz->name }}
        </div>
        <div class="">
            {!! $quiz->overview !!}
        </div>
    </div>

    <div class="flex">

    </div>
</x-content>
