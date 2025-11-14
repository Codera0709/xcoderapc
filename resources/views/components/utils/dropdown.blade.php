@props([
    'align' => 'right',
    'width' => '48',
    'trigger' => null
])

@php
$alignmentClasses = match ($align) {
    'left' => 'origin-top-left left-0',
    'top' => 'origin-top',
    default => 'origin-top-right right-0',
};

$widthClasses = match ($width) {
    '48' => 'w-48',
    '64' => 'w-64',
    '96' => 'w-96',
    default => 'w-48',
};
@endphp

<div x-data="{ open: false }" @click.away="open = false" class="relative">
    <!-- Trigger -->
    <div @click="open = !open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <!-- Dropdown Content -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $widthClasses }} rounded-md shadow-lg {{ $alignmentClasses }}"
        style="display: none;"
        @click="open = false"
    >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 bg-white dark:bg-gray-800">
            <div class="py-1">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
