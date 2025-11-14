@props([
    'type' => 'text', // text, circle, rectangle, card, list, table
    'lines' => 3,
    'width' => 'full', // full, 3/4, 1/2, 1/3, 1/4
    'height' => 'md', // xs, sm, md, lg, xl
    'animate' => true,
])

@php
    $widthClasses = [
        'full' => 'w-full',
        '3/4' => 'w-3/4',
        '1/2' => 'w-1/2',
        '1/3' => 'w-1/3',
        '1/4' => 'w-1/4',
    ];

    $heightClasses = [
        'xs' => 'h-3',
        'sm' => 'h-4',
        'md' => 'h-5',
        'lg' => 'h-6',
        'xl' => 'h-8',
    ];

    $widthClass = $widthClasses[$width] ?? $widthClasses['full'];
    $heightClass = $heightClasses[$height] ?? $heightClasses['md'];
    $animateClass = $animate ? 'animate-pulse' : '';
@endphp

<div {{ $attributes->merge(['class' => '']) }}>
    @if($type === 'text')
        <!-- Text Skeleton -->
        <div class="space-y-3">
            @for($i = 0; $i < $lines; $i++)
                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded {{ $animateClass }}"
                     style="width: {{ $i === $lines - 1 ? '75%' : '100%' }}"></div>
            @endfor
        </div>

    @elseif($type === 'circle')
        <!-- Circle Skeleton (for avatars) -->
        <div class="rounded-full bg-gray-200 dark:bg-gray-700 {{ $widthClass }} {{ $heightClass }} {{ $animateClass }}"></div>

    @elseif($type === 'rectangle')
        <!-- Rectangle Skeleton -->
        <div class="bg-gray-200 dark:bg-gray-700 rounded {{ $widthClass }} {{ $heightClass }} {{ $animateClass }}"></div>

    @elseif($type === 'card')
        <!-- Card Skeleton -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-700 {{ $animateClass }}"></div>
                <div class="flex-1 space-y-2">
                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/3 {{ $animateClass }}"></div>
                    <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/2 {{ $animateClass }}"></div>
                </div>
            </div>
            <div class="space-y-3">
                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded {{ $animateClass }}"></div>
                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded {{ $animateClass }}"></div>
                <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-3/4 {{ $animateClass }}"></div>
            </div>
        </div>

    @elseif($type === 'list')
        <!-- List Skeleton -->
        <div class="space-y-4">
            @for($i = 0; $i < $lines; $i++)
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 {{ $animateClass }}"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/3 {{ $animateClass }}"></div>
                        <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/2 {{ $animateClass }}"></div>
                    </div>
                </div>
            @endfor
        </div>

    @elseif($type === 'table')
        <!-- Table Skeleton -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        @for($i = 0; $i < 4; $i++)
                            <th class="px-6 py-3">
                                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded {{ $animateClass }}"></div>
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @for($i = 0; $i < $lines; $i++)
                        <tr>
                            @for($j = 0; $j < 4; $j++)
                                <td class="px-6 py-4">
                                    <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded {{ $animateClass }}"></div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    @endif
</div>
