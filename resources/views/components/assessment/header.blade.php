<div x-data="{
    time: new Date().toLocaleTimeString('en-GB'),
    init() {
        setInterval(() => {
            this.time = new Date().toLocaleTimeString('en-GB');
        }, 1000);
    }
}"
    class="flex items-center justify-between w-full px-5 py-2 shadow bg-gradient-to-b from-primary-500 to-primary-700">
    <div x-text="time" class="text-2xl font-semibold text-secondary-50"></div>
    <div class="flex items-center gap-1 text-end text-secondary-50">
        <span class="i-ph-user"></span>
        <div class="truncate max-w-40">
            {{ auth()->user()->student->name }}
        </div>
    </div>
</div>
