<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-init="$watch('dark', val => localStorage.setItem('theme', val ? 'dark' : 'light')); dark && document.documentElement.classList.add('dark')" :class="{ 'dark': dark }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'XCODERA') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: true }">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <x-layout.sidebar />

        <!-- Main Content Area -->
        <div class="transition-all duration-300" :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'">
            <!-- Navbar -->
            <x-layout.navbar />

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <x-layout.footer />
        </div>
    </div>

    <!-- Toast Notification Store -->
    <x-utils.toast-store />

    <!-- Scroll to Top Button -->
    <x-utils.scroll-to-top />

    @stack('scripts')
</body>
</html>
