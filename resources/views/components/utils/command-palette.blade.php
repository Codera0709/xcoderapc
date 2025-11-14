@props([
    'commands' => [],
])

<div
    x-data="{
        show: false,
        query: '',
        results: [],
        selectedIndex: 0,
        init() {
            this.results = @js($commands);
            // Listen for Ctrl+K or Cmd+K
            window.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    this.show = true;
                }
            });
        },
        filterResults() {
            if (!this.query) {
                this.results = @js($commands);
            } else {
                this.results = @js($commands).filter(item => 
                    item.title.toLowerCase().includes(this.query.toLowerCase()) || 
                    item.description.toLowerCase().includes(this.query.toLowerCase())
                );
            }
            this.selectedIndex = 0;
        },
        selectItem(item) {
            if (item.action) {
                eval(item.action);
            } else if (item.href) {
                window.location.href = item.href;
            }
            this.show = false;
            this.query = '';
        },
        navigate(direction) {
            if (direction === 'up') {
                this.selectedIndex = Math.max(0, this.selectedIndex - 1);
            } else if (direction === 'down') {
                this.selectedIndex = Math.min(this.results.length - 1, this.selectedIndex + 1);
            }
        }
    }"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
>
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background -->
        <div 
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75 transition-opacity"
            @click="show = false"
        ></div>

        <!-- Modal -->
        <div 
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @keydown.window.escape="show = false"
            @keydown.window.arrow-up.prevent="navigate('up')"
            @keydown.window.arrow-down.prevent="navigate('down')"
            @keydown.window.enter.prevent="selectItem(results[selectedIndex])"
            class="inline-block w-full max-w-lg pt-6 px-4 text-left align-bottom sm:align-middle"
        >
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all">
                <!-- Search Input -->
                <div class="px-4 pt-4">
                    <div class="relative">
                        <svg 
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-500" 
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input
                            x-model="query"
                            @input="filterResults"
                            @keydown.window.enter.prevent="selectItem(results[selectedIndex])"
                            @keydown.window.arrow-up.prevent="navigate('up')"
                            @keydown.window.arrow-down.prevent="navigate('down')"
                            type="text"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Type a command or search..."
                            autofocus
                        />
                    </div>
                </div>

                <!-- Results -->
                <div class="max-h-96 overflow-y-auto">
                    <template x-for="(item, index) in results" :key="index">
                        <div
                            x-data="{ isActive: index === selectedIndex }"
                            x-bind:class="{
                                'bg-gray-100 dark:bg-gray-700': isActive,
                                'bg-white dark:bg-gray-800': !isActive
                            }"
                            class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 cursor-pointer"
                            @click="selectItem(item)"
                            @mouseenter="selectedIndex = index"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span x-text="item.title" class="font-medium text-gray-900 dark:text-white"></span>
                                    <span 
                                        x-show="item.type"
                                        x-text="' • ' + item.type" 
                                        class="ml-2 text-xs text-gray-500 dark:text-gray-400"
                                    ></span>
                                </div>
                                <span x-text="item.shortcut" class="text-xs text-gray-500 dark:text-gray-400"></span>
                            </div>
                            <p x-text="item.description" class="mt-1 text-sm text-gray-500 dark:text-gray-400"></p>
                        </div>
                    </template>

                    <div x-show="results.length === 0" class="px-4 py-8 text-center">
                        <p class="text-gray-500 dark:text-gray-400">No commands found</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 rounded-b-lg text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex justify-between">
                        <span>↑↓ to navigate • Enter to select • Esc to close</span>
                        <span>Cmd+K to open</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Trigger button -->
<div class="fixed bottom-6 right-6 z-40">
    <button 
        @click="show = true"
        class="p-3 rounded-full bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        title="Command Palette (Ctrl+K)"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
        </svg>
    </button>
</div>