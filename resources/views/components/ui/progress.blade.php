@props([
    'value' => 0,
    'max' => 100,
    'color' => 'indigo',
    'size' => 'md',
    'showLabel' => false,
    'animated' => false,
    'striped' => false
])

@php
$percentage = ($value / $max) * 100;

$colorClasses = match($color) {
    'indigo' => 'bg-indigo-600',
    'blue' => 'bg-blue-600',
    'green' => 'bg-green-600',
    'red' => 'bg-red-600',
    'yellow' => 'bg-yellow-500',
    'purple' => 'bg-purple-600',
    'pink' => 'bg-pink-600',
    default => 'bg-indigo-600'
};

$sizeClasses = match($size) {
    'xs' => 'h-1',
    'sm' => 'h-2',
    'md' => 'h-3',
    'lg' => 'h-4',
    'xl' => 'h-6',
    default => 'h-3'
};

$stripedClass = $striped ? 'bg-gradient-to-r from-transparent via-white/20 to-transparent bg-[length:1rem_100%]' : '';
$animatedClass = $animated ? 'animate-pulse' : '';
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($showLabel)
        <div class="flex justify-between items-center mb-1">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $slot }}</span>
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ round($percentage) }}%</span>
        </div>
    @endif

    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden {{ $sizeClasses }}">
        <div
            class="h-full rounded-full transition-all duration-300 ease-out {{ $colorClasses }} {{ $stripedClass }} {{ $animatedClass }}"
            style="width: {{ $percentage }}%"
            role="progressbar"
            aria-valuenow="{{ $value }}"
            aria-valuemin="0"
            aria-valuemax="{{ $max }}"
        ></div>
    </div>
</div>
