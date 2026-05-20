@php
    $ingredients = \App\Models\Ingredient::where('is_active', true)
        ->orderBy('sort_order')
        ->get();
@endphp

<section id="ingredients" class="py-24 bg-gray-50 dark:bg-[#1a1a1a]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                Key Ingredients
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Science-backed ingredients for superior sun protection and skin health.
            </p>
        </div>
        
        @if($ingredients->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($ingredients as $index => $ingredient)
                    <div 
                        class="group bg-white dark:bg-[#0d0d0d] rounded-2xl p-6 border border-gray-200 dark:border-gray-800 hover:border-amber-500/50 dark:hover:border-amber-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1"
                        data-animate
                        style="animation-delay: {{ $index * 100 }}ms"
                    >
                        <!-- Icon -->
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/40 dark:to-amber-800/40 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            @if($ingredient->icon)
                                <img src="{{ Storage::url($ingredient->icon) }}" alt="" class="w-8 h-8 object-contain">
                            @else
                                <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                            {{ $ingredient->name }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $ingredient->benefit }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 dark:text-gray-400">No ingredients listed.</p>
            </div>
        @endif
    </div>
</section>
