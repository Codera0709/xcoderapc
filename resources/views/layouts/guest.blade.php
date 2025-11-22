<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Left Side - Form -->
            <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 bg-white dark:bg-gray-900">
                <div class="w-full max-w-md space-y-8">
                    <!-- Logo -->
                    <div class="text-center">
                        <a href="/" class="inline-flex items-center justify-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                <span class="text-2xl font-bold text-white">X</span>
                            </div>
                        </a>
                        <h2 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $title ?? 'Welcome back' }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            {{ $subtitle ?? 'Please sign in to your account' }}
                        </p>
                    </div>

                    <!-- Form Content -->
                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            <!-- Right Side - Image/Illustration -->
            <div class="hidden lg:flex lg:flex-1 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex flex-col justify-center items-center text-white p-12">
                    <div class="max-w-md text-center space-y-6">
                        <div class="w-24 h-24 mx-auto bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold">XCODERA Internal App</h3>
                        <p class="text-lg text-white/90">
                            Powerful internal application platform for managing your business operations efficiently.
                        </p>
                        <div class="flex items-center justify-center space-x-8 pt-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold">100+</div>
                                <div class="text-sm text-white/80">Active Users</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">99.9%</div>
                                <div class="text-sm text-white/80">Uptime</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">24/7</div>
                                <div class="text-sm text-white/80">Support</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mb-48"></div>
            </div>
        </div>
    </body>
</html>
