@props([
    'count' => 0,
    'max' => 99,
    'color' => 'red', // red, blue, green, yellow, purple, gray
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left
    'dot' => false,
    'ping' => false,
])

@php
    $colorClasses = [
        'red' => 'bg-red-500 text-white',
        'blue' => 'bg-blue-500 text-white',
        'green' => 'bg-green-500 text-white',
        'yellow' => 'bg-yellow-500 text-white',
        'purple' => 'bg-purple-500 text-white',
        'gray' => 'bg-gray-500 text-white',
    ];

    $positionClasses = [
        'top-right' => 'top-0 right-0 -translate-y-1/2 translate-x-1/2',
        'top-left' => 'top-0 left-0 -translate-y-1/2 -translate-x-1/2',
        'bottom-right' => 'bottom-0 right-0 translate-y-1/2 translate-x-1/2',
        'bottom-left' => 'bottom-0 left-0 translate-y-1/2 -translate-x-1/2',
    ];

    $colorClass = $colorClasses[$color] ?? $colorClasses['red'];
    $positionClass = $positionClasses[$position] ?? $positionClasses['top-right'];

    $displayCount = $count > $max ? "{$max}+" : $count;
@endphp

<div class="relative inline-flex">
    {{ $slot }}

    @if($count > 0 || $dot)
        <span class="absolute {{ $positionClass }} inline-flex items-center justify-center">
            @if($dot)
                <!-- Dot Badge -->
                <span class="relative flex h-3 w-3">
                    @if($ping)
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $colorClass }} opacity-75"></span>
                    @endif
                    <span class="relative inline-flex rounded-full h-3 w-3 {{ $colorClass }}"></span>
                </span>
            @else
                <!-- Count Badge -->
                <span class="relative flex">
                    @if($ping)
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $colorClass }} opacity-75"></span>
                    @endif
                    <span class="relative inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none rounded-full {{ $colorClass }} min-w-[1.25rem]">
                        {{ $displayCount }}
                    </span>
                </span>
            @endif
        </span>
    @endif
</div>
