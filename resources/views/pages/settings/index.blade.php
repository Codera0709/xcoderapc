<x-layout.layout>
    <x-slot name="title">Settings - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your account and application settings</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- Settings Tabs -->
        <x-ui.card>
            <x-utils.tabs :tabs="[
                ['id' => 'profile', 'label' => 'Profile', 'icon' => 'user'],
                ['id' => 'account', 'label' => 'Account', 'icon' => 'cog'],
                ['id' => 'security', 'label' => 'Security', 'icon' => 'shield'],
                ['id' => 'notifications', 'label' => 'Notifications', 'icon' => 'bell'],
                ['id' => 'appearance', 'label' => 'Appearance', 'icon' => 'palette', 'count' => 3]
            ]">
                <x-slot name="content">
                    <!-- Profile Tab -->
                    <div x-show="activeTab === 'profile'" class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Profile Information</h2>
                        <form class="space-y-4" method="POST" action="{{ route('settings.profile.update') }}">
                            @csrf
                            @method('POST')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-form.input 
                                    name="first_name" 
                                    label="First Name" 
                                    placeholder="John" 
                                    :value="old('first_name', explode(' ', $user->name)[0] ?? '')" 
                                />
                                <x-form.input 
                                    name="last_name" 
                                    label="Last Name" 
                                    placeholder="Doe" 
                                    :value="old('last_name', implode(' ', array_slice(explode(' ', $user->name), 1)) ?? '')" 
                                />
                            </div>
                            <x-form.input 
                                name="email" 
                                type="email" 
                                label="Email Address" 
                                placeholder="john@example.com" 
                                :value="old('email', $user->email)" 
                            />
                            <x-form.input 
                                name="bio" 
                                label="Bio" 
                                placeholder="Tell us about yourself" 
                                :value="old('bio', $user->bio ?? '')" 
                                rows="4" 
                            />

                            <x-ui.button variant="primary">Save Profile</x-ui.button>
                        </form>
                    </div>

                    <!-- Account Tab -->
                    <div x-show="activeTab === 'account'" class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Account Settings</h2>
                        <form class="space-y-4" method="POST" action="{{ route('settings.account.update') }}">
                            @csrf
                            @method('POST')
                            <x-form.input 
                                name="username" 
                                label="Username" 
                                placeholder="john_doe" 
                                :value="old('username', $user->username ?? '')" 
                            />
                            <x-form.input 
                                name="timezone" 
                                label="Timezone" 
                                placeholder="Select timezone" 
                                :value="old('timezone', $user->timezone ?? '')" 
                            />
                            <x-form.select 
                                name="language" 
                                label="Language" 
                                :options="['en' => 'English', 'id' => 'Indonesian', 'es' => 'Spanish']" 
                                :value="old('language', $user->language ?? 'en')" 
                            />

                            <x-ui.button variant="primary">Update Account</x-ui.button>
                        </form>
                    </div>

                    <!-- Security Tab -->
                    <div x-show="activeTab === 'security'" class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Security Settings</h2>
                        <form class="space-y-4" method="POST" action="{{ route('settings.security.update') }}">
                            @csrf
                            @method('POST')
                            <x-form.input 
                                name="current_password" 
                                type="password" 
                                label="Current Password" 
                                placeholder="••••••••" 
                                required 
                            />
                            <x-form.input 
                                name="new_password" 
                                type="password" 
                                label="New Password" 
                                placeholder="••••••••" 
                                required 
                            />
                            <x-form.input 
                                name="password_confirmation" 
                                type="password" 
                                label="Confirm New Password" 
                                placeholder="••••••••" 
                                required 
                            />

                            <x-ui.button variant="primary">Change Password</x-ui.button>
                        </form>
                    </div>

                    <!-- Notifications Tab -->
                    <div x-show="activeTab === 'notifications'" class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Notifications</h2>
                        <form class="space-y-6" method="POST" action="{{ route('settings.notifications.update') }}">
                            @csrf
                            @method('POST')
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Email Notifications</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Receive notifications via email</p>
                                    </div>
                                    <x-form.switch 
                                        name="email_notifications" 
                                        :checked="old('email_notifications', $user->email_notifications ?? true)" 
                                    />
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Push Notifications</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Receive push notifications on your devices</p>
                                    </div>
                                    <x-form.switch 
                                        name="push_notifications" 
                                        :checked="old('push_notifications', $user->push_notifications ?? true)" 
                                    />
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">SMS Notifications</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Receive notifications via SMS</p>
                                    </div>
                                    <x-form.switch 
                                        name="sms_notifications" 
                                        :checked="old('sms_notifications', $user->sms_notifications ?? false)" 
                                    />
                                </div>
                            </div>

                            <x-ui.button variant="primary">Save Notifications</x-ui.button>
                        </form>
                    </div>

                    <!-- Appearance Tab -->
                    <div x-show="activeTab === 'appearance'" class="space-y-4">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Appearance Settings</h2>
                        <form class="space-y-4" method="POST" action="{{ route('settings.appearance.update') }}">
                            @csrf
                            @method('POST')
                            <x-form.select 
                                name="theme" 
                                label="Theme" 
                                :options="['auto' => 'Auto (System)', 'light' => 'Light', 'dark' => 'Dark']" 
                                :value="old('theme', $user->theme ?? 'auto')" 
                            />
                            <x-form.select 
                                name="layout" 
                                label="Layout" 
                                :options="['sidebar' => 'Default', 'topbar' => 'Top Bar']" 
                                :value="old('layout', $user->layout ?? 'sidebar')" 
                            />
                            <x-form.select 
                                name="font_size" 
                                label="Font Size" 
                                :options="['small' => 'Small', 'normal' => 'Normal', 'large' => 'Large']" 
                                :value="old('font_size', $user->font_size ?? 'normal')" 
                            />

                            <x-ui.button variant="primary">Save Appearance</x-ui.button>
                        </form>
                    </div>
                </x-slot>
            </x-utils.tabs>
        </x-ui.card>
    </div>
</x-layout.layout>