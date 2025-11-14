<x-layout.layout>
    <x-slot name="title">Page Not Found - XCODERA</x-slot>

    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full text-center">
            <div class="inline-flex items-center justify-center">
                <div class="relative">
                    <div class="w-48 h-48 bg-indigo-100 dark:bg-indigo-900/20 rounded-full flex items-center justify-center">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-32 h-32 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center">
                                <span class="text-6xl font-bold text-gray-900 dark:text-white">4</span>
                            </div>
                        </div>
                        <div class="w-16 h-16 bg-indigo-500 rounded-full absolute top-0 right-0 animate-bounce"></div>
                        <div class="w-16 h-16 bg-indigo-500 rounded-full absolute bottom-0 left-0 animate-bounce" style="animation-delay: 0.2s;"></div>
                    </div>
                </div>
            </div>
            
            <h1 class="mt-12 text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight sm:text-4xl">Page not found</h1>
            <p class="mt-4 text-base text-gray-500 dark:text-gray-400">
                Sorry, we couldn't find the page you're looking for.
            </p>
            
            <div class="mt-10">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Go back home
                </a>
            </div>
            
            <div class="mt-6">
                <a href="#" class="text-base font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                    Contact support
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>
</x-layout.layout>