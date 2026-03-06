<x-layouts.app title="{{ $settings->get('site_name', 'Abdelrahman Shrief - Senior Backend Developer') }}">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Glowing Orbs -->
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-25 animate-blob" style="animation-delay: 4s;"></div>
            <div class="absolute top-20 left-1/4 w-64 h-64 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="animation-delay: 3s;"></div>
            <div class="absolute bottom-20 right-1/4 w-72 h-72 bg-violet-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="animation-delay: 5s;"></div>

            <!-- Animated Grid Pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(99, 102, 241, 0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(99, 102, 241, 0.3) 1px, transparent 1px); background-size: 50px 50px;"></div>

            <!-- Floating Particles -->
            <div class="absolute top-1/4 left-1/6 w-2 h-2 bg-indigo-400 rounded-full animate-ping opacity-60" style="animation-duration: 3s;"></div>
            <div class="absolute top-1/3 right-1/5 w-2 h-2 bg-purple-400 rounded-full animate-ping opacity-60" style="animation-duration: 4s; animation-delay: 1s;"></div>
            <div class="absolute bottom-1/3 left-1/4 w-2 h-2 bg-pink-400 rounded-full animate-ping opacity-60" style="animation-duration: 3.5s; animation-delay: 2s;"></div>
            <div class="absolute top-2/3 right-1/3 w-1.5 h-1.5 bg-cyan-400 rounded-full animate-ping opacity-50" style="animation-duration: 4.5s; animation-delay: 0.5s;"></div>
            <div class="absolute bottom-1/4 right-1/6 w-1.5 h-1.5 bg-violet-400 rounded-full animate-ping opacity-50" style="animation-duration: 3.8s; animation-delay: 1.5s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-start">
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-indigo-300 text-sm mb-6">
                        <span class="w-2 h-2 bg-green-400 rounded-full me-2 animate-pulse"></span>
                        {{ $settings->get('availability_status', __('Available for new projects')) }}
                    </div>

                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                        {{ __("Hi, I'm") }}<br>
                        <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}</span>
                    </h1>

                    <p class="text-xl md:text-2xl text-gray-300 mb-8">
                        <span class="text-indigo-400 font-semibold">{{ $settings->get('profile_title', 'Senior Backend Developer') }}</span><br>
                        {{ $settings->get('site_tagline', __('Crafting scalable solutions with Laravel, PHP & modern technologies')) }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-semibold hover:shadow-2xl hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            {{ __('View Projects') }}
                        </a>
                        <a href="{{ route('quote') }}" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-xl font-semibold hover:bg-white/20 transition-all duration-300">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            {{ __('Hire Me') }}
                        </a>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-12 flex flex-wrap gap-6 justify-center lg:justify-start text-gray-400">
                        <a href="mailto:{{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}" class="flex items-center hover:text-indigo-400 transition">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}
                        </a>
                        <a href="tel:{{ $settings->get('contact_phone', '+201555440882') }}" class="flex items-center hover:text-indigo-400 transition">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $settings->get('contact_phone', '+20 155 544 0882') }}
                        </a>
                    </div>
                </div>

                <!-- Profile Image -->
                <div class="hidden lg:flex justify-center">
                    <div class="relative">
                        <!-- Outer Glow Rings -->
                        <div class="absolute inset-0 w-80 h-80 -m-6">
                            <div class="absolute inset-0 border-2 border-indigo-500/20 rounded-full animate-ping" style="animation-duration: 3s;"></div>
                            <div class="absolute inset-4 border border-purple-500/30 rounded-full animate-ping" style="animation-duration: 4s; animation-delay: 1s;"></div>
                        </div>

                        <!-- Profile Photo with gradient border -->
                        <div class="relative w-80 h-80">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full animate-spin-slow"></div>
                            <div class="absolute inset-1 bg-gray-900 rounded-full"></div>
                            <img src="{{ $settings->get('profile_image', '/assets/profile_image.jpg') }}" alt="{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}" class="absolute inset-2 w-[calc(100%-16px)] h-[calc(100%-16px)] object-cover rounded-full">

                            <!-- Inner Glow Effect -->
                            <div class="absolute inset-2 rounded-full bg-gradient-to-tr from-indigo-500/20 via-transparent to-pink-500/20"></div>
                        </div>

                        <!-- Floating badges - Dynamic from TechStack (Random positions) -->
                        @php
                            // Generate random positions around the profile image circle
                            $count = min($techStacks->count(), 8);
                            $positions = [];
                            $usedAngles = [];

                            for ($i = 0; $i < $count; $i++) {
                                // Distribute angles evenly with some randomness
                                $baseAngle = ($i / $count) * 360;
                                $randomOffset = rand(-20, 20);
                                $angle = deg2rad($baseAngle + $randomOffset);

                                // Random distance from center (170-220px from center of 320px image)
                                $distance = rand(170, 220);

                                // Calculate x, y from center
                                $x = cos($angle) * $distance;
                                $y = sin($angle) * $distance;

                                // Convert to percentage offset from center (160px is half of 320px)
                                $left = 160 + $x - 24; // 24 is half badge size
                                $top = 160 + $y - 24;

                                $positions[] = [
                                    'left' => $left,
                                    'top' => $top,
                                    'delay' => $i * 0.4 + (rand(0, 10) / 10),
                                ];
                            }
                        @endphp

                        @foreach($techStacks->take(8) as $index => $tech)
                            @php $pos = $positions[$index] ?? ['left' => 0, 'top' => 0, 'delay' => 0]; @endphp
                            <div class="absolute bg-white dark:bg-gray-800 rounded-xl p-3 animate-float hover:scale-110 transition-transform cursor-pointer z-10"
                                 style="left: {{ $pos['left'] }}px; top: {{ $pos['top'] }}px; animation-delay: {{ $pos['delay'] }}s; box-shadow: 0 8px 30px {{ $tech->color ?? '#6366f1' }}40;"
                                 title="{{ $tech->name }}">
                                @if($tech->icon && str_starts_with($tech->icon, 'heroicon'))
                                    <x-dynamic-component :component="$tech->icon" class="w-7 h-7" style="color: {{ $tech->color ?? '#6366f1' }};" />
                                @elseif($tech->icon)
                                    <div class="w-7 h-7 flex items-center justify-center" style="color: {{ $tech->color ?? '#6366f1' }};">{!! $tech->icon !!}</div>
                                @else
                                    <div class="w-7 h-7 flex items-center justify-center rounded text-white text-xs font-bold" style="background: {{ $tech->color ?? '#6366f1' }};">
                                        {{ strtoupper(substr($tech->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Scroll indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white/50 animate-bounce">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white dark:bg-gray-800 -mt-20 relative z-10 mx-4 lg:mx-20 rounded-2xl shadow-xl">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-2">{{ $settings->get('about_experience_years', '7+') }}</div>
                    <div class="text-gray-600 dark:text-gray-400">{{ __('Years Experience') }}</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-2">{{ $settings->get('about_projects_completed', '50+') }}</div>
                    <div class="text-gray-600 dark:text-gray-400">{{ __('Projects Completed') }}</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-2">{{ $settings->get('about_clients_served', '30+') }}</div>
                    <div class="text-gray-600 dark:text-gray-400">{{ __('Happy Clients') }}</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-2">100%</div>
                    <div class="text-gray-600 dark:text-gray-400">{{ __('Client Satisfaction') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    @if($featuredProjects->count())
        <section class="py-24 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">{{ __('Portfolio') }}</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
                        {{ __('Featured Projects') }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">
                        {{ __('A selection of my recent work showcasing various technologies and solutions.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredProjects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-semibold hover:bg-gray-800 dark:hover:bg-gray-100 transition">
                        {{ __('View All Projects') }}
                        <svg class="w-5 h-5 ms-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Services -->
    @if($services->count())
        <section class="py-24 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">{{ __('What I Do') }}</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
                        {{ __('My Services') }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto text-lg">
                        {{ __('Comprehensive solutions for your digital needs.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-8 card-hover border border-gray-100 dark:border-gray-700">
                            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ $service->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $service->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonials -->
    @if($testimonials->count())
        <section class="py-24 bg-gradient-to-br from-indigo-900 via-purple-900 to-indigo-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <span class="text-indigo-300 font-semibold text-sm uppercase tracking-wider">{{ __('Testimonials') }}</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-white mt-2 mb-4">
                        {{ __('What Clients Say') }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                            <div class="flex mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-white/90 italic mb-6">"{{ $testimonial->content }}"</p>
                            <div class="flex items-center">
                                @if($testimonial->getFirstMediaUrl('avatar'))
                                    <img src="{{ $testimonial->getFirstMediaUrl('avatar') }}" alt="{{ $testimonial->client_name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-400 flex items-center justify-center text-white font-bold">
                                        {{ substr($testimonial->client_name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="ms-4">
                                    <div class="text-white font-semibold">{{ $testimonial->client_name }}</div>
                                    <div class="text-indigo-300 text-sm">{{ $testimonial->client_position }} @ {{ $testimonial->client_company }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA -->
    <section class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                {{ __('Ready to Start Your Project?') }}
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg mb-10 max-w-2xl mx-auto">
                {{ __("Let's collaborate and build something amazing together. I'm just a message away.") }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('quote') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl font-semibold hover:shadow-2xl hover:shadow-indigo-500/30 transition-all duration-300">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    {{ __('Get in Touch') }}
                </a>
                <a href="mailto:{{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:border-indigo-500 hover:text-indigo-500 transition-all duration-300">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
