@props([
    'block' => null,
])

@if ($block)
    <div class="gsap-fade max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 mt-16">
        @foreach ($block->testimonials()->toStructure() as $testimonial)
            <div class="flex gap-3 flex-col p-6 bg-white/50 dark:bg-gray-700/50 border border-white dark:border-gray-600 backdrop-blur-sm dark:shadow-gray-950 shadow-2xl rounded-lg transform hover:scale-105 transition duration-300">
                
                <div class="flex gap-1" role="img" aria-label="5 out of 5 stars">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">"{{ $testimonial->quote() }}"</p>
                <span class="font-bold mb-2 text-gray-800 dark:text-white text-left">{{ $testimonial->name() }}</span>
            </div>
        @endforeach
    </div>
@endif