@props([
    'size' => 'md', // xs, sm, md, lg, xl
    'color' => 'indigo', // indigo, blue, green, red, yellow, purple, white, gray
    'type' => 'circular', // circular, dots, pulse, bars
])

@php
    $sizeClasses = [
        'xs' => 'w-4 h-4',
        'sm' => 'w-6 h-6',
        'md' => 'w-8 h-8',
        'lg' => 'w-10 h-10',
        'xl' => 'w-12 h-12',
    ];

    $colorClasses = [
        'indigo' => 'text-indigo-600 dark:text-indigo-400',
        'blue' => 'text-blue-600 dark:text-blue-400',
        'green' => 'text-green-600 dark:text-green-400',
        'red' => 'text-red-600 dark:text-red-400',
        'yellow' => 'text-yellow-600 dark:text-yellow-400',
        'purple' => 'text-purple-600 dark:text-purple-400',
        'white' => 'text-white',
        'gray' => 'text-gray-600 dark:text-gray-400',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $colorClass = $colorClasses[$color] ?? $colorClasses['indigo'];
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center justify-center']) }}>
    @if($type === 'circular')
        <!-- Circular Spinner -->
        <svg class="animate-spin {{ $sizeClass }} {{ $colorClass }}" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

    @elseif($type === 'dots')
        <!-- Dots Spinner -->
        <div class="flex gap-1">
            <div class="w-2 h-2 rounded-full {{ $colorClass }} bg-current animate-bounce" style="animation-delay: 0ms;"></div>
            <div class="w-2 h-2 rounded-full {{ $colorClass }} bg-current animate-bounce" style="animation-delay: 150ms;"></div>
            <div class="w-2 h-2 rounded-full {{ $colorClass }} bg-current animate-bounce" style="animation-delay: 300ms;"></div>
        </div>

    @elseif($type === 'pulse')
        <!-- Pulse Spinner -->
        <div class="{{ $sizeClass }} rounded-full {{ $colorClass }} bg-current animate-pulse"></div>

    @elseif($type === 'bars')
        <!-- Bars Spinner -->
        <div class="flex gap-1 items-end {{ $sizeClass }}">
            <div class="w-1 bg-current {{ $colorClass }} animate-pulse rounded-full" style="height: 40%; animation-delay: 0ms;"></div>
            <div class="w-1 bg-current {{ $colorClass }} animate-pulse rounded-full" style="height: 60%; animation-delay: 150ms;"></div>
            <div class="w-1 bg-current {{ $colorClass }} animate-pulse rounded-full" style="height: 80%; animation-delay: 300ms;"></div>
            <div class="w-1 bg-current {{ $colorClass }} animate-pulse rounded-full" style="height: 100%; animation-delay: 450ms;"></div>
            <div class="w-1 bg-current {{ $colorClass }} animate-pulse rounded-full" style="height: 80%; animation-delay: 600ms;"></div>
        </div>
    @endif

    @if(isset($slot) && !empty(trim($slot)))
        <span class="ml-2 {{ $colorClass }} text-sm font-medium">
            {{ $slot }}
        </span>
    @endif
</div>
