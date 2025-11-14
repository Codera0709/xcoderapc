<x-layout.layout>
    <x-slot name="title">Feedback Demo - XCODERA</x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Feedback Components Demo</h1>
        <p class="text-gray-600 dark:text-gray-400">This page demonstrates all available feedback components in XCODERA.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Alert Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Alert Component</h2>
                <div class="space-y-4">
                    <x-ui.alert type="success" title="Success!">
                        Your changes have been saved successfully.
                    </x-ui.alert>
                    <x-ui.alert type="danger" title="Error!">
                        There was an error processing your request.
                    </x-ui.alert>
                    <x-ui.alert type="warning" title="Warning!">
                        Please check your information before submitting.
                    </x-ui.alert>
                    <x-ui.alert type="info" title="Info!">
                        This is an informational message.
                    </x-ui.alert>
                </div>
            </x-ui.card>

            <!-- Toast Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Toast Component</h2>
                <div class="space-y-4">
                    <x-ui.button variant="success" @click="$dispatch('toast', {type: 'success', message: 'Success toast message!'})">
                        Show Success Toast
                    </x-ui.button>
                    <x-ui.button variant="danger" @click="$dispatch('toast', {type: 'error', message: 'Error toast message!'})">
                        Show Error Toast
                    </x-ui.button>
                    <x-ui.button variant="warning" @click="$dispatch('toast', {type: 'warning', message: 'Warning toast message!'})">
                        Show Warning Toast
                    </x-ui.button>
                    <x-ui.button variant="info" @click="$dispatch('toast', {type: 'info', message: 'Info toast message!'})">
                        Show Info Toast
                    </x-ui.button>
                </div>
            </x-ui.card>

            <!-- Progress Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Progress Component</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Upload Progress</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">45%</span>
                        </div>
                        <x-data.progress :value="45" color="indigo" :animated="true" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Task Completion</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">75%</span>
                        </div>
                        <x-data.progress :value="75" color="green" size="lg" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">System Status</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">90%</span>
                        </div>
                        <x-data.progress :value="90" color="blue" :striped="true" size="sm" />
                    </div>
                </div>
            </x-ui.card>

            <!-- Button Loading States Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Button Loading States</h2>
                <div class="space-y-4">
                    <div class="flex flex-wrap gap-3">
                        <x-ui.button variant="primary" :loading="true">
                            Loading...
                        </x-ui.button>
                        <x-ui.button variant="secondary" :loading="true" :disabled="true">
                            Disabled
                        </x-ui.button>
                        <x-ui.button variant="success" :loading="true" size="sm">
                            SM Loading
                        </x-ui.button>
                        <x-ui.button variant="danger" :loading="true" size="lg">
                            LG Loading
                        </x-ui.button>
                    </div>
                </div>
            </x-ui.card>

            <!-- Spinner Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Spinner Component</h2>
                <div class="flex flex-wrap gap-6 items-center">
                    <div class="w-8 h-8 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                    <div class="w-8 h-8 border-4 border-green-500 border-t-transparent rounded-full animate-spin"></div>
                    <div class="w-8 h-8 border-4 border-red-500 border-t-transparent rounded-full animate-spin"></div>
                    <div class="w-8 h-8 border-4 border-yellow-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
            </x-ui.card>

            <!-- Notification System Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Notification System</h2>
                <div class="space-y-4">
                    <x-ui.button variant="primary" @click="$dispatch('open-drawer', 'notification-drawer')">
                        Open Notification Center
                    </x-ui.button>
                    
                    <!-- Notification Center -->
                    <x-utils.notification-center />
                    
                    <!-- Demo Notification Items -->
                    <div class="mt-4 space-y-2">
                        <x-premium.notification-item 
                            title="New message" 
                            message="You have received a new message from John Doe" 
                            time="2 min ago" 
                            type="info"
                        />
                        <x-premium.notification-item 
                            title="Payment received" 
                            message="Your payment of $249.00 has been received" 
                            time="1 hour ago" 
                            type="success"
                        />
                        <x-premium.notification-item 
                            title="Server issue" 
                            message="Server utilization is high. Please check your resources." 
                            time="3 hours ago" 
                            type="warning"
                        />
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>
</x-layout.layout>