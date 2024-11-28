<div class="py-12">
    <x-container>
        <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @foreach ($counters as $counter)
                <x-main.counter-item :count="$counter['count']" :title="$counter['title']" :description="$counter['description']" />
            @endforeach
        </div>
    </x-container>
</div>
