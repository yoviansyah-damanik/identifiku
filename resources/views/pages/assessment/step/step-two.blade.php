<div class="flex flex-col lg:h-full lg:flex-row" x-data="{
    interval: null,
    expiry: Date.parse('{{ now()->sub($assessment->started_on->addMinutes($assessment->quiz->estimation_time)) }}'),
    remaining: null,
    timeout() {
        $wire.dispatch('setStep', { step: 3 });
        clearInterval(this.interval);
        {{-- Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success'
        }); --}}
    },
    init() {
        this.setRemaining()
        this.interval = setInterval(() => {
            this.setRemaining();
            console.log(this.remaining)
        }, 1000);
    },
    setRemaining() {
        if (this.remaining == 1)
            return this.timeout();

        const diff = this.expiry - new Date().getTime();
        this.remaining = parseInt(diff / 1000);
    },
    days() {
        return {
            value: this.remaining / 86400,
            remaining: this.remaining % 86400
        };
    },
    hours() {
        return {
            value: this.days().remaining / 3600,
            remaining: this.days().remaining % 3600
        };
    },
    minutes() {
        return {
            value: this.hours().remaining / 60,
            remaining: this.hours().remaining % 60
        };
    },
    seconds() {
        return {
            value: this.minutes().remaining,
        };
    },
    format(value) {
        return ('0' + parseInt(value)).slice(-2)
    },
    time() {
        return {
            days: this.format(this.days().value),
            hours: this.format(this.hours().value),
            minutes: this.format(this.minutes().value),
            seconds: this.format(this.seconds().value),
        }
    },
}">
    <div class="relative flex flex-col shadow lg:w-80 xl:w-96">
        <div class="flex lg:block">
            {{-- <x-button base="flex justify-center items-center gap-1 lg:w-full w-14" size="sm" :href="route('dashboard.student-class.show', [
                'class' => $assessment->class,
                'activeQuizUrl' => $assessment->quiz->slug,
            ])"
                color="secondary" radius="rounded-none">
                <span class="i-ph-arrow-left"></span>
                <span class="hidden lg:block">
                    {{ __('Back') }}
                </span>
            </x-button> --}}
            <div class="flex-1 px-6 py-4 text-sm sm:px-8 lg:py-8 bg-gradient-to-br from-primary-500 to-primary-700">
                <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':name Name', ['name' => __('Class')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ $assessment->class->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':name Name', ['name' => __('Quiz')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ $assessment->quiz->name }}
                    </div>
                </div>
                <div class="flex">
                    <div class="font-semibold w-28 text-secondary-500">
                        {{ __(':type Type', ['type' => __('Quiz')]) }}
                    </div>
                    <div class="flex-1 text-secondary-50">
                        {{ __(Str::headline($assessment->quiz->type)) }}
                    </div>
                </div>
            </div>
        </div>
        <div
            class="flex flex-col flex-1 w-full px-6 py-4 space-y-3 bg-white shadow lg:shadow-none lg:relative lg:left-auto sm:px-8 lg:py-8 sm:space-y-4">
            <div class="flex gap-8 overflow-auto lg:space-y-4 lg:overflow-clip lg:gap-0 lg:block snap-x lg:snap-none">
                @foreach ($questions as $group)
                    <div class="space-y-3 snap-start lg:snap-none">
                        <div class="font-semibold text-primary-500 text-nowrap">
                            {{ GeneralHelper::numberToRoman($group['order']) }}.
                            {{ $group['name'] }}
                        </div>
                        <div class="flex gap-1 lg:flex-wrap snap-x lg:snap-none">
                            @foreach ($group['questions'] as $question)
                                <x-button wire:click="setQuestion('{{ $group['id'] }}','{{ $question['id'] }}')"
                                    square radius="rounded-full" base="snap-start lg:snap-none w-8" size="sm"
                                    :color="$questionActive['id'] == $question['id']
                                        ? 'secondary'
                                        : (in_array($question['id'], $result->pluck('question_id')->toArray())
                                            ? 'primary'
                                            : 'primary-transparent')">
                                    {{ $question['order'] }}
                                </x-button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="relative flex flex-col justify-between gap-3 overflow-auto lg:flex-1 sm:gap-4">
        <div
            class="absolute top-0 flex items-center flex-1 gap-1 px-3 py-1 text-xs font-semibold bg-white shadow right-5 lg:text-base rounded-b-md">
            {{ __('Remaining Time') }}
            <div class="flex items-center justify-end w-12 lg:w-16">
                {{-- <div x-text="time().days"></div> --}}
                <div x-text="time().hours">00</div>
                <div class="before:content-[':']" x-text="time().minutes">00</div>
                <div class="before:content-[':']" x-text="time().seconds">00</div>
            </div>
        </div>

        <div class="px-6 py-4 mb-3 font-semibold lg:py-8 bg-primary-50 text-primary-500">
            <div class="text-base">
                {{ GeneralHelper::numberToRoman($groupActive['order']) }}. {{ $groupActive['name'] }}
            </div>
            <div class="text-sm font-light">
                {{ $groupActive['description'] }}
            </div>
        </div>
        <div class="flex items-start flex-1 min-h-[min-content] px-6 py-4 pb-20 overflow-auto lg:py-8">
            <div class="w-full">
                <div class="flex">
                    <div class="w-6 text-base font-semibold g:text-lg xl:text-xl lg:w-12">
                        {{ $questionActive['order'] }}.
                    </div>
                    <div class="flex-1 text-base lg:text-lg xl:text-xl">
                        <div class="mb-3 font-semibold">
                            {{ $questionActive['question'] }}
                        </div>
                        <div class="md:[column-count:2] [column-gap:1.5rem]">
                            @foreach ($questionActive['answers'] as $answer)
                                <div @class([
                                    'flex cursor-pointer hover:text-secondary-500',
                                    'font-bold text-secondary-500' => in_array(
                                        $answer['id'],
                                        $result->pluck('answer_choice_id')->toArray()),
                                ])
                                    wire:click="setAnswer('{{ $questionActive['id'] }}','{{ $answer['id'] }}')">
                                    <div class="w-14">
                                        {{ $answer['answer'] }}
                                    </div>
                                    <div class="flex-1 text-start">
                                        {{ $answer['text'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed inset-x-0 bottom-0 flex items-stretch justify-end lg:p-8 lg:gap-3 lg:relative">
            <div class="flex items-stretch justify-center flex-1 lg:flex-none lg:gap-1">
                <x-button :loading="!$prevButton" wire:click="prev" base="lg:!rounded-full rounded-none" color="red" block
                    icon="i-ph-arrow-left" :withBorderIcon="false">
                    <span class="hidden lg:block">{{ __('Previous') }}</span>
                    <span class="block lg:hidden"></span>
                </x-button>
                <x-button :loading="!$nextButton" wire:click="next" base="lg:!rounded-full rounded-none" color="green" block
                    icon="i-ph-arrow-right" iconPosition="right" :withBorderIcon="false">
                    <span class="hidden lg:block">{{ __('Next') }}</span>
                    <span class="block lg:hidden"></span>
                </x-button>
            </div>
            <x-button wire:click="hasDone" base="max-w-52 lg:max-w-64 lg:!rounded-full rounded-none" block
                color="primary">
                {{ __('Submit') }}
            </x-button>
        </div>
    </div>
</div>
