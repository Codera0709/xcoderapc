@props([
    'show' => false,
    'message' => 'Loading...',
    'spinnerSize' => 'lg',
    'spinnerColor' => 'indigo',
    'blur' => true,
])

<div
    x-data="{ show: {{ $show ? 'true' : 'false' }} }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @loading-start.window="show = true"
    @loading-end.window="show = false"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/50 {{ $blur ? 'backdrop-blur-sm' : '' }}"
    style="display: none;"
>
    <div class="flex flex-col items-center gap-4 p-8 bg-white dark:bg-gray-800 rounded-lg shadow-xl">
        <x-ui.spinner :size="$spinnerSize" :color="$spinnerColor" />
        @if($message)
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $message }}</p>
        @endif
        @if(isset($slot) && !empty(trim($slot)))
            <div class="text-center">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>

<script>
// Global helpers for loading overlay
window.showLoading = function() {
    window.dispatchEvent(new CustomEvent('loading-start'));
}

window.hideLoading = function() {
    window.dispatchEvent(new CustomEvent('loading-end'));
}
</script>
