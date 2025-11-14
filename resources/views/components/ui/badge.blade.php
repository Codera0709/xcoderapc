@props([
    'variant' => 'default',
    'size' => 'md',
    'rounded' => 'full',
    'dot' => false
])

@php
$baseClasses = 'inline-flex items-center font-medium';

$variantClasses = match($variant) {
    'primary' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
    'secondary' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    'success' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
    'danger' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
    'warning' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
    'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
    'outline' => 'bg-transparent border border-gray-300 text-gray-700 dark:border-gray-600 dark:text-gray-300',
    'default' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'
};

$sizeClasses = match($size) {
    'xs' => 'px-2 py-0.5 text-xs',
    'sm' => 'px-2.5 py-0.5 text-xs',
    'md' => 'px-3 py-1 text-sm',
    'lg' => 'px-3.5 py-1.5 text-sm',
    default => 'px-3 py-1 text-sm'
};

$roundedClasses = match($rounded) {
    'none' => 'rounded-none',
    'sm' => 'rounded-sm',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'full' => 'rounded-full',
    default => 'rounded-full'
};

$dotColor = match($variant) {
    'primary' => 'bg-indigo-600 dark:bg-indigo-400',
    'success' => 'bg-green-600 dark:bg-green-400',
    'danger' => 'bg-red-600 dark:bg-red-400',
    'warning' => 'bg-yellow-600 dark:bg-yellow-400',
    'info' => 'bg-blue-600 dark:bg-blue-400',
    'outline' => 'bg-gray-600 dark:bg-gray-400',
    default => 'bg-gray-600 dark:bg-gray-400'
};

$classes = $baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses . ' ' . $roundedClasses;
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($dot)
        <span class="w-2 h-2 rounded-full mr-1.5 {{ $dotColor }}"></span>
    @endif
    {{ $slot }}
</span>
