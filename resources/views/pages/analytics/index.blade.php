<x-layout.layout>
    <x-slot name="title">Analytics - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Analytics</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Monitor and analyze your system performance</p>
            </div>
            <div class="flex gap-3">
                <x-form.select name="date-range" :options="['today' => 'Today', 'week' => 'This Week', 'month' => 'This Month', 'quarter' => 'This Quarter', 'year' => 'This Year']" />
                <x-ui.button variant="primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Export Report
                </x-ui.button>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-data.stat-card
                title="Total Visitors"
                value="24,580"
                change="+12.5%"
                changeType="increase"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>'
                description="Compared to last month"
            />
            <x-data.stat-card
                title="Page Views"
                value="142,248"
                change="+8.2%"
                changeType="increase"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>'
                description="Compared to last month"
            />
            <x-data.stat-card
                title="Avg. Session"
                value="5m 32s"
                change="-2.1%"
                changeType="decrease"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                description="Compared to last month"
            />
            <x-data.stat-card
                title="Bounce Rate"
                value="34.8%"
                change="-1.7%"
                changeType="increase"
                icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>'
                description="Compared to last month"
            />
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Traffic Chart -->
            <x-data.chart-card title="Traffic Overview" description="Visitors and page views trend">
                <canvas id="trafficChart" class="h-80"></canvas>
            </x-data.chart-card>

            <!-- Conversion Chart -->
            <x-data.chart-card title="Conversion Rate" description="Conversion rate by channel">
                <canvas id="conversionChart" class="h-80"></canvas>
            </x-data.chart-card>
        </div>

        <!-- Additional Analytics Data -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Top Pages -->
            <x-ui.card>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Top Pages</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">/dashboard</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Dashboard overview</p>
                        </div>
                        <span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            24.5%
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">/users</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">User management</p>
                        </div>
                        <span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            18.2%
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">/reports</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Reports dashboard</p>
                        </div>
                        <span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            15.7%
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">/settings</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">User settings</p>
                        </div>
                        <span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            12.3%
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">/analytics</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Analytics page</p>
                        </div>
                        <span class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-400 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            10.1%
                        </span>
                    </div>
                </div>
            </x-ui.card>

            <!-- Traffic Sources -->
            <x-ui.card>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Traffic Sources</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Direct</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">42.5%</span>
                        </div>
                        <x-data.progress :value="42.5" color="indigo" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Search Engines</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">28.3%</span>
                        </div>
                        <x-data.progress :value="28.3" color="blue" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Social Media</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">18.7%</span>
                        </div>
                        <x-data.progress :value="18.7" color="green" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Referrals</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">10.5%</span>
                        </div>
                        <x-data.progress :value="10.5" color="yellow" />
                    </div>
                </div>
            </x-ui.card>

            <!-- Device Types -->
            <x-ui.card>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Device Types</h3>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Desktop</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">62.8%</span>
                        </div>
                        <x-data.progress :value="62.8" color="indigo" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mobile</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">32.1%</span>
                        </div>
                        <x-data.progress :value="32.1" color="blue" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tablet</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">5.1%</span>
                        </div>
                        <x-data.progress :value="5.1" color="purple" />
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>

    <script>
        // Initialize charts after the page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Traffic Chart
            const trafficCtx = document.getElementById('trafficChart').getContext('2d');
            new Chart(trafficCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [
                        {
                            label: 'Visitors',
                            data: [3500, 4800, 5200, 6500, 5800, 7200, 9500, 8200, 10500, 12580, 11200, 13800],
                            borderColor: '#4f46e5',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Page Views',
                            data: [18000, 24000, 28000, 35000, 32000, 42000, 58000, 52000, 68000, 82000, 75000, 92000],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Conversion Chart
            const conversionCtx = document.getElementById('conversionChart').getContext('2d');
            new Chart(conversionCtx, {
                type: 'bar',
                data: {
                    labels: ['Direct', 'Organic', 'Social', 'Email', 'Referral'],
                    datasets: [{
                        label: 'Conversion Rate',
                        data: [3.2, 4.8, 2.1, 5.7, 1.9],
                        backgroundColor: [
                            '#4f46e5',
                            '#818cf8',
                            '#22d3ee',
                            '#34d399',
                            '#fbbf24'
                        ],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Conversion Rate (%)'
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layout.layout>
