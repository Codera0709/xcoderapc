@props([
    'title' => '',
    'value' => '',
    'icon' => null,
    'iconBg' => 'indigo',
    'change' => null,
    'changeType' => 'increase', // increase, decrease, neutral
    'description' => null,
    'href' => null,
])

@php
    $iconBgColors = [
        'indigo' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400',
        'blue' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
        'green' => 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
        'red' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
        'yellow' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400',
        'purple' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
        'pink' => 'bg-pink-100 dark:bg-pink-900/30 text-pink-600 dark:text-pink-400',
        'gray' => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400',
    ];

    $changeColors = [
        'increase' => 'text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/20',
        'decrease' => 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20',
        'neutral' => 'text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50',
    ];

    $tag = $href ? 'a' : 'div';
@endphp

<{{ $tag }} {{ $href ? "href={$href}" : '' }} class="block bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 {{ $href ? 'hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600 transition-all' : '' }}">
    <div class="flex items-center justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">{{ $title }}</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $value }}</p>

            @if($change !== null)
                <div class="flex items-center gap-1 mt-2">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium {{ $changeColors[$changeType] }}">
                        @if($changeType === 'increase')
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                            </svg>
                        @elseif($changeType === 'decrease')
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                            </svg>
                        @else
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        @endif
                        {{ $change }}
                    </span>
                    @if($description)
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $description }}</span>
                    @endif
                </div>
            @elseif($description)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $description }}</p>
            @endif
        </div>

        @if($icon)
            <div class="flex-shrink-0 ml-4">
                <div class="p-3 rounded-lg {{ $iconBgColors[$iconBg] ?? $iconBgColors['indigo'] }}">
                    {!! $icon !!}
                </div>
            </div>
        @endif
    </div>

    @if(isset($footer))
        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>
