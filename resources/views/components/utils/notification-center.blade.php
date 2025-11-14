@props([
    'notifications' => [],
])

<div x-data="{
    open: false,
    notifications: {{ json_encode($notifications) }},
    unreadCount: 0,

    init() {
        this.updateUnreadCount();

        // Listen for new notifications
        window.addEventListener('add-notification', (event) => {
            this.addNotification(event.detail);
        });
    },

    updateUnreadCount() {
        this.unreadCount = this.notifications.filter(n => !n.read).length;
    },

    addNotification(notification) {
        this.notifications.unshift({
            id: Date.now(),
            title: notification.title || 'Notification',
            message: notification.message || '',
            time: notification.time || 'Just now',
            type: notification.type || 'info',
            read: false,
            icon: notification.icon || null
        });
        this.updateUnreadCount();
    },

    markAsRead(id) {
        const notification = this.notifications.find(n => n.id === id);
        if (notification) {
            notification.read = true;
            this.updateUnreadCount();
        }
    },

    markAllAsRead() {
        this.notifications.forEach(n => n.read = true);
        this.updateUnreadCount();
    },

    removeNotification(id) {
        this.notifications = this.notifications.filter(n => n.id !== id);
        this.updateUnreadCount();
    },

    clearAll() {
        this.notifications = [];
        this.updateUnreadCount();
    }
}" class="relative">
    <!-- Notification Bell Button -->
    <button
        @click="open = !open"
        class="relative p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>

        <!-- Badge -->
        <span
            x-show="unreadCount > 0"
            x-text="unreadCount > 9 ? '9+' : unreadCount"
            class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full transform translate-x-1/2 -translate-y-1/2"
        ></span>
    </button>

    <!-- Notification Panel -->
    <div
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-96 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50"
        style="display: none;"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifications</h3>
            <div class="flex gap-2">
                <button
                    @click="markAllAsRead()"
                    x-show="unreadCount > 0"
                    class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium"
                >
                    Mark all read
                </button>
            </div>
        </div>

        <!-- Notification List -->
        <div class="max-h-96 overflow-y-auto">
            <template x-if="notifications.length === 0">
                <div class="px-4 py-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400">No notifications</p>
                </div>
            </template>

            <template x-for="notification in notifications" :key="notification.id">
                <div
                    @click="markAsRead(notification.id)"
                    class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer transition-colors"
                    :class="{ 'bg-indigo-50/50 dark:bg-indigo-900/10': !notification.read }"
                >
                    <div class="flex gap-3">
                        <!-- Icon -->
                        <div class="flex-shrink-0 mt-0.5">
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center"
                                :class="{
                                    'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400': notification.type === 'info',
                                    'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400': notification.type === 'success',
                                    'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400': notification.type === 'error',
                                    'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400': notification.type === 'warning',
                                }"
                            >
                                <template x-if="notification.type === 'info'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'success'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'error'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'warning'">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </template>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="notification.title"></p>
                                <button
                                    @click.stop="removeNotification(notification.id)"
                                    class="flex-shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1" x-text="notification.message"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1" x-text="notification.time"></p>
                        </div>

                        <!-- Unread indicator -->
                        <div x-show="!notification.read" class="flex-shrink-0 mt-2">
                            <span class="inline-block w-2 h-2 bg-indigo-600 rounded-full"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            <button
                @click="clearAll()"
                x-show="notifications.length > 0"
                class="w-full text-sm text-center text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium"
            >
                Clear all notifications
            </button>
        </div>
    </div>
</div>

<script>
// Global helper to add notification
window.addNotification = function(notification) {
    window.dispatchEvent(new CustomEvent('add-notification', {
        detail: notification
    }));
}
</script>
