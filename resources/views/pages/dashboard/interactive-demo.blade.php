<x-layout.layout>
    <x-slot name="title">Interactive Demo - XCODERA</x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Interactive Components Demo</h1>
        <p class="text-gray-600 dark:text-gray-400">This page demonstrates all available interactive components in XCODERA.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Modal Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Modal Component</h2>
                <x-ui.button variant="primary" @click="$dispatch('open-modal', 'demo-modal')">
                    Open Modal
                </x-ui.button>
                
                <x-ui.modal name="demo-modal" title="Demo Modal" size="md">
                    <p class="text-gray-600 dark:text-gray-300">This is a demo modal. You can put any content here.</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">It has smooth animations and can be closed by clicking the backdrop or pressing ESC.</p>
                    
                    <div class="flex justify-end gap-2 pt-4">
                        <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'demo-modal')">
                            Close
                        </x-ui.button>
                        <x-ui.button variant="primary" @click="$dispatch('close-modal', 'demo-modal')">
                            Save Changes
                        </x-ui.button>
                    </div>
                </x-ui.modal>
            </x-ui.card>

            <!-- Tabs Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Tabs Component</h2>
                <x-utils.tabs :tabs="[
                    ['id' => 'tab1', 'label' => 'Tab 1', 'icon' => 'home'],
                    ['id' => 'tab2', 'label' => 'Tab 2', 'icon' => 'user'],
                    ['id' => 'tab3', 'label' => 'Tab 3', 'icon' => 'cog'],
                ]">
                    <x-slot name="content">
                        <div x-show="activeTab === 'tab1'" class="p-4">
                            <h3 class="font-medium text-gray-900 dark:text-white">Content for Tab 1</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">This is the content for the first tab.</p>
                        </div>
                        <div x-show="activeTab === 'tab2'" class="p-4">
                            <h3 class="font-medium text-gray-900 dark:text-white">Content for Tab 2</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">This is the content for the second tab.</p>
                        </div>
                        <div x-show="activeTab === 'tab3'" class="p-4">
                            <h3 class="font-medium text-gray-900 dark:text-white">Content for Tab 3</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">This is the content for the third tab.</p>
                        </div>
                    </x-slot>
                </x-utils.tabs>
            </x-ui.card>

            <!-- Dropdown Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Dropdown Component</h2>
                <x-utils.dropdown>
                    <x-slot name="trigger">
                        <x-ui.button variant="outline">
                            Dropdown
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </x-ui.button>
                    </x-slot>

                    <x-utils.dropdown-link href="#">Option 1</x-utils.dropdown-link>
                    <x-utils.dropdown-link href="#">Option 2</x-utils.dropdown-link>
                    <x-utils.dropdown-link href="#">Option 3</x-utils.dropdown-link>
                    <div class="border-t border-gray-200 dark:border-gray-700"></div>
                    <x-utils.dropdown-link href="#" class="text-red-600 dark:text-red-400">Delete</x-utils.dropdown-link>
                </x-utils.dropdown>
            </x-ui.card>

            <!-- Breadcrumbs Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Breadcrumbs Component</h2>
                <x-utils.breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Components', 'url' => '#'],
                    ['label' => 'Interactive', 'url' => '#'],
                ]" />
            </x-ui.card>

            <!-- Searchbar Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Searchbar Component</h2>
                <x-utils.searchbar placeholder="Search for anything..." />
            </x-ui.card>

            <!-- Pagination Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Pagination Component</h2>
                <x-utils.pagination :currentPage="2" :lastPage="5" :path="'/demo'" />
            </x-ui.card>

            <!-- Tooltip Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Tooltip Component</h2>
                <div class="flex flex-wrap gap-4">
                    <div 
                        x-data="{ tooltip: false }" 
                        @mouseenter="tooltip = true" 
                        @mouseleave="tooltip = false" 
                        class="relative inline-block"
                    >
                        <x-ui.button variant="primary">Hover me</x-ui.button>
                        <div 
                            x-show="tooltip" 
                            x-transition 
                            class="absolute z-10 bottom-full left-1/2 transform -translate-x-1/2 -translate-y-1 mb-2 px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded dark:bg-gray-700"
                        >
                            This is a tooltip
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-4 border-l-transparent border-r-4 border-r-transparent border-t-4 border-t-gray-900 dark:border-t-gray-700"></div>
                        </div>
                    </div>
                    
                    <x-ui.button variant="secondary">Button 2</x-ui.button>
                    <x-ui.button variant="outline">Button 3</x-ui.button>
                </div>
            </x-ui.card>

            <!-- Skeleton Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Skeleton Component</h2>
                <div class="space-y-4">
                    <x-utils.skeleton type="text" size="md" />
                    <x-utils.skeleton type="text" size="md" :count="3" />
                    <x-utils.skeleton type="rectangle" :width="'100%'" :height="'120px'" />
                    <div class="flex items-center space-x-4">
                        <x-utils.skeleton type="circle" :width="'40px'" :height="'40px'" />
                        <div class="space-y-2 flex-1">
                            <x-utils.skeleton type="text" size="sm" />
                            <x-utils.skeleton type="text" size="xs" />
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-layout.layout>