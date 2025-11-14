@props(['paginator', 'currentPage' => 1, 'lastPage' => 1, 'path' => '', 'firstItem' => 1, 'lastItem' => 1, 'total' => 1])

@php
    // Handle both paginator object and individual parameters
    if (isset($paginator)) {
        $hasPages = $paginator->hasPages();
        $onFirstPage = $paginator->onFirstPage();
        $hasMorePages = $paginator->hasMorePages();
        $previousUrl = $paginator->previousPageUrl();
        $nextUrl = $paginator->nextPageUrl();
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $firstItem = $paginator->firstItem() ?? 1;
        $lastItem = $paginator->lastItem() ?? $firstItem;
        $total = $paginator->total();

        $elements = $paginator->links()->elements ?? [];
    } else {
        $hasPages = $lastPage > 1;
        $onFirstPage = $currentPage <= 1;
        $hasMorePages = $currentPage < $lastPage;
        $previousUrl = $currentPage > 1 ? ($path . '?page=' . ($currentPage - 1)) : '';
        $nextUrl = $currentPage < $lastPage ? ($path . '?page=' . ($currentPage + 1)) : '';

        // Generate elements for simple pagination
        $elements = [];
        if ($lastPage <= 5) {
            for ($i = 1; $i <= $lastPage; $i++) {
                $elements[] = [$i => $path . '?page=' . $i];
            }
        } else {
            // Always include first page
            $elements[] = [1 => $path . '?page=1'];

            // Include dots if needed
            if ($currentPage > 3) {
                $elements[] = '...';
            }

            // Include current page and neighbors
            for ($i = max(2, $currentPage - 1); $i <= min($lastPage - 1, $currentPage + 1); $i++) {
                $elements[] = [$i => $path . '?page=' . $i];
            }

            // Include dots if needed
            if ($currentPage < $lastPage - 2) {
                $elements[] = '...';
            }

            // Always include last page if it's not already included
            if ($lastPage > 1) {
                $elements[] = [$lastPage => $path . '?page=' . $lastPage];
            }
        }
    }
@endphp

@if ($hasPages)
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($onFirstPage)
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 cursor-default leading-5 rounded-md">
                    Previous
                </span>
            @else
                <a href="{{ $previousUrl }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 leading-5 rounded-md hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Previous
                </a>
            @endif

            @if ($hasMorePages)
                <a href="{{ $nextUrl }}" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 leading-5 rounded-md hover:text-gray-500 dark:hover:text-gray-400 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Next
                </a>
            @else
                <span class="ml-3 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 cursor-default leading-5 rounded-md">
                    Next
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-300 leading-5">
                    Showing
                    <span class="font-medium">{{ $firstItem }}</span>
                    to
                    <span class="font-medium">{{ $lastItem }}</span>
                    of
                    <span class="font-medium">{{ $total }}</span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm">
                    @if ($onFirstPage)
                        <span aria-disabled="true" aria-label="Previous">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $previousUrl }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-l-md leading-5 hover:text-gray-400 dark:hover:text-gray-300 focus:z-10 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $currentPage)
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-indigo-600 border border-indigo-600 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 leading-5 hover:text-gray-500 dark:hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="Go to page {{ $page }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($hasMorePages)
                        <a href="{{ $nextUrl }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-r-md leading-5 hover:text-gray-400 dark:hover:text-gray-300 focus:z-10 focus:outline-none focus:ring ring-indigo-300 focus:border-indigo-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="Next">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
