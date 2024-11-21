<li x-data="{ id: '{{ $question->id }}' }"
    class="relative flex items-center justify-between gap-3 overflow-hidden bg-white border-l-8 rounded-lg shadow-md border-primary-500">
    <div class="flex flex-col flex-1 p-6 space-y-3 sm:p-8 sm:space-y-4">
        <div class="font-semibold">
            {{ $question->question }}
        </div>
        <div>
            @foreach ($question->answers as $answer)
                <div class="flex">
                    <div class="w-14">
                        {{ $answer->answer }}
                    </div>
                    <div class="flex-1">
                        {{ $answer->text }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</li>
