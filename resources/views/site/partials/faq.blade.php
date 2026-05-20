@php
    $faqs = \App\Models\Faq::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
@endphp

<section id="faq" class="py-24 bg-white dark:bg-[#0d0d0d]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                Frequently Asked Questions
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">
                Everything you need to know about our sunscreen.
            </p>
        </div>
        
        @if($faqs->count() > 0)
            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faqs as $index => $faq)
                    <div 
                        class="border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden bg-gray-50 dark:bg-[#1a1a1a]"
                        data-animate
                        style="animation-delay: {{ $index * 50 }}ms"
                    >
                        <button 
                            @click="active = active === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                            :aria-expanded="active === {{ $index }}"
                        >
                            <span class="font-semibold text-gray-900 dark:text-white pr-4">
                                {{ $faq->question }}
                            </span>
                            <svg 
                                class="w-5 h-5 text-amber-500 flex-shrink-0 transition-transform duration-200"
                                :class="{ 'rotate-180': active === {{ $index }} }"
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div 
                            x-show="active === {{ $index }}"
                            x-collapse
                            x-cloak
                            class="border-t border-gray-200 dark:border-gray-700"
                        >
                            <div class="p-6 text-gray-600 dark:text-gray-400 leading-relaxed">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 dark:text-gray-400">No FAQs available.</p>
            </div>
        @endif
    </div>
</section>
