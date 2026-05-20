@php
    $settings = app(\App\Settings\GeneralSettings::class);
@endphp

<section id="how-to-use" class="py-24 bg-white dark:bg-[#0d0d0d]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                How to Use
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Three simple steps for optimal protection.
            </p>
        </div>
        
        <!-- Steps -->
        <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
            <!-- Step 1 -->
            <div class="relative text-center" data-animate>
                <!-- Step number -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-lg z-10">
                    1
                </div>
                
                <!-- Card -->
                <div class="pt-12 pb-8 px-6 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-[#1a1a1a] rounded-2xl border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Icon -->
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/40 dark:to-amber-800/40 flex items-center justify-center">
                        <svg class="w-10 h-10 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
                        Apply Generously
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Use approximately two finger-lengths of sunscreen for face and neck. Don't forget ears and hairline.
                    </p>
                </div>
                
                <!-- Connector line (hidden on mobile) -->
                <div class="hidden md:block absolute top-1/2 -right-6 w-12 h-0.5 bg-gradient-to-r from-amber-500/50 to-transparent"></div>
            </div>
            
            <!-- Step 2 -->
            <div class="relative text-center" data-animate style="animation-delay: 150ms">
                <!-- Step number -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-lg z-10">
                    2
                </div>
                
                <!-- Card -->
                <div class="pt-12 pb-8 px-6 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-[#1a1a1a] rounded-2xl border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Icon -->
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-sky-100 to-sky-200 dark:from-sky-900/40 dark:to-sky-800/40 flex items-center justify-center">
                        <svg class="w-10 h-10 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
                        Apply Early
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Apply 15-20 minutes before sun exposure to allow the formula to fully bind to your skin.
                    </p>
                </div>
                
                <!-- Connector line (hidden on mobile) -->
                <div class="hidden md:block absolute top-1/2 -right-6 w-12 h-0.5 bg-gradient-to-r from-amber-500/50 to-transparent"></div>
            </div>
            
            <!-- Step 3 -->
            <div class="relative text-center" data-animate style="animation-delay: 300ms">
                <!-- Step number -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-amber-500 text-white flex items-center justify-center text-xl font-bold shadow-lg z-10">
                    3
                </div>
                
                <!-- Card -->
                <div class="pt-12 pb-8 px-6 bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-[#1a1a1a] rounded-2xl border border-gray-200 dark:border-gray-700 h-full">
                    <!-- Icon -->
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/40 dark:to-emerald-800/40 flex items-center justify-center">
                        <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
                        Reapply Often
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Reapply every 2 hours, or immediately after swimming, sweating, or towel drying.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Pro tip -->
        <div class="mt-16 text-center" data-animate>
            <div class="inline-flex items-center gap-3 px-6 py-3 bg-amber-50 dark:bg-amber-900/20 rounded-full border border-amber-200 dark:border-amber-800">
                <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-sm font-medium text-amber-800 dark:text-amber-300">
                    Pro tip: Use daily, even on cloudy days — UV rays penetrate clouds!
                </span>
            </div>
        </div>
    </div>
</section>
