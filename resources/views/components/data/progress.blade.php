@props([
    'value' => 0,
    'max' => 100,
    'color' => 'indigo', // indigo, blue, green, red, yellow, purple, pink
    'size' => 'md', // xs, sm, md, lg, xl
    'label' => null,
    'showLabel' => false,
    'animated' => false,
    'striped' => false,
])

@php
    $colorClasses = [
        'indigo' => 'bg-indigo-500',
        'blue' => 'bg-blue-500',
        'green' => 'bg-green-500',
        'red' => 'bg-red-500',
        'yellow' => 'bg-yellow-500',
        'purple' => 'bg-purple-500',
        'pink' => 'bg-pink-500',
    ];

    $sizeClasses = [
        'xs' => 'h-1',
        'sm' => 'h-2',
        'md' => 'h-3',
        'lg' => 'h-4',
        'xl' => 'h-5',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['indigo'];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];

    $animatedClass = $animated ? 'animate-pulse' : '';
    $stripedClass = $striped ? 'bg-striped' : '';
@endphp

<div {{ $attributes->merge(['class' => 'w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden']) }}>
    <div 
        class="h-full {{ $colorClass }} {{ $sizeClass }} {{ $animatedClass }} {{ $stripedClass }} transition-all duration-300 ease-out"
        style="width: {{ min(100, max(0, $value)) }}%;"
    ></div>
    @if($showLabel && $label)
        <div class="mt-1 text-xs text-gray-600 dark:text-gray-400">
            {{ $label }}
        </div>
    @endif
</div>