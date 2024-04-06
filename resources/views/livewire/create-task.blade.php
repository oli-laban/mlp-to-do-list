<div>
    <form wire:submit.prevent="submit">
        <input type="text" placeholder="Insert task name" class="input" wire:model="text">
        @error('text')
            <small class="validation-error">{{ $message }}</small>
        @enderror
        <x-button class="create-task__submit">Add</x-button>
        <div
            class="create-task__message"
            x-data="{ show: false, timeout: null }"
            x-init="$wire.on('task-added', () => { clearTimeout(timeout); show = true; timeout = setTimeout(() => { show = false }, 3000); })"
            x-show="show"
            x-transition.opacity.duration.200ms
            x-cloak
        >
            Task added!
        </div>
    </form>
</div>
