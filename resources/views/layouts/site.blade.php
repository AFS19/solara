<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @php
        $settings = app(\App\Settings\GeneralSettings::class);
    @endphp
    
    <title>@yield('title', $settings->brand_name)</title>
    <meta name="description" content="@yield('description', $settings->brand_tagline)">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
    </style>
    <script>
        // Prevent FOUC for dark mode
        (function() {
            const theme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (theme === 'dark' || (!theme && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>
<body class="font-sans antialiased bg-white dark:bg-[#0d0d0d] text-gray-900 dark:text-[#f1f5f9] transition-colors duration-300">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-[#0d0d0d]/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 transition-colors duration-300"
         x-data="{
             mobileMenuOpen: false,
             darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
         }"
         x-init="$watch('mobileMenuOpen', value => { document.body.classList.toggle('overflow-hidden', value); }); $watch('darkMode', value => { document.documentElement.classList.toggle('dark', value); localStorage.setItem('theme', value ? 'dark' : 'light'); })">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $settings->brand_name }}
                    </a>
                </div>
                
                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#products" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 transition-colors">
                        Products
                    </a>
                    <a href="#ingredients" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 transition-colors">
                        Ingredients
                    </a>
                    <a href="#testimonials" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 transition-colors">
                        Reviews
                    </a>
                    <a href="#faq" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 transition-colors">
                        FAQ
                    </a>
                    
                    <!-- Theme Toggle -->
                    <button
                        @click="darkMode = !darkMode"
                        class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        aria-label="Toggle theme"
                    >
                        <!-- Sun icon -->
                        <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <!-- Moon icon -->
                        <svg x-show="!darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    
                    <!-- CTA -->
                    <a href="{{ $settings->hero_cta_url }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-amber-500 hover:bg-amber-600 transition-colors">
                        {{ $settings->hero_cta_text }}
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2">
                    <!-- Mobile Theme Toggle -->
                    <button
                        @click="darkMode = !darkMode"
                        class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        aria-label="Toggle theme"
                    >
                        <svg x-show="darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg x-show="!darkMode" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>
                    
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                        aria-label="Toggle menu"
                    >
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">
            <div class="px-4 pt-2 pb-4 space-y-1 bg-white dark:bg-[#0d0d0d] border-b border-gray-200 dark:border-gray-800">
                <a href="#products" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Products
                </a>
                <a href="#ingredients" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Ingredients
                </a>
                <a href="#testimonials" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    Reviews
                </a>
                <a href="#faq" @click="mobileMenuOpen = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-amber-500 dark:hover:text-amber-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    FAQ
                </a>
                <a href="{{ $settings->hero_cta_url }}" class="block px-3 py-2 mt-4 text-center rounded-lg text-white bg-amber-500 hover:bg-amber-600 transition-colors font-medium">
                    {{ $settings->hero_cta_text }}
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('site.partials.footer')
    
</body>
</html>
