<x-layouts.app title="{{ $settings->get('site_name', 'Abdelrahman Shrief - Senior Backend Developer') }}">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob" style="animation-delay: 4s;"></div>
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
                        <!-- Profile Photo with gradient border -->
                        <div class="relative w-80 h-80">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full animate-pulse"></div>
                            <div class="absolute inset-1 bg-gray-900 rounded-full"></div>
                            <img src="{{ $settings->get('profile_image', '/assets/profile_image.jpg') }}" alt="{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}" class="absolute inset-2 w-[calc(100%-16px)] h-[calc(100%-16px)] object-cover rounded-full">
                        </div>

                        <!-- Floating badges -->
                        <div class="absolute -top-4 -right-4 bg-white rounded-xl shadow-xl p-3 animate-float" style="animation-delay: 1s;">
                            <svg class="w-8 h-8 text-red-500" viewBox="0 0 256 264"><path fill="#FF2D20" d="M255.856 59.62c.095.351.144.713.144 1.077v56.568c0 1.478-.79 2.843-2.073 3.578L206.45 148.18v54.18a4.135 4.135 0 0 1-2.062 3.579l-99.108 57.053c-.227.128-.474.21-.722.299c-.093.03-.18.087-.278.113a4.15 4.15 0 0 1-2.114 0c-.114-.03-.217-.093-.325-.134c-.227-.083-.464-.155-.68-.278L2.073 205.939A4.128 4.128 0 0 1 0 202.361V32.471c0-.372.052-.744.144-1.098c.025-.108.087-.206.124-.309c.072-.206.134-.412.237-.6c.062-.113.155-.206.237-.308c.103-.155.196-.31.329-.443c.093-.093.217-.155.33-.237c.124-.093.237-.196.371-.268L51.893.415a4.13 4.13 0 0 1 4.125 0l49.362 28.392c.134.072.247.175.37.268c.114.082.238.144.331.237c.133.134.226.288.33.443c.08.102.174.195.236.308c.103.196.165.402.237.6c.041.103.103.2.124.309c.093.351.144.713.144 1.077v105.51l41.27-23.766V60.697c0-.36.052-.727.144-1.076c.026-.108.088-.207.124-.31c.072-.205.135-.41.237-.6c.062-.113.156-.205.237-.307c.103-.155.196-.31.33-.443c.092-.093.216-.155.33-.237c.123-.093.236-.196.37-.268l49.362-28.392a4.13 4.13 0 0 1 4.125 0l49.361 28.392c.134.072.247.175.371.268c.113.082.237.144.33.237c.133.134.226.288.329.443c.082.102.175.195.237.307c.103.196.165.402.237.6c.041.103.103.201.124.31Z"/></svg>
                        </div>
                        <div class="absolute -bottom-4 -left-4 bg-white rounded-xl shadow-xl p-3 animate-float" style="animation-delay: 2s;">
                            <svg class="w-8 h-8 text-blue-600" viewBox="0 0 256 256"><path fill="#777BB4" d="M128 0C57.308 0 0 28.654 0 64s57.308 64 128 64s128-28.654 128-64S198.692 0 128 0Zm0 112c-52.934 0-96-21.49-96-48s43.066-48 96-48s96 21.49 96 48s-43.066 48-96 48Z"/></svg>
                        </div>
                        <div class="absolute top-1/2 -right-8 bg-white rounded-xl shadow-xl p-3 animate-float" style="animation-delay: 3s;">
                            <svg class="w-8 h-8 text-green-600" viewBox="0 0 256 256"><path fill="#68A063" d="M128 0C57.31 0 0 57.31 0 128s57.31 128 128 128s128-57.31 128-128S198.69 0 128 0Zm0 234.67c-58.88 0-106.67-47.79-106.67-106.67S69.12 21.33 128 21.33S234.67 69.12 234.67 128S186.88 234.67 128 234.67Z"/></svg>
                        </div>
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
