@props([
    'src' => null,
    'alt' => 'Avatar',
    'name' => null,
    'size' => 'md', // xs, sm, md, lg, xl
    'rounded' => 'full', // none, sm, md, lg, xl, full
    'status' => null, // online, offline, away, busy
    'border' => false,
    'initials' => null,
])

@php
    $sizeClasses = match($size) {
        'xs' => 'w-6 h-6 text-xs',
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
        'xl' => 'w-16 h-16 text-xl',
        default => 'w-10 h-10 text-base',
    };

    $roundedClasses = match($rounded) {
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        'full' => 'rounded-full',
        default => 'rounded-full',
    };

    $borderClass = $border ? 'ring-2 ring-white dark:ring-gray-800' : '';

    // Generate initials if not provided
    if (!$initials && $name) {
        $nameParts = explode(' ', $name);
        $initials = strtoupper(substr($nameParts[0], 0, 1));
        if (count($nameParts) > 1) {
            $initials .= strtoupper(substr($nameParts[count($nameParts) - 1], 0, 1));
        }
    }

    // Get status color
    $statusColor = match($status) {
        'online' => 'bg-green-500',
        'offline' => 'bg-gray-400',
        'away' => 'bg-yellow-500',
        'busy' => 'bg-red-500',
        default => '',
    };
@endphp

<div class="relative inline-block">
    @if($src)
        <img 
            src="{{ $src }}" 
            alt="{{ $alt }}" 
            {{ $attributes->merge(['class' => "{$sizeClasses} {$roundedClasses} {$borderClass} object-cover"]) }}
        />
    @else
        <div 
            {{ $attributes->merge(['class' => "{$sizeClasses} {$roundedClasses} {$borderClass} bg-indigo-500 text-white flex items-center justify-center font-medium"]) }}
        >
            {{ $initials ?: substr($name, 0, 1) ?: '?' }}
        </div>
    @endif

    @if($status && $statusColor)
        <div class="absolute bottom-0 right-0 w-1/3 h-1/3 bg-white dark:bg-gray-800 rounded-full border-2 border-white dark:border-gray-800"></div>
        <div class="absolute bottom-0 right-0 w-1/3 h-1/3 {{ $statusColor }} rounded-full"></div>
    @endif
</div>