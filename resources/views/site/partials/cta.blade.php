@php
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp

<section class="py-24 bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 dark:from-amber-600 dark:via-amber-700 dark:to-orange-800 relative overflow-hidden">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>
    
    <!-- Decorative circles -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-animate>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">
            Ready to Protect Your Skin?
        </h2>
        <p class="text-lg sm:text-xl text-amber-100 mb-10 max-w-2xl mx-auto">
            Join thousands of happy customers who've made our sunscreen their daily essential.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $settings->hero_cta_url }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl text-amber-600 bg-white hover:bg-amber-50 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5">
                {{ $settings->hero_cta_text }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
            
            <a href="#products" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-xl text-white border-2 border-white/50 hover:border-white hover:bg-white/10 transition-all duration-200">
                View Products
            </a>
        </div>
        
        <!-- Trust indicators -->
        <div class="mt-12 flex flex-wrap items-center justify-center gap-6 text-amber-100 text-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Free shipping over $50</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>30-day guarantee</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>Dermatologist tested</span>
            </div>
        </div>
    </div>
</section>
