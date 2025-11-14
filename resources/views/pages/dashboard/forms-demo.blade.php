<x-layout.layout>
    <x-slot name="title">Forms Demo - XCODERA</x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Forms Components Demo</h1>
        <p class="text-gray-600 dark:text-gray-400">This page demonstrates all available form components in XCODERA.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Input Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Input Component</h2>
                <div class="space-y-4">
                    <x-form.input name="text-input" label="Text Input" placeholder="Enter text..." />
                    <x-form.input name="email-input" type="email" label="Email Input" placeholder="user@example.com" />
                    <x-form.input name="password-input" type="password" label="Password" placeholder="••••••••" />
                    <x-form.input name="search-input" type="search" label="Search Input" placeholder="Search..." />
                    <x-form.input name="number-input" type="number" label="Number Input" placeholder="123" />
                    <x-form.input name="date-input" type="date" label="Date Input" />
                    <x-form.input 
                        name="icon-input" 
                        label="Input with Icon" 
                        placeholder="Search..."
                        icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
                    />
                </div>
            </x-ui.card>

            <!-- Select Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Select Component</h2>
                <div class="space-y-4">
                    <x-form.select name="basic-select" label="Basic Select" :options="['option1' => 'Option 1', 'option2' => 'Option 2', 'option3' => 'Option 3']" />
                    <x-form.select name="multiple-select" label="Multiple Select" :options="['option1' => 'Option 1', 'option2' => 'Option 2', 'option3' => 'Option 3']" multiple />
                    <x-form.select name="placeholder-select" label="Select with Placeholder" :options="['' => 'Choose an option', 'option1' => 'Option 1', 'option2' => 'Option 2']" />
                    <x-form.select name="required-select" label="Required Select" :options="['option1' => 'Option 1', 'option2' => 'Option 2']" required />
                </div>
            </x-ui.card>

            <!-- Textarea Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Textarea Component</h2>
                <x-form.input name="textarea" label="Textarea" placeholder="Enter your message..." rows="4" />
            </x-ui.card>

            <!-- Switch Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Switch Component</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Enable notifications</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Receive notifications via email</p>
                        </div>
                        <x-form.switch name="email_notifications" />
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Push notifications</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Receive push notifications on your devices</p>
                        </div>
                        <x-form.switch name="push_notifications" checked="true" />
                    </div>
                </div>
            </x-ui.card>

            <!-- Checkbox & Radio Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Checkbox & Radio Components</h2>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="checkbox1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                        <label for="checkbox1" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Checkbox Option 1</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="checkbox2" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="checkbox2" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Checkbox Option 2 (Checked)</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="radio1" name="radio-group" class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                        <label for="radio1" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Radio Option 1</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="radio2" name="radio-group" class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="radio2" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Radio Option 2 (Checked)</label>
                    </div>
                </div>
            </x-ui.card>

            <!-- Button Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Button Component</h2>
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
            </x-ui.card>
        </div>
    </div>
</x-layout.layout>