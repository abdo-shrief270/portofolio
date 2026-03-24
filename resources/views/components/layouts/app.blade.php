<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Abdelrahman Shrief - Senior Backend Developer' }}</title>
    <meta name="description" content="{{ $description ?? 'Senior Backend Developer specializing in Laravel, PHP, and modern web technologies.' }}">

    <!-- Favicon / Nav Icon for Google Search -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/jpeg" sizes="192x192" href="{{ asset('assets/profile_image.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/profile_image.jpg') }}">

    <!-- Open Graph / Social Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'Abdelrahman Shrief - Senior Backend Developer' }}">
    <meta property="og:description" content="{{ $description ?? 'Senior Backend Developer specializing in Laravel, PHP, and modern web technologies.' }}">
    <meta property="og:image" content="{{ asset('assets/profile_image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Abdelrahman Shrief">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Abdelrahman Shrief - Senior Backend Developer' }}">
    <meta name="twitter:description" content="{{ $description ?? 'Senior Backend Developer specializing in Laravel, PHP, and modern web technologies.' }}">
    <meta name="twitter:image" content="{{ asset('assets/profile_image.jpg') }}">
    <meta name="theme-color" content="#4f46e5">

    <!-- DNS prefetch for 3rd parties -->
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">

    <!-- Fonts: preconnect + non-render-blocking load with font-display:swap -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="preload" as="style" href="https://fonts.bunny.net/css?family=inter:400,500,600,700|cairo:400,500,600,700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|cairo:400,500,600,700&display=swap" rel="stylesheet"></noscript>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('styles')

    <style>
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        @keyframes blob {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        .bg-grid {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .animate-spin-slow {
            animation: spin-slow 8s linear infinite;
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-glow {
            animation: glow 2s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            to { box-shadow: 0 0 40px rgba(168, 85, 247, 0.5); }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 {{ app()->getLocale() === 'ar' ? 'font-cairo' : 'font-inter' }}">
    <!-- Skip to main content link for keyboard/screen reader users -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[100] focus:bg-indigo-600 focus:text-white focus:px-6 focus:py-3 focus:rounded-xl focus:shadow-lg focus:outline-none">
        {{ __('Skip to main content') }}
    </a>

    <div class="min-h-screen">
        <x-navbar />
        <main id="main-content">
            {{ $slot }}
        </main>
        <x-footer />
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
