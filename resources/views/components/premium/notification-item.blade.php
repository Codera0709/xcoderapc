@props([
    'title' => '',
    'message' => '',
    'time' => '',
    'type' => 'info', // info, success, warning, error
    'unread' => true,
])

@php
    $typeClasses = [
        'info' => 'border-l-blue-500',
        'success' => 'border-l-green-500',
        'warning' => 'border-l-yellow-500',
        'error' => 'border-l-red-500',
    ][$type] ?? 'border-l-blue-500';
    
    $unreadClass = $unread ? 'bg-gray-50 dark:bg-gray-800/70 font-semibold' : 'bg-white dark:bg-gray-800';
@endphp

<div {{ $attributes->merge(['class' => "border-l-4 p-4 {$typeClasses} {$unreadClass}"]) }}>
    <div class="flex justify-between">
        <div class="flex items-center">
            @if($unread)
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
            @endif
            <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $title }}</h4>
        </div>
        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $time }}</span>
    </div>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $message }}</p>
</div>