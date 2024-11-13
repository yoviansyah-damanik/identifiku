<div x-data="{
    showToken: false,
    text: '{{ $school->token }}',
    fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement('textarea');
        textArea.value = text;

        // Avoid scrolling to bottom
        textArea.style.top = '0';
        textArea.style.left = '0';
        textArea.style.position = 'fixed';

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Fallback: Copying text command was ' + msg);
        } catch (err) {
            console.error('Fallback: Oops, unable to copy', err);
        }

        document.body.removeChild(textArea);
    },
    copyToken() {
        if (!navigator.clipboard) {
            this.fallbackCopyTextToClipboard(this.text);
        } else {
            navigator.clipboard.writeText(this.text);
        }

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
    copyLink(type) {
        const text = type == 'student' ? '{{ route('registration.student.final', ['school' => $school->id, 'token' => $school->token]) }}' : '{{ route('registration.teacher.final', ['school' => $school->id, 'token' => $school->token]) }}';

        if (!navigator.clipboard) {
            this.fallbackCopyTextToClipboard(text);
        } else {
            navigator.clipboard.writeText(text);
        }

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
            <div class="w-full max-w-full px-3 text-sm min-w-36 2xl:min-w-44">
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
        <x-tooltip :title="__('Copy Link for Student')">
            <x-button color="primary-transparent" size="sm" x-on:click="copyLink('student')" icon="i-ph-link" />
        </x-tooltip>
        <x-tooltip :title="__('Copy Link for Teacher')">
            <x-button color="primary-transparent" size="sm" x-on:click="copyLink('teacher')" icon="i-ph-link" />
        </x-tooltip>
        <x-tooltip :title="__('Regenerate')">
            <x-button color="primary-transparent" size="sm"
                x-on:click="$wire.regenerateToken('{{ $school->id }}')" icon="i-ph-password" />
        </x-tooltip>
    </div>
</div>
