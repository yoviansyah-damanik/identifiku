<div x-data="{
    showLoginModal: true,
    closeModal() {
        this.showLoginModal = false;
        document.body.classList.remove('overlay');
    }
}"
    x-on:toggle-login-modal.window="showLoginModal = !showLoginModal; document.body.classList.toggle('overlay');"
    id="login-modal" data-modal="login-modal" role="modal" {{ $attributes }}>
    <div class="{{ $backdropClass }}" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90" x-show="showLoginModal">
        <div class="{{ $modalClass }}" x-on:click.outside="closeModal">
            <div class="absolute right-3 top-3">
                <x-button color="transparent" size="sm" x-on:click="closeModal" base="min-h-0 min-w-0 !p-0">
                    <span class="i-ph-x-bold size-4"></span>
                </x-button>
            </div>
            <div class="flex h-96">
                <div class="hidden w-64 lg:w-96 bg-primary-700 md:block"></div>
                <div class="flex-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
