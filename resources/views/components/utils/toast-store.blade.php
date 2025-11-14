{{-- Alpine.js Toast Notification Store --}}
<div
    x-data="toastStore()"
    x-init="init()"
    class="fixed z-50"
    :class="{
        'top-4 left-4': position === 'top-left',
        'top-4 left-1/2 -translate-x-1/2': position === 'top-center',
        'top-4 right-4': position === 'top-right',
        'bottom-4 left-4': position === 'bottom-left',
        'bottom-4 left-1/2 -translate-x-1/2': position === 'bottom-center',
        'bottom-4 right-4': position === 'bottom-right',
    }"
>
    <div class="space-y-3">
        <template x-for="toast in toasts" :key="toast.id">
            <div
                x-show="toast.show"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-y-2 opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg border max-w-sm"
                :class="{
                    'bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700': toast.type === 'info',
                    'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800': toast.type === 'success',
                    'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800': toast.type === 'error',
                    'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-200 dark:border-yellow-800': toast.type === 'warning',
                }"
            >
                <!-- Icon -->
                <div class="flex-shrink-0">
                    <template x-if="toast.type === 'success'">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </template>
                </div>

                <!-- Message -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium"
                       :class="{
                           'text-gray-900 dark:text-white': toast.type === 'info',
                           'text-green-800 dark:text-green-200': toast.type === 'success',
                           'text-red-800 dark:text-red-200': toast.type === 'error',
                           'text-yellow-800 dark:text-yellow-200': toast.type === 'warning',
                       }"
                       x-text="toast.message"
                    ></p>
                </div>

                <!-- Close Button -->
                <button
                    @click="remove(toast.id)"
                    class="flex-shrink-0 rounded-lg p-1 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    :class="{
                        'text-gray-400 hover:text-gray-600 dark:hover:text-gray-300': toast.type === 'info',
                        'text-green-400 hover:text-green-600 dark:hover:text-green-300': toast.type === 'success',
                        'text-red-400 hover:text-red-600 dark:hover:text-red-300': toast.type === 'error',
                        'text-yellow-400 hover:text-yellow-600 dark:hover:text-yellow-300': toast.type === 'warning',
                    }"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </template>
    </div>
</div>

<script>
function toastStore() {
    return {
        toasts: [],
        position: 'top-right',
        nextId: 1,

        init() {
            // Listen for toast events
            window.addEventListener('show-toast', (event) => {
                this.add(event.detail);
            });
        },

        add(toast) {
            const id = this.nextId++;
            const newToast = {
                id: id,
                type: toast.type || 'info',
                message: toast.message || 'Notification',
                duration: toast.duration || 3000,
                show: false
            };

            this.toasts.push(newToast);

            // Show with slight delay for animation
            setTimeout(() => {
                const toastIndex = this.toasts.findIndex(t => t.id === id);
                if (toastIndex !== -1) {
                    this.toasts[toastIndex].show = true;
                }
            }, 10);

            // Auto remove after duration
            if (newToast.duration > 0) {
                setTimeout(() => {
                    this.remove(id);
                }, newToast.duration);
            }
        },

        remove(id) {
            const toastIndex = this.toasts.findIndex(t => t.id === id);
            if (toastIndex !== -1) {
                this.toasts[toastIndex].show = false;

                // Remove from array after animation
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 300);
            }
        },

        setPosition(position) {
            this.position = position;
        }
    }
}

// Global helper function to show toast
window.showToast = function(message, type = 'info', duration = 3000) {
    window.dispatchEvent(new CustomEvent('show-toast', {
        detail: { message, type, duration }
    }));
}
</script>
