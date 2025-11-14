@props([
    'items' => [],
    'variant' => 'default', // default, compact
])

<div class="flow-root">
    <ul class="-mb-8">
        @foreach($items as $index => $item)
            @php
                $isLast = $index === count($items) - 1;

                // Extract item properties
                $icon = $item['icon'] ?? null;
                $iconBg = $item['iconBg'] ?? 'gray';
                $title = $item['title'] ?? '';
                $description = $item['description'] ?? null;
                $timestamp = $item['timestamp'] ?? null;
                $status = $item['status'] ?? null;
                $content = $item['content'] ?? null;

                // Icon background colors
                $iconBgColors = [
                    'gray' => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400',
                    'blue' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                    'green' => 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
                    'red' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                    'yellow' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400',
                    'indigo' => 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400',
                    'purple' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400',
                ];

                // Status badges
                $statusColors = [
                    'success' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                    'error' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                    'info' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                ];
            @endphp

            <li>
                <div class="relative pb-8">
                    @if(!$isLast)
                        <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                    @endif

                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white dark:ring-gray-900 {{ $iconBgColors[$iconBg] ?? $iconBgColors['gray'] }}">
                                @if($icon)
                                    {!! $icon !!}
                                @else
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <circle cx="10" cy="10" r="3"/>
                                    </svg>
                                @endif
                            </span>
                        </div>

                        <div class="flex min-w-0 flex-1 justify-between space-x-4 {{ $variant === 'compact' ? 'pt-0.5' : 'pt-1.5' }}">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $title }}</p>
                                    @if($status)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $statusColors[$status] ?? $statusColors['info'] }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    @endif
                                </div>

                                @if($description)
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
                                @endif

                                @if($content)
                                    <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                        {!! $content !!}
                                    </div>
                                @endif
                            </div>

                            @if($timestamp)
                                <div class="whitespace-nowrap text-right text-sm text-gray-500 dark:text-gray-400">
                                    {{ $timestamp }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
