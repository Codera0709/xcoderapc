<x-layout.layout>
    <x-slot name="title">UI Components Demo - XCODERA</x-slot>

    <div class="space-y-8">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">UI Components Demo</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Showcase of all available UI components</p>
        </div>

        <!-- Buttons Demo -->
        <x-ui.card>
            <x-slot name="header">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Buttons</h2>
            </x-slot>

            <div class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Variants</h3>
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
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Sizes</h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <x-ui.button size="xs">Extra Small</x-ui.button>
                        <x-ui.button size="sm">Small</x-ui.button>
                        <x-ui.button size="md">Medium</x-ui.button>
                        <x-ui.button size="lg">Large</x-ui.button>
                        <x-ui.button size="xl">Extra Large</x-ui.button>
                    </div>
                </div>

                <!-- States -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">States</h3>
                    <div class="flex flex-wrap gap-3">
                        <x-ui.button :loading="true">Loading</x-ui.button>
                        <x-ui.button :disabled="true">Disabled</x-ui.button>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Badges Demo -->
        <x-ui.card>
            <x-slot name="header">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Badges</h2>
            </x-slot>

            <div class="space-y-6">
                <!-- Variants -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Variants</h3>
                    <div class="flex flex-wrap gap-3">
                        <x-ui.badge variant="primary">Primary</x-ui.badge>
                        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                        <x-ui.badge variant="success">Success</x-ui.badge>
                        <x-ui.badge variant="danger">Danger</x-ui.badge>
                        <x-ui.badge variant="warning">Warning</x-ui.badge>
                        <x-ui.badge variant="info">Info</x-ui.badge>
                    </div>
                </div>

                <!-- With Dot -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">With Dot Indicator</h3>
                    <div class="flex flex-wrap gap-3">
                        <x-ui.badge variant="success" :dot="true">Active</x-ui.badge>
                        <x-ui.badge variant="danger" :dot="true">Inactive</x-ui.badge>
                        <x-ui.badge variant="warning" :dot="true">Pending</x-ui.badge>
                    </div>
                </div>

                <!-- Sizes -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Sizes</h3>
                    <div class="flex flex-wrap items-center gap-3">
                        <x-ui.badge size="xs">Extra Small</x-ui.badge>
                        <x-ui.badge size="sm">Small</x-ui.badge>
                        <x-ui.badge size="md">Medium</x-ui.badge>
                        <x-ui.badge size="lg">Large</x-ui.badge>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Alerts Demo -->
        <x-ui.card>
            <x-slot name="header">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Alerts</h2>
            </x-slot>

            <div class="space-y-4">
                <x-ui.alert type="success" title="Success!" :dismissible="true">
                    Your changes have been saved successfully.
                </x-ui.alert>

                <x-ui.alert type="danger" title="Error!" :dismissible="true">
                    There was an error processing your request.
                </x-ui.alert>

                <x-ui.alert type="warning" title="Warning!">
                    Please review the information before proceeding.
                </x-ui.alert>

                <x-ui.alert type="info">
                    This is an informational message without a title.
                </x-ui.alert>
            </div>
        </x-ui.card>

        <!-- Progress Bars Demo -->
        <x-ui.card>
            <x-slot name="header">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Progress Bars</h2>
            </x-slot>

            <div class="space-y-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Colors</h3>
                    <div class="space-y-4">
                        <x-ui.progress :value="25" color="indigo" :showLabel="true">Indigo Progress</x-ui.progress>
                        <x-ui.progress :value="50" color="green" :showLabel="true">Green Progress</x-ui.progress>
                        <x-ui.progress :value="75" color="red" :showLabel="true">Red Progress</x-ui.progress>
                        <x-ui.progress :value="90" color="yellow" :showLabel="true">Yellow Progress</x-ui.progress>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Sizes</h3>
                    <div class="space-y-4">
                        <x-ui.progress :value="60" size="xs" />
                        <x-ui.progress :value="60" size="sm" />
                        <x-ui.progress :value="60" size="md" />
                        <x-ui.progress :value="60" size="lg" />
                        <x-ui.progress :value="60" size="xl" />
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Animated & Striped</h3>
                    <div class="space-y-4">
                        <x-ui.progress :value="70" :animated="true" :showLabel="true">Animated</x-ui.progress>
                        <x-ui.progress :value="70" :striped="true" :showLabel="true">Striped</x-ui.progress>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Interactive Components -->
        <x-ui.card>
            <x-slot name="header">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Interactive Components</h2>
            </x-slot>

            <div class="space-y-6">
                <!-- Tooltip Demo -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Tooltips</h3>
                    <div class="flex flex-wrap gap-4">
                        <x-ui.tooltip text="Tooltip on top" position="top">
                            <x-ui.button>Hover Top</x-ui.button>
                        </x-ui.tooltip>
                        <x-ui.tooltip text="Tooltip on right" position="right">
                            <x-ui.button>Hover Right</x-ui.button>
                        </x-ui.tooltip>
                        <x-ui.tooltip text="Tooltip on bottom" position="bottom">
                            <x-ui.button>Hover Bottom</x-ui.button>
                        </x-ui.tooltip>
                        <x-ui.tooltip text="Tooltip on left" position="left">
                            <x-ui.button>Hover Left</x-ui.button>
                        </x-ui.tooltip>
                    </div>
                </div>

                <!-- Modal Demo -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Modal</h3>
                    <x-ui.button @click="$dispatch('open-modal', 'demo-modal')">Open Modal</x-ui.button>
                </div>

                <!-- Toast Demo -->
                <div>
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Toast (Auto-hide in 3 seconds)</h3>
                    <div class="flex flex-wrap gap-3">
                        <x-ui.button variant="success" onclick="document.getElementById('toast-success').style.display = 'block';">Show Success Toast</x-ui.button>
                        <x-ui.button variant="danger" onclick="document.getElementById('toast-error').style.display = 'block';">Show Error Toast</x-ui.button>
                        <x-ui.button variant="warning" onclick="document.getElementById('toast-warning').style.display = 'block';">Show Warning Toast</x-ui.button>
                        <x-ui.button variant="info" onclick="document.getElementById('toast-info').style.display = 'block';">Show Info Toast</x-ui.button>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Card Variations -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-ui.card>
                <x-slot name="header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Card with Header</h3>
                </x-slot>
                <p class="text-gray-600 dark:text-gray-400">This is a card with a header section.</p>
            </x-ui.card>

            <x-ui.card>
                <x-slot name="header">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Card with Footer</h3>
                </x-slot>
                <p class="text-gray-600 dark:text-gray-400">This is a card with both header and footer sections.</p>
                <x-slot name="footer">
                    <div class="flex justify-end gap-2">
                        <x-ui.button variant="secondary" size="sm">Cancel</x-ui.button>
                        <x-ui.button size="sm">Save</x-ui.button>
                    </div>
                </x-slot>
            </x-ui.card>
        </div>
    </div>

    <!-- Modal Component -->
    <x-ui.modal name="demo-modal" title="Demo Modal" maxWidth="lg">
        <div class="space-y-4">
            <p class="text-gray-600 dark:text-gray-400">
                This is a demo modal. You can press ESC or click outside to close it.
            </p>
            <x-ui.alert type="info">
                Modals can contain any content including other components!
            </x-ui.alert>
            <div class="flex justify-end gap-2">
                <x-ui.button variant="secondary" @click="$dispatch('close-modal', 'demo-modal')">Cancel</x-ui.button>
                <x-ui.button @click="$dispatch('close-modal', 'demo-modal')">Confirm</x-ui.button>
            </div>
        </div>
    </x-ui.modal>

    <!-- Toast Components (Hidden by default) -->
    <div id="toast-success" style="display: none;">
        <x-ui.toast type="success" :duration="3000">
            Success! Your action was completed.
        </x-ui.toast>
    </div>

    <div id="toast-error" style="display: none;">
        <x-ui.toast type="error" :duration="3000">
            Error! Something went wrong.
        </x-ui.toast>
    </div>

    <div id="toast-warning" style="display: none;">
        <x-ui.toast type="warning" :duration="3000">
            Warning! Please check your input.
        </x-ui.toast>
    </div>

    <div id="toast-info" style="display: none;">
        <x-ui.toast type="info" :duration="3000">
            Info: New updates available.
        </x-ui.toast>
    </div>
</x-layout.layout>
