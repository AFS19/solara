@php
    $testimonials = \App\Models\Testimonial::where('is_active', true)
        ->orderByDesc('created_at')
        ->limit(6)
        ->get();
@endphp

<section id="testimonials" class="py-24 bg-gray-50 dark:bg-[#1a1a1a]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-animate>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                What Our Customers Say
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Real reviews from real people loving their protected skin.
            </p>
        </div>
        
        @if($testimonials->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($testimonials as $index => $testimonial)
                    <div 
                        class="bg-white dark:bg-[#0d0d0d] rounded-2xl p-6 lg:p-8 border border-gray-200 dark:border-gray-800 shadow-sm hover:shadow-lg hover:shadow-amber-500/5 transition-all duration-300"
                        data-animate
                        style="animation-delay: {{ $index * 100 }}ms"
                    >
                        <!-- Stars -->
                        <div class="flex gap-1 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        
                        <!-- Quote -->
                        <blockquote class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                            "{{ $testimonial->quote }}"
                        </blockquote>
                        
                        <!-- Author -->
                        <div class="flex items-center gap-4">
                            @if($testimonial->avatar)
                                <img src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->author_name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr($testimonial->author_name, 0, 1)) }}
                                </div>
                            @endif
                            
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">
                                    {{ $testimonial->author_name }}
                                </h4>
                                @if($testimonial->skin_type)
                                    <p class="text-sm text-amber-600 dark:text-amber-400">
                                        {{ $testimonial->skin_type }} skin
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 dark:text-gray-400">No testimonials yet.</p>
            </div>
        @endif
    </div>
</section>
