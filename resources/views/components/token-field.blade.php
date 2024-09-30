<div x-data="{
    showToken: false,
    text: '{{ $school->token }}',
    copyToken() {
        navigator.clipboard.writeText(this.text);
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: 'success',
            title: '{{ __(':attribute copied successfully.', ['attribute' => __('Token')]) }}'
        });
    },
    copyLink() {
        navigator.clipboard.writeText('{{ route('registration.student.final', ['school' => $school->id, 'token' => $school->token]) }}');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: 'success',
            title: '{{ __(':attribute copied successfully.', ['attribute' => __('Token')]) }}'
        });
    }
}" class="inline-flex flex-col items-center gap-1">
    <x-tooltip :title="__('Token that will be used to register students.')">
        <x-button base="flex gap-3 items-center justify-between" color="primary-transparent" size="sm"
            x-on:click="showToken = !showToken">
            <div class="w-full px-3 min-w-36 2xl:min-w-44 max-w-full text-sm">
                <div x-show="showToken">
                    {{ $school->token }}
                </div>
                <div x-show="!showToken">
                    {{ Str::of($school->token)->replaceMatches('/\S/', fn($matches) => '*') }}
                </div>
            </div>
            <span class="i-ph-eye" x-show="showToken"></span>
            <span class="i-ph-eye-closed" x-show="!showToken"></span>
        </x-button>
    </x-tooltip>

    <div class="flex gap-1">
        <x-tooltip :title="__('Copy')">
            <x-button color="primary-transparent" size="sm" x-on:click="copyToken()" icon="i-ph-clipboard" />
        </x-tooltip>
        <x-tooltip :title="__('Copy Link')">
            <x-button color="primary-transparent" size="sm" x-on:click="copyLink()" icon="i-ph-link" />
        </x-tooltip>
        <x-tooltip :title="__('Regenerate')">
            <x-button color="primary-transparent" size="sm"
                x-on:click="$wire.regenerateToken('{{ $school->id }}')" icon="i-ph-password" />
        </x-tooltip>
    </div>
</div>
