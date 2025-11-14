@props([
    'placeholder' => 'Search...',
    'debounce' => '300'
])

<div x-data="{ search: '', loading: false }" class="relative">
    <div class="relative">
        <input
            type="text"
            x-model="search"
            x-on:input.debounce.{{ $debounce }}ms="loading = true; $nextTick(() => loading = false)"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full pl-10 pr-10 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent']) }}
        >
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <div x-show="search" class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <button @click="search = ''" type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div x-show="loading" x-transition class="absolute top-full left-0 right-0 mt-1 text-xs text-gray-500 dark:text-gray-400">
        Searching...
    </div>
</div>
