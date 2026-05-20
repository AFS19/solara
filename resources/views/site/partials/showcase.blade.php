@php
    $products = \App\Models\Product::where('is_featured', true)
        ->orderBy('sort_order')
        ->get();
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp

<section id="products" class="py-24 bg-white dark:bg-[#0d0d0d]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                Find Your Perfect Protection
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Advanced formulas designed for every skin type and lifestyle.
            </p>
        </div>
        
        @if($products->count() > 0)
            <div x-data="{ 
                activeProduct: {{ $products->first()->id }},
                products: {{ $products->toJson() }},
                get currentProduct() {
                    return this.products.find(p => p.id === this.activeProduct)
                }
            }" class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                
                <!-- 3D Product Viewer -->
                <div class="order-2 lg:order-1" data-animate>
                    <div id="showcase-canvas" class="w-full aspect-square rounded-3xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900 shadow-2xl relative overflow-hidden">
                        <!-- Loading state -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-amber-500"></div>
                        </div>
                    </div>
                    
                    <!-- Product info overlay for mobile -->
                    <div class="lg:hidden mt-6 text-center">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2" x-text="currentProduct.name"></h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4" x-text="currentProduct.tagline"></p>
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400" x-text="'SPF ' + currentProduct.spf_value"></span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium bg-sky-100 dark:bg-sky-900/30 text-sky-700 dark:text-sky-400" x-text="currentProduct.skin_type"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Product Selection -->
                <div class="order-1 lg:order-2" data-animate>
                    <div class="hidden lg:block mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3" x-text="currentProduct.name"></h3>
                        <p class="text-xl text-amber-500 font-medium mb-4" x-text="currentProduct.tagline"></p>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed" x-text="currentProduct.description"></p>
                        
                        <div class="flex items-center gap-3 mt-6">
                            <span class="px-4 py-2 rounded-full text-sm font-semibold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                SPF <span x-text="currentProduct.spf_value"></span>
                            </span>
                            <span class="px-4 py-2 rounded-full text-sm font-semibold bg-sky-100 dark:bg-sky-900/30 text-sky-700 dark:text-sky-400 border border-sky-200 dark:border-sky-800" x-text="currentProduct.skin_type"></span>
                        </div>
                    </div>
                    
                    <!-- Product Tabs -->
                    <div class="space-y-3">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Select variant:</p>
                        <template x-for="product in products" :key="product.id">
                            <button 
                                @click="activeProduct = product.id; $dispatch('product-change', product)"
                                :class="{ 
                                    'ring-2 ring-amber-500 bg-amber-50 dark:bg-amber-900/20': activeProduct === product.id,
                                    'hover:bg-gray-50 dark:hover:bg-gray-800': activeProduct !== product.id
                                }"
                                class="w-full flex items-center gap-4 p-4 rounded-xl border border-gray-200 dark:border-gray-700 transition-all duration-200 text-left"
                            >
                                <!-- Color swatch -->
                                <div 
                                    class="w-12 h-12 rounded-full shadow-inner flex-shrink-0"
                                    :style="{ backgroundColor: product.color_hex }"
                                ></div>
                                
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-semibold text-gray-900 dark:text-white" x-text="product.name"></h4>
                                        <span class="text-xs font-medium text-amber-600 dark:text-amber-400" x-text="'SPF ' + product.spf_value"></span>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate" x-text="product.tagline"></p>
                                </div>
                                
                                <!-- Check icon -->
                                <svg x-show="activeProduct === product.id" class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </template>
                    </div>
                    
                    <!-- CTA -->
                    <div class="mt-8">
                        <a :href="'{{ $settings->hero_cta_url }}'" class="inline-flex items-center justify-center w-full sm:w-auto px-8 py-4 text-base font-semibold rounded-xl text-white bg-amber-500 hover:bg-amber-600 transition-all duration-200 shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40 transform hover:-translate-y-0.5">
                            Shop Now
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 dark:text-gray-400">No products available.</p>
            </div>
        @endif
    </div>
</section>
