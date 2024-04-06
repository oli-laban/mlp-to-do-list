@props(['key'])

<div class="modal__container" x-show="{{ $key }}" @close.stop="{{ $key }} = false" @keydown.escape.window="{{ $key }} = false" x-cloak>
    <div class="modal__overlay-container" x-show="{{ $key }}" @click="{{ $key }} = false" x-transition.opacity.duration.200ms>
        <div class="modal__overlay"></div>
    </div>
    <div class="card modal" x-show="{{ $key }}" x-transition x-transition:enter.duration.200ms x-transition:leave.duration.200ms>
        <div class="modal__inner">
            {{ $slot }}
        </div>

        @if ($buttons)
            <div class="modal__buttons">
                {{ $buttons }}
            </div>
        @endif
    </div>
</div>
