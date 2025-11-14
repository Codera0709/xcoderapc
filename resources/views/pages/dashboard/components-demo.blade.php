<x-layout.layout>
    <x-slot name="title">Components Demo - XCODERA</x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Components Demo</h1>
        <p class="text-gray-600 dark:text-gray-400">This page demonstrates all available components in XCODERA.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- UI Components Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">UI Components</h2>
                
                <!-- Button Component Demo -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Buttons</h3>
                    <div class="flex flex-wrap gap-3">
                        <x-ui.button variant="primary">Primary</x-ui.button>
                        <x-ui.button variant="secondary">Secondary</x-ui.button>
                        <x-ui.button variant="success">Success</x-ui.button>
                        <x-ui.button variant="danger">Danger</x-ui.button>
                        <x-ui.button variant="warning">Warning</x-ui.button>
                        <x-ui.button variant="info">Info</x-ui.button>
                        <x-ui.button variant="outline">Outline</x-ui.button>
                        <x-ui.button variant="ghost">Ghost</x-ui.button>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <x-ui.button size="xs" variant="primary">XS Button</x-ui.button>
                        <x-ui.button size="sm" variant="primary">SM Button</x-ui.button>
                        <x-ui.button size="md" variant="primary">MD Button</x-ui.button>
                        <x-ui.button size="lg" variant="primary">LG Button</x-ui.button>
                        <x-ui.button size="xl" variant="primary">XL Button</x-ui.button>
                    </div>
                </div>
                
                <!-- Badge Component Demo -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Badges</h3>
                    <div class="flex flex-wrap gap-2">
                        <x-ui.badge variant="primary">Primary</x-ui.badge>
                        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                        <x-ui.badge variant="success">Success</x-ui.badge>
                        <x-ui.badge variant="danger">Danger</x-ui.badge>
                        <x-ui.badge variant="warning">Warning</x-ui.badge>
                        <x-ui.badge variant="info">Info</x-ui.badge>
                        <x-ui.badge variant="outline">Outline</x-ui.badge>
                        <x-ui.badge variant="primary" dot>With Dot</x-ui.badge>
                    </div>
                </div>
                
                <!-- Card Component Demo -->
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Card</h3>
                    <x-ui.card>
                        <p class="text-gray-600 dark:text-gray-300">This is a sample card component.</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">It can contain any content you want.</p>
                    </x-ui.card>
                </div>
            </x-ui.card>

            <!-- Layout Components Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Layout Components</h2>
                
                <!-- Navbar Component -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Navbar</h3>
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="w-8 h-8 bg-indigo-600 rounded-md flex items-center justify-center">
                                    <span class="text-white font-bold">X</span>
                                </div>
                                <span class="font-semibold text-gray-900 dark:text-white">XCODERA</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        placeholder="Search..." 
                                        class="w-48 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    >
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="p-1 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </button>
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-semibold text-sm">
                                        JD
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar Component -->
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Sidebar</h3>
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <div class="space-y-2">
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg bg-indigo-50 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>Users</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Settings</span>
                            </a>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <!-- Utility Components Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Utility Components</h2>
                
                <!-- Breadcrumbs Component -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Breadcrumbs</h3>
                    <x-utils.breadcrumbs :items="[
                        ['label' => 'Dashboard', 'url' => '/dashboard'],
                        ['label' => 'Components', 'url' => '#'],
                        ['label' => 'Components Demo', 'url' => '#'],
                    ]" />
                </div>
                
                <!-- Searchbar Component -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Searchbar</h3>
                    <x-utils.searchbar placeholder="Search components..." />
                </div>
                
                <!-- Tabs Component -->
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Tabs</h3>
                    <x-utils.tabs :tabs="[
                        ['id' => 'tab1', 'label' => 'Tab 1'],
                        ['id' => 'tab2', 'label' => 'Tab 2'],
                        ['id' => 'tab3', 'label' => 'Tab 3'],
                    ]">
                        <x-slot name="content">
                            <div x-show="activeTab === 'tab1'" class="p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white">Content for Tab 1</h4>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">This is the content for the first tab.</p>
                            </div>
                            <div x-show="activeTab === 'tab2'" class="p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white">Content for Tab 2</h4>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">This is the content for the second tab.</p>
                            </div>
                            <div x-show="activeTab === 'tab3'" class="p-4">
                                <h4 class="font-medium text-gray-900 dark:text-white">Content for Tab 3</h4>
                                <p class="mt-2 text-gray-600 dark:text-gray-400">This is the content for the third tab.</p>
                            </div>
                        </x-slot>
                    </x-utils.tabs>
                </div>
            </x-ui.card>

            <!-- Premium Components Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Premium Components</h2>
                
                <!-- Avatar Component -->
                <div class="mb-6">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Avatar</h3>
                    <div class="flex flex-wrap gap-4">
                        <x-utils.avatar name="John Doe" size="xs" />
                        <x-utils.avatar name="John Doe" size="sm" />
                        <x-utils.avatar name="John Doe" size="md" />
                        <x-utils.avatar name="John Doe" size="lg" />
                        <x-utils.avatar name="John Doe" size="xl" />
                        <x-utils.avatar name="John Doe" size="lg" status="online" />
                        <x-utils.avatar name="John Doe" size="lg" status="offline" />
                    </div>
                </div>
                
                <!-- Skeleton Component -->
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Skeleton</h3>
                    <div class="space-y-4">
                        <x-utils.skeleton type="text" size="md" />
                        <x-utils.skeleton type="rectangle" :width="'100%'" :height="'80px'" />
                        <div class="flex items-center space-x-4">
                            <x-utils.skeleton type="circle" :width="'40px'" :height="'40px'" />
                            <div class="space-y-2 flex-1">
                                <x-utils.skeleton type="text" size="sm" />
                                <x-utils.skeleton type="text" size="xs" />
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-layout.layout>