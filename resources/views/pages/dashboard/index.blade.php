<x-layout.layout>
    <x-slot name="title">Dashboard - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <x-ui.button variant="primary" href="{{ route('users.index') }}">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New User
            </x-ui.button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-data.stat-card
                title="Total Users"
                value="2,543"
                :change="'+12.5%'"
                changeType="increase"
                description="from last month"
                iconBg="blue"
                :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z\'/></svg>'"
            />

            <x-data.stat-card
                title="Revenue"
                value="$45,231"
                :change="'+8.2%'"
                changeType="increase"
                description="from last month"
                iconBg="green"
                :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z\'/></svg>'"
            />

            <x-data.stat-card
                title="Active Projects"
                value="128"
                :change="'-2.4%'"
                changeType="decrease"
                description="from last month"
                iconBg="purple"
                :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\'/></svg>'"
            />

            <x-data.stat-card
                title="Completion Rate"
                value="94.5%"
                :change="'+5.1%'"
                changeType="increase"
                description="from last month"
                iconBg="yellow"
                :icon="'<svg class=\'w-6 h-6\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z\'/></svg>'"
            />
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Revenue Chart -->
            <x-data.chart-card
                title="Revenue Overview"
                type="line"
                height="300"
                :data="json_encode([
                    'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    'datasets' => [
                        [
                            'label' => 'Revenue 2024',
                            'data' => [30000, 35000, 32000, 40000, 38000, 42000, 45231],
                            'borderColor' => 'rgb(34, 197, 94)',
                            'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                            'tension' => 0.4,
                            'fill' => true
                        ]
                    ]
                ])"
            />

            <!-- User Growth Chart -->
            <x-data.chart-card
                title="User Growth"
                type="bar"
                height="300"
                :data="json_encode([
                    'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    'datasets' => [
                        [
                            'label' => 'New Users',
                            'data' => [250, 320, 280, 350, 400, 380, 420],
                            'backgroundColor' => 'rgba(59, 130, 246, 0.8)',
                        ]
                    ]
                ])"
            />
        </div>

        <!-- Recent Activity & Quick Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <x-ui.card>
                    <x-slot name="header">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Activity</h3>
                            <x-ui.button size="sm" variant="ghost" href="{{ route('reports.index') }}">View All</x-ui.button>
                        </div>
                    </x-slot>

                    <x-data.timeline
                        :items="[
                            [
                                'title' => 'New user registered',
                                'description' => 'John Doe created a new account',
                                'timestamp' => '2 minutes ago',
                                'iconBg' => 'blue',
                                'icon' => '<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z\'/></svg>'
                            ],
                            [
                                'title' => 'Payment received',
                                'description' => 'Invoice #1234 paid successfully',
                                'timestamp' => '15 minutes ago',
                                'iconBg' => 'green',
                                'icon' => '<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z\'/></svg>'
                            ],
                            [
                                'title' => 'Project completed',
                                'description' => 'Website redesign finished',
                                'timestamp' => '1 hour ago',
                                'iconBg' => 'purple',
                                'icon' => '<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z\'/></svg>'
                            ],
                            [
                                'title' => 'New comment',
                                'description' => 'Someone commented on your post',
                                'timestamp' => '3 hours ago',
                                'iconBg' => 'indigo',
                                'icon' => '<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z\'/></svg>'
                            ],
                        ]"
                    />
                </x-ui.card>
            </div>

            <!-- Quick Actions -->
            <div>
                <x-ui.card>
                    <x-slot name="header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    </x-slot>

                    <div class="grid grid-cols-1 gap-3">
                        <x-ui.button variant="outline" href="{{ route('users.index') }}" class="justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Add User
                        </x-ui.button>

                        <x-ui.button variant="outline" href="{{ route('reports.index') }}" class="justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            View Reports
                        </x-ui.button>

                        <x-ui.button variant="outline" href="{{ route('settings.index') }}" class="justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </x-ui.button>

                        <x-ui.button variant="outline" @click="showToast('Help center coming soon!', 'info')" class="justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Help Center
                        </x-ui.button>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
</x-layout.layout>
