@php
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp

<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-b from-amber-50/50 to-white dark:from-[#0d0d0d] dark:to-[#1a1a1a] pt-16">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-amber-400/20 dark:bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-sky-400/20 dark:bg-sky-500/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <!-- Content -->
            <div class="text-center lg:text-left order-2 lg:order-1" data-animate>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold tracking-tight text-gray-900 dark:text-white mb-6">
                    {{ $settings->hero_headline }}
                </h1>
                
                @if($settings->hero_subtext)
                    <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto lg:mx-0">
                        {{ $settings->hero_subtext }}
                    </p>
                @endif
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ $settings->hero_cta_url }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl text-white bg-amber-500 hover:bg-amber-600 transition-all duration-200 shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40 transform hover:-translate-y-0.5">
                        {{ $settings->hero_cta_text }}
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    
                    <a href="#products" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl text-gray-700 dark:text-gray-200 bg-white dark:bg-[#1a1a1a] border-2 border-gray-200 dark:border-gray-700 hover:border-amber-500 dark:hover:border-amber-500 transition-all duration-200">
                        Explore Products
                    </a>
                </div>
                
                <!-- Trust badges -->
                <div class="mt-12 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span> reef safe</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>non-comedogenic</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>cruelty-free</span>
                    </div>
                </div>
            </div>
            
            <!-- 3D Canvas -->
            <div class="order-1 lg:order-2 flex justify-center">
                <div id="hero-product-canvas" class="w-full max-w-lg aspect-square rounded-3xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 shadow-2xl" data-product-color="{{ $settings->primary_color ?? '#f59e0b' }}"></div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>
