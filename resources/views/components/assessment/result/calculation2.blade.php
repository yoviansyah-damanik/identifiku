<div class="flex flex-col gap-3 lg:gap-4" x-data="{
    indicatorExpanded: false,
    recommendationExpanded: false,
    conclusionExpanded: false,
    adviceExpanded: false,
}">
    <div class="flex flex-col gap-3 lg:gap-4 lg:flex-row">
        <div class="flex-1 w-full p-6 overflow-hidden bg-white rounded-lg shadow-md lg:p-8">
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('Student')]) }}
                </div>
                <div class="flex-1 font-semibold text-secondary-500">
                    {{ $assessment->student->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('School')]) }}
                </div>
                <div class="flex-1">
                    {{ $assessment->student->school->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('Class')]) }}
                </div>
                <div class="flex-1">
                    {{ $assessment->class->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':name Name', ['name' => __('Assessment')]) }}
                </div>
                <div class="flex-1 font-semibold text-secondary-500">
                    {{ $assessment->quiz->name }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __(':type Type', ['type' => __('Assessment')]) }}
                </div>
                <div class="flex-1 font-semibold">
                    {{ __(Str::headline($assessment->quiz->type)) }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __('Started On') }}
                </div>
                <div class="flex-1">
                    {{ $assessment->created_at->translatedFormat('d M Y H:i:s') }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __('Assessed On') }}
                </div>
                <div class="flex-1">
                    {{ $assessment->result->updated_at->translatedFormat('d M Y H:i:s') }}
                </div>
            </div>
            <div class="flex gap-3 lg:gap-4">
                <div class="w-32 font-bold lg:w-52 text-primary-500">
                    {{ __('Status') }}
                </div>
                <div class="flex-1">
                    @if ($assessment)
                        @if ($assessment->isDone)
                            <div class="text-green-500">
                                {{ __('Assessment result completed') }}
                            </div>
                        @elseif ($assessment->isSubmitted)
                            <span class="text-yellow-500">
                                {{ __('You have completed this assessment') }}!
                            </span>
                            {{ __('Assessment results are being processed') }}
                        @else
                            @if (is_null($assessment->remainingTime))
                                <div class="text-blue-500">
                                    {{ __('Assessments have been made, but not yet started') }}
                                </div>
                            @else
                                @if ($assessment->remainingTime > 0)
                                    <div class="text-yellow-600">
                                        {{ __('You can take this assessment with :time left', ['time' => GeneralHelper::getTime($assessment->remainingTime)]) }}
                                    </div>
                                @elseif($assessment->remainingTime == 0)
                                    <span class="text-red-500">
                                        {{ __('Time is up') }}!
                                    </span>
                                    {{ __('Assessment results are being processed') }}
                                @endif
                            @endif
                        @endif
                    @else
                        {{ __('You have never done this assessment') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="flex-1 w-full p-6 overflow-hidden rounded-lg shadow-md bg-primary-500 lg:p-8">
            <div class="mb-5 text-lg font-bold text-center text-secondary-500">
                {{ __('Dominance') }}
            </div>

            <div class="px-5 py-6 mb-5 bg-white rounded-lg">
                <div
                    class="text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-br from-primary-500 to-secondary-500">
                    {{ $assessment->result->dominance->title }}
                </div>
            </div>
            <div class="text-sm italic font-light text-center text-white">
                {{ __('You can see the details of the assessment results at the bottom of this page') }}
            </div>
            @if (auth()->user()->isTeacher && $assessment->class->teacher->id == auth()->user()?->teacher->id)
                <div class="mt-1 text-center">
                    <x-button size="sm" radius="rounded-full" color="secondary"
                        x-on:click="$dispatch('toggle-show-detail-modal')">
                        {{ __('Edit :edit', ['edit' => __('Message')]) }}
                    </x-button>
                </div>
            @endif
        </div>
    </div>
    <div class="flex flex-col items-start w-full gap-3 lg:gap-4 lg:flex-row">
        <div class="flex flex-col w-full gap-3 lg:w-[24rem] xl:w-[36rem] sm:flex-row lg:flex-col lg:gap-4">
            {{-- Classmate Result --}}
            <div class="w-full p-6 overflow-hidden bg-white rounded-lg shadow-md sm:flex-1 lg:p-8">
                <div class="mb-5 text-lg font-bold text-center text-primary-500">
                    {{ __('Classmate Result') }}
                </div>
                <div class="max-h-[40dvh] overflow-auto">
                    @forelse ($assessment->class->assessments()->where('student_id','!=', $assessment->student_id)->where('quiz_id',$assessment->quiz->id)->get() as $item)
                        <div class="px-3 py-5 border-b last:border-b-0">
                            <div class="font-semibold text-secondary-500">
                                {{ $item->student->name }}
                            </div>
                            {{ $item->result->details->where('is_highlight', true)->first()->title }}
                        </div>
                    @empty
                        <x-no-data />
                    @endforelse
                </div>
            </div>
        </div>
        {{-- Result Detail --}}
        <div class="flex flex-col flex-1 w-full gap-3 lg:gap-4">
            <x-accordion isOpen :title="__('Indicator')">
                <div class="trix-zone">
                    {!! $assessment->result->dominance->indicator !!}
                </div>
            </x-accordion>
            <x-accordion isOpen :title="__('Recommendation')">
                <div class="trix-zone">
                    {!! $assessment->result->dominance->recommendation !!}
                </div>
            </x-accordion>
            <x-accordion isOpen :title="__('Conclusion')">
                <div class="trix-zone">
                    {!! $assessment->result->conclusion ?? __('No messages added yet') !!}
                </div>
            </x-accordion>
            <x-accordion isOpen :title="__('Advice')">
                <div class="trix-zone">
                    {!! $assessment->result->advice ?? __('No messages added yet') !!}
                </div>
            </x-accordion>
        </div>
    </div>
</div>
