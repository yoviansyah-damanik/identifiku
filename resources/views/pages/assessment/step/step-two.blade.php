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
        {{-- GROUPS --}}
        <x-dynamic-component :component="'assessment.step.' . Str::lower($assessment->quiz->assessmentRule->type) . '.group'" :groups="$questions" :$questionActive :$result />
        {{-- END GROUPS --}}

    </div>

    <div class="relative flex flex-col justify-between gap-3 overflow-auto lg:flex-1 sm:gap-4">
        <div
            class="absolute top-0 flex items-center flex-1 gap-1 px-3 py-1 text-xs font-semibold bg-white shadow right-5 lg:text-base rounded-b-md">
            {{ __('Remaining Time') }}
            <div class="flex items-center justify-end" :class="time().days != '00' ? 'w-16 lg:w-24' : 'lg:w-16 w-12'">
                <div x-show="time().days != '00'" x-text="time().days">00</div>
                <div :class="time().days != '00' ? `before:content-[':']` : ``" x-text="time().hours">00</div>
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
        {{-- ACTIVE QUESTION --}}
        <x-dynamic-component :component="'assessment.step.' . Str::lower($assessment->quiz->assessmentRule->type) . '.question'" :$questionActive :$result />
        {{-- END ACTIVE QUESTION --}}

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
