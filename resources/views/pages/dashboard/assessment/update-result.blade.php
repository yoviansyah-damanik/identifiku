<div>
    <x-modal.body>
        <div class="mb-6 space-y-3 sm:space-y-4">
            <x-form.textarea-wysiwyg block :loading="$isLoading" :label="__('Conclusion')" :placeholder="__('Entry :entry', ['entry' => __('Conclusion')])" wire:model="conclusion"
                :error="$errors->first('conclusion')" required />
            <x-form.textarea-wysiwyg block :loading="$isLoading" :label="__('Advice')" :placeholder="__('Entry :entry', ['entry' => __('Advice')])" wire:model="advice"
                :error="$errors->first('advice')" required />
        </div>
    </x-modal.body>
    <x-modal.footer>
        <x-button x-on:click="closeModal" :loading="$isLoading">
            {{ __('Close') }}
        </x-button>
        <x-button color="primary" wire:click='save' :loading="$isLoading">
            {{ __('Save') }}
        </x-button>
    </x-modal.footer>
</div>

@push('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
@endpush
