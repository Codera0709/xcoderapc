<x-layout.layout>
    <x-slot name="title">Data Demo - XCODERA</x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Data Components Demo</h1>
        <p class="text-gray-600 dark:text-gray-400">This page demonstrates all available data display components in XCODERA.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Table Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Table Component</h2>
                <x-data.table
                    :headers="[
                        ['label' => 'Name', 'sortable' => true],
                        ['label' => 'Email', 'sortable' => true],
                        ['label' => 'Role', 'sortable' => false],
                        ['label' => 'Status', 'sortable' => false],
                    ]"
                    :rows="[
                        ['John Doe', 'john@example.com', 'Admin', 'Active'],
                        ['Jane Smith', 'jane@example.com', 'Editor', 'Active'],
                        ['Bob Johnson', 'bob@example.com', 'Viewer', 'Inactive'],
                        ['Alice Williams', 'alice@example.com', 'Admin', 'Active'],
                    ]"
                    :striped="true"
                    :hover="true"
                >
                    <x-slot name="footer">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Showing 1 to 4 of 4 entries</p>
                            <div class="flex gap-2">
                                <x-ui.button size="sm" variant="outline">Previous</x-ui.button>
                                <x-ui.button size="sm" variant="outline">Next</x-ui.button>
                            </div>
                        </div>
                    </x-slot>
                </x-data.table>
            </x-ui.card>

            <!-- Stat Card Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Stat Card Component</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-data.stat-card
                        title="Total Revenue"
                        value="$24,580"
                        change="+12.5%"
                        changeType="increase"
                        icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                        description="Compared to last month"
                    />
                    <x-data.stat-card
                        title="New Users"
                        value="1,248"
                        change="+8.2%"
                        changeType="increase"
                        icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>'
                        description="Compared to last month"
                    />
                </div>
            </x-ui.card>

            <!-- Chart Card Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Chart Card Component</h2>
                <x-data.chart-card title="Revenue Overview" description="Monthly revenue trend">
                    <canvas id="demoChart" class="h-64"></canvas>
                </x-data.chart-card>
            </x-ui.card>

            <!-- Empty State Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Empty State Component</h2>
                <x-data.empty-state
                    title="No Data Available"
                    description="There is no data to display at the moment."
                    icon="folder"
                    actionText="Create New"
                    actionUrl="#"
                />
            </x-ui.card>

            <!-- Progress Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Progress Component</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Task Completion</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">75%</span>
                        </div>
                        <x-data.progress :value="75" color="indigo" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Upload Progress</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">30%</span>
                        </div>
                        <x-data.progress :value="30" color="blue" :animated="true" />
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">System Status</span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">90%</span>
                        </div>
                        <x-data.progress :value="90" color="green" :striped="true" />
                    </div>
                </div>
            </x-ui.card>

            <!-- Timeline Component Demo -->
            <x-ui.card>
                <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Timeline Component</h2>
                <div class="space-y-4">
                    <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                            <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Feb 12, 2024</p>
                            <h3 class="font-medium text-gray-900 dark:text-white">Event Created</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Your event has been created successfully</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                            <div class="w-0.5 h-full bg-gray-200 dark:bg-gray-700"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Feb 13, 2024</p>
                            <h3 class="font-medium text-gray-900 dark:text-white">Event Updated</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Your event has been updated</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col items-center mr-4">
                            <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Feb 14, 2024</p>
                            <h3 class="font-medium text-gray-900 dark:text-white">Event Published</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Your event has been published</p>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>

    <script>
        // Initialize chart after the page loads
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('demoChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue',
                        data: [6500, 7800, 8200, 9500, 8800, 9200],
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
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
        });
    </script>
</x-layout.layout>