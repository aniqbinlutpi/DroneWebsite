@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-gray-800 border border-gray-700'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
        break;
}

switch ($width) {
    case '48':
        $widthClasses = 'w-48';
        break;
}
@endphp

<div class="relative" x-data="{ 
    open: false,
    toggle() {
        this.open = !this.open;
        if (this.open) {
            this.$nextTick(() => {
                const dropdown = this.$refs.dropdown;
                const trigger = this.$refs.trigger;
                const rect = trigger.getBoundingClientRect();
                dropdown.style.top = (rect.bottom + window.scrollY + 8) + 'px';
                dropdown.style.right = (window.innerWidth - rect.right) + 'px';
            });
        }
    }
}" @click.outside="open = false" @close.stop="open = false">
    <div @click="toggle()" x-ref="trigger">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-ref="dropdown"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="dropdown-content fixed {{ $widthClasses }} rounded-md shadow-lg ring-1 ring-gray-600 ring-opacity-50"
            style="z-index: 2147483647 !important; position: fixed !important; transform: translateZ(0) !important;"
            @click="open = false">
        <div class="{{ $contentClasses }} rounded-md">
            {{ $content }}
        </div>
    </div>
</div>
