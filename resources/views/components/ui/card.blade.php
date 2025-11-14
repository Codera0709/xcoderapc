@props([
    'header' => null,
    'footer' => null,
    'padding' => true,
    'shadow' => true,
    'border' => true
])

@php
$classes = 'bg-white dark:bg-gray-800 rounded-lg';
if ($shadow) $classes .= ' shadow-md';
if ($border) $classes .= ' border border-gray-200 dark:border-gray-700';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if($header)
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            {{ $header }}
        </div>
    @endif

    <div class="{{ $padding ? 'p-6' : '' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 rounded-b-lg">
            {{ $footer }}
        </div>
    @endif
</div>
