<div class="pt-24 pb-40 bg-top bg-no-repeat bg-cover lg:pt-52 bg-cloud">
    <x-container>
        <div class="grid grid-cols-2 gap-x-3 gap-y-9 lg:gap-y-16 md:grid-cols-3">
            @foreach ($counters as $counter)
                <x-main.counter-item :count="$counter['count']" :title="$counter['title']" :description="$counter['description']" />
            @endforeach
        </div>
    </x-container>
</div>
