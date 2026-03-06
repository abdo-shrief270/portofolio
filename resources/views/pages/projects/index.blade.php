<x-layouts.app title="{{ __('Projects') }} - Abdelrahman Shrief">
    <!-- Hero Section -->
    <section class="relative min-h-[50vh] flex items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute top-40 right-40 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
        </div>
        <div class="absolute inset-0 bg-grid opacity-10"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-indigo-300 text-sm mb-6">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                {{ __('My Work') }}
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {{ __('Featured') }} <span class="gradient-text">{{ __('Projects') }}</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-8">
                {{ __('Explore my portfolio of web applications, backend systems, and digital solutions built with modern technologies.') }}
            </p>

            <!-- Quick Stats -->
            <div class="flex flex-wrap justify-center gap-8 mt-10">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">50+</div>
                    <div class="text-indigo-300 text-sm">{{ __('Projects') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">30+</div>
                    <div class="text-indigo-300 text-sm">{{ __('Clients') }}</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">5+</div>
                    <div class="text-indigo-300 text-sm">{{ __('Years') }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid with Filter -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:project-filter />
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-12 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full filter blur-3xl"></div>
                <div class="relative">
                    <h2 class="text-3xl font-bold mb-4">{{ __('Have a Project in Mind?') }}</h2>
                    <p class="text-indigo-100 mb-8 max-w-xl mx-auto">
                        {{ __('Let\'s discuss how I can help bring your ideas to life with modern, scalable solutions.') }}
                    </p>
                    <a href="{{ route('quote') }}" class="inline-flex items-center bg-white text-indigo-600 px-8 py-4 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        {{ __('Start a Conversation') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
