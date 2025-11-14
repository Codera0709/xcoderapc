@props([
    'headers' => [],
    'rows' => [],
    'striped' => true,
    'hover' => true,
    'bordered' => false,
    'stickyHeader' => false,
    'sortable' => false,
    'compact' => false,
])

<div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-800 {{ $stickyHeader ? 'sticky top-0 z-10' : '' }}">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-{{ $compact ? '3' : '6' }} py-{{ $compact ? '2' : '3' }} text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider {{ $sortable ? 'cursor-pointer select-none hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors' : '' }}">
                        <div class="flex items-center gap-2">
                            @if(is_array($header))
                                {{ $header['label'] ?? $header['key'] ?? '' }}
                                @if($sortable && ($header['sortable'] ?? true))
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                    </svg>
                                @endif
                            @else
                                {{ $header }}
                            @endif
                        </div>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($rows as $index => $row)
                <tr class="{{ $striped && $index % 2 !== 0 ? 'bg-gray-50 dark:bg-gray-800/50' : '' }} {{ $hover ? 'hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors' : '' }}">
                    @if(is_array($row))
                        @foreach($row as $cell)
                            <td class="px-{{ $compact ? '3' : '6' }} py-{{ $compact ? '2' : '4' }} whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {!! $cell !!}
                            </td>
                        @endforeach
                    @else
                        <td class="px-{{ $compact ? '3' : '6' }} py-{{ $compact ? '2' : '4' }} whitespace-nowrap text-sm text-gray-900 dark:text-gray-100" colspan="{{ count($headers) }}">
                            {!! $row !!}
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-sm font-medium">No data available</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
        @if(isset($footer))
            <tfoot class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <td colspan="{{ count($headers) }}" class="px-6 py-3">
                        {{ $footer }}
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>
