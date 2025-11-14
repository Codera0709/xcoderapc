@props([
    'name' => 'theme-drawer',
    'show' => false,
])

<div
    x-data="{ show: @js($show) }"
    x-on:open-drawer.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-drawer.window="$event.detail === '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    x-cloak
    class="fixed inset-0 z-50 overflow-hidden"
>
    <!-- Backdrop -->
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

    <!-- Drawer -->
    <div class="fixed inset-y-0 right-0 max-w-full flex">
        <div
            x-show="show"
            x-transition:enter="transform transition ease-in-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transform transition ease-in-out duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative w-screen max-w-md"
        >
            <div class="h-full flex flex-col bg-white dark:bg-gray-800 shadow-xl">
                <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                    <div class="flex items-start justify-between">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Theme Settings</h2>
                        <button @click="show = false" type="button" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-8">
                        <div class="space-y-6">
                            <!-- Theme Toggle -->
                            <div>
                                <h3 class="text-md font-medium text-gray-900 dark:text-white mb-3">Appearance</h3>
                                <div class="flex items-center space-x-4">
                                    <button 
                                        @click="$dispatch('toggle-theme'); show = false" 
                                        class="px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                    >
                                        Toggle Theme
                                    </button>
                                </div>
                            </div>

                            <!-- Color Presets -->
                            <div>
                                <h3 class="text-md font-medium text-gray-900 dark:text-white mb-3">Color Presets</h3>
                                <div class="grid grid-cols-4 gap-3">
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-indigo-500"
                                        title="Indigo"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-blue-500"
                                        title="Blue"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-purple-500"
                                        title="Purple"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-pink-500"
                                        title="Pink"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); show = false"
                                        class="h-10 rounded-md bg-gray-700"
                                        title="Dark Gray"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-green-500"
                                        title="Green"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-red-500"
                                        title="Red"
                                    ></button>
                                    <button 
                                        @click="document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); show = false"
                                        class="h-10 rounded-md bg-yellow-500"
                                        title="Yellow"
                                    ></button>
                                </div>
                            </div>

                            <!-- Font Size -->
                            <div>
                                <h3 class="text-md font-medium text-gray-900 dark:text-white mb-3">Font Size</h3>
                                <div class="flex space-x-2">
                                    <button 
                                        @click="document.documentElement.classList.add('text-xs'); show = false"
                                        class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs"
                                    >
                                        Small
                                    </button>
                                    <button 
                                        @click="document.documentElement.classList.remove('text-xs', 'text-sm', 'text-lg'); show = false"
                                        class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-sm"
                                    >
                                        Normal
                                    </button>
                                    <button 
                                        @click="document.documentElement.classList.add('text-lg'); show = false"
                                        class="px-3 py-1 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-base"
                                    >
                                        Large
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 py-4 px-4 sm:px-6">
                    <div class="flex justify-end space-x-3">
                        <button 
                            @click="show = false" 
                            type="button" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Cancel
                        </button>
                        <button 
                            @click="show = false" 
                            type="button" 
                            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>