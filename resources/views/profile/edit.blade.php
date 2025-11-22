<x-layout.layout>
    <x-slot name="title">Profile Settings - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profile Settings</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your account settings and preferences</p>
            </div>
        </div>

        <!-- Profile Header Card -->
        <x-ui.card>
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <!-- Avatar -->
                <div class="relative">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <button class="absolute bottom-0 right-0 w-8 h-8 bg-white dark:bg-gray-800 rounded-full shadow-lg flex items-center justify-center border-2 border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>

                <!-- User Info -->
                <div class="flex-1 text-center sm:text-left">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ Auth::user()->email }}</p>
                    <div class="flex items-center justify-center sm:justify-start gap-2 mt-3">
                        <x-role-badge :role="Auth::user()->getRoleNames()->first() ?? 'Guest'" />
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                            <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3"/>
                            </svg>
                            Active
                        </span>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="flex gap-6 text-center">
                    <div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->created_at->diffInDays(now()) }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Days Active</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->updated_at->format('M d') }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Last Update</div>
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Profile Information -->
        <x-ui.card>
            <x-slot name="header">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Profile Information</h3>
                </div>
            </x-slot>

            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </x-ui.card>

        <!-- Update Password -->
        <x-ui.card>
            <x-slot name="header">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Password</h3>
                </div>
            </x-slot>

            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </x-ui.card>

        <!-- Delete Account -->
        <x-ui.card>
            <x-slot name="header">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Delete Account</h3>
                </div>
            </x-slot>

            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </x-ui.card>
    </div>
</x-layout.layout>
