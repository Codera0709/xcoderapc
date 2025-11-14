@props([
    'type' => 'text', // text, circle, rectangle
    'size' => 'md', // xs, sm, md, lg, xl
    'count' => 1,
    'width' => null,
    'height' => null,
])

@php
    $sizeClasses = match($size) {
        'xs' => 'h-2',
        'sm' => 'h-3',
        'md' => 'h-4',
        'lg' => 'h-5',
        'xl' => 'h-6',
        default => 'h-4',
    };

    $typeClasses = match($type) {
        'circle' => 'rounded-full',
        'rectangle' => 'rounded',
        'text' => 'rounded-md',
        default => 'rounded-md',
    };

    $dimensionStyle = '';
    if ($width) $dimensionStyle .= "width: {$width};";
    if ($height) $dimensionStyle .= "height: {$height};";
@endphp

<div class="space-y-2">
    @for($i = 0; $i < $count; $i++)
        <div 
            {{ $attributes->merge(['class' => "bg-gray-200 dark:bg-gray-700 animate-pulse {$sizeClasses} {$typeClasses}"]) }}
            style="{{ $dimensionStyle }}"
        ></div>
    @endfor
</div>