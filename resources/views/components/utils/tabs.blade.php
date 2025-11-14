@props(['tabs' => [], 'active' => ''])

<div x-data="{ activeTab: '{{ $active }}' }" class="w-full">
    <!-- Tab Headers -->
    <div class="border-b border-gray-200 dark:border-gray-700">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            @foreach($tabs as $key => $tab)
                <button
                    @click="activeTab = '{{ $key }}'"
                    :class="activeTab === '{{ $key }}' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    @if(isset($tab['icon']))
                        <span class="inline-flex items-center gap-2">
                            {!! $tab['icon'] !!}
                            {{ $tab['label'] }}
                        </span>
                    @else
                        {{ $tab['label'] }}
                    @endif
                    @if(isset($tab['count']))
                        <span class="ml-2 py-0.5 px-2 rounded-full text-xs" :class="activeTab === '{{ $key }}' ? 'bg-indigo-100 text-indigo-600 dark:bg-indigo-900 dark:text-indigo-400' : 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-gray-300'">
                            {{ $tab['count'] }}
                        </span>
                    @endif
                </button>
            @endforeach
        </nav>
    </div>

    <!-- Tab Content -->
    <div class="mt-4">
        {{ $slot }}
    </div>
</div>
