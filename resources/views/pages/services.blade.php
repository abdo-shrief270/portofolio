<x-layouts.app title="{{ __('Services') }} - Abdelrahman Shrief">
    <!-- Hero Section -->
    <section class="relative min-h-[50vh] flex items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute top-10 right-20 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-10 left-20 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>
        <div class="absolute inset-0 bg-grid opacity-10"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-indigo-300 text-sm mb-6">
                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ __('What I Offer') }}
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {{ __('Professional') }} <span class="gradient-text">{{ __('Services') }}</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                {{ __('Comprehensive backend development solutions tailored to your business needs. From APIs to full-stack applications.') }}
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($services as $service)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <!-- Gradient overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                @if($service->icon)
                                    <x-dynamic-component :component="$service->icon" class="w-8 h-8 text-white" />
                                @else
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $service->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $service->description }}</p>
                        </div>
                    </div>
                @empty
                    <!-- Default Services when no database entries -->
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Backend Development') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('Robust and scalable backend solutions using Laravel, PHP, and modern architectures. RESTful APIs, microservices, and more.') }}</p>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Database Design') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('Efficient database architecture and optimization. MySQL, PostgreSQL, MongoDB, and Redis for high-performance applications.') }}</p>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('API Development') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('RESTful and GraphQL APIs with proper authentication, documentation, and versioning. Integration with third-party services.') }}</p>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Security & Performance') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('Security audits, vulnerability assessments, and performance optimization. Ensuring your application is fast and secure.') }}</p>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('System Integration') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('Connect your systems with payment gateways, CRMs, ERPs, and other third-party services for seamless operations.') }}</p>
                        </div>
                    </div>

                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 card-hover relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Maintenance & Support') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('Ongoing maintenance, bug fixes, and technical support to keep your application running smoothly 24/7.') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-sm mb-4">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    {{ __('My Process') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('How I Work') }}</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ __('A streamlined process to bring your ideas to life efficiently and effectively.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="relative">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700 text-center card-hover">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl font-bold">1</div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-3 text-lg">{{ __('Discovery') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Understanding your requirements, goals, and vision for the project.') }}</p>
                    </div>
                    <!-- Connector -->
                    <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
                </div>

                <div class="relative">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700 text-center card-hover">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl font-bold">2</div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-3 text-lg">{{ __('Planning') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Creating a detailed roadmap, architecture, and technical specifications.') }}</p>
                    </div>
                    <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-purple-500 to-pink-600"></div>
                </div>

                <div class="relative">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700 text-center card-hover">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl font-bold">3</div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-3 text-lg">{{ __('Development') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Building with clean code, best practices, and regular progress updates.') }}</p>
                    </div>
                    <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-gradient-to-r from-blue-500 to-cyan-600"></div>
                </div>

                <div class="relative">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700 text-center card-hover">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl font-bold">4</div>
                        <h3 class="font-bold text-gray-900 dark:text-white mb-3 text-lg">{{ __('Launch & Support') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('Deployment, testing, and ongoing support to ensure success.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-sm mb-4">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    {{ __('Technologies') }}
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Tech Stack I Work With') }}</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <!-- Laravel -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center card-hover">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-10 h-10 text-red-500" viewBox="0 0 50 52" fill="currentColor">
                            <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-21.483L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Laravel</span>
                </div>

                <!-- PHP -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center card-hover">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-10 h-10 text-indigo-600" viewBox="0 0 256 134" fill="currentColor">
                            <ellipse cx="128" cy="66.63" rx="128" ry="66.63" fill="#8892BF"/>
                            <path d="M35.945 106.082l14.028-71.014H82.41c14.027.877 21.041 7.89 21.041 21.041 0 21.04-16.657 33.315-31.561 32.438H56.11l-3.507 17.535H35.945zm23.671-31.561l4.384-21.918h12.274c6.137 0 10.52 2.63 10.52 7.014 0 9.644-7.013 14.027-15.78 14.904H59.616zm53.479 31.561l14.027-71.014h17.535l-3.507 17.535h15.78c14.028.877 19.288 7.89 17.535 16.657l-6.137 36.822H152.67l6.137-33.315c.877-4.383.877-7.013-5.26-7.013H142.15l-9.644 40.328H115.85zm73.643-21.041c0-21.04 14.905-51.602 48.22-51.602 18.412 0 27.18 9.644 27.18 23.67 0 21.042-14.904 51.603-48.22 51.603-18.41 0-27.18-10.52-27.18-23.671zm48.22-36.822c-14.904 0-21.04 21.04-21.04 32.438 0 7.89 3.506 13.15 10.52 13.15 14.904 0 21.04-21.04 21.04-32.438 0-7.89-3.506-13.15-10.52-13.15z" fill="#FFF"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">PHP</span>
                </div>

                <!-- MySQL -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center card-hover">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-10 h-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">MySQL</span>
                </div>

                <!-- Redis -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center card-hover">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-10 h-10 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10.5 2.661l.54.997-1.797.644 2.409.218.748 1.246.467-1.121 2.077-.208-1.61-.613.426-1.017-1.578.519zm6.905 2.077L13.76 6.182l3.292 1.298.353 3.17 1.644-2.536 2.793.042-1.089-2.09 2.018-1.86-2.682.168-1.29-1.637zm-12.092.644l-.477 3.377 2.207.208L8.56 7.121l2.346.124 1.852-1.44-2.56-.283-.644.935-1.54-.26.676-1.017zM3.21 9.25l-.23 2.56 2.017-.166L5.5 10.05l1.727.124-.352-1.23zm8.292 1.456l-1.768.62 1.797.748-.208 1.495 1.246-.935 1.621.352-.768-1.205 1.017-.997-1.768.042-.645-1.23-.62 1.23zm8.15.456l-1.977.352 1.85 1.538-2.017.936 2.56-.042.852 1.89.394-2.432 2.077-.456-2.077-.748.394-1.413zm-11.52 1.977l-.854 4.18 3.377-1.936.727 2.018 2.346-2.911-.854-.665.854-1.017-2.017.23-1.017-1.372-.477 1.726-1.977-.665zm-5.32 2.56L.956 18.33l2.56.123 1.59 2.346.623-2.56 2.664.457-1.537-1.644 1.246-1.852-2.56.457-.62-1.788z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Redis</span>
                </div>

                <!-- Docker -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center card-hover">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.983 11.078h2.119a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.119a.185.185 0 00-.185.185v1.888c0 .102.083.185.185.185m-2.954-5.43h2.118a.186.186 0 00.186-.186V3.574a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.186m0 2.716h2.118a.187.187 0 00.186-.186V6.29a.186.186 0 00-.186-.185h-2.118a.185.185 0 00-.185.185v1.887c0 .102.082.185.185.186m-2.93 0h2.12a.186.186 0 00.184-.186V6.29a.185.185 0 00-.185-.185H8.1a.185.185 0 00-.185.185v1.887c0 .102.083.185.185.186m-2.964 0h2.119a.186.186 0 00.185-.186V6.29a.185.185 0 00-.185-.185H5.136a.186.186 0 00-.186.185v1.887c0 .102.084.185.186.186m5.893 2.715h2.118a.186.186 0 00.186-.185V9.006a.186.186 0 00-.186-.186h-2.118a.185.185 0 00-.185.185v1.888c0 .102.082.185.185.185m-2.93 0h2.12a.185.185 0 00.184-.185V9.006a.185.185 0 00-.184-.186h-2.12a.185.185 0 00-.184.185v1.888c0 .102.083.185.185.185m-2.964 0h2.119a.185.185 0 00.185-.185V9.006a.185.185 0 00-.184-.186h-2.12a.186.186 0 00-.186.186v1.887c0 .102.084.185.186.185m-2.92 0h2.12a.185.185 0 00.184-.185V9.006a.185.185 0 00-.184-.186h-2.12a.185.185 0 00-.184.185v1.888c0 .102.082.185.185.185M23.763 9.89c-.065-.051-.672-.51-1.954-.51-.338.001-.676.03-1.01.087-.248-1.7-1.653-2.53-1.716-2.566l-.344-.199-.226.327c-.284.438-.49.922-.612 1.43-.23.97-.09 1.882.403 2.661-.595.332-1.55.413-1.744.42H.751a.751.751 0 00-.75.748 11.376 11.376 0 00.692 4.062c.545 1.428 1.355 2.48 2.41 3.124 1.18.723 3.1 1.137 5.275 1.137.983.003 1.963-.086 2.93-.266a12.248 12.248 0 003.823-1.389c.98-.567 1.86-1.288 2.61-2.136 1.252-1.418 1.998-2.997 2.553-4.4h.221c1.372 0 2.215-.549 2.68-1.009.309-.293.55-.65.707-1.046l.098-.288z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Docker</span>
                </div>

                <!-- Git -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 text-center card-hover">
                    <div class="w-12 h-12 mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-10 h-10 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.546 10.93L13.067.452c-.604-.603-1.582-.603-2.188 0L8.708 2.627l2.76 2.76c.645-.215 1.379-.07 1.889.441.516.515.658 1.258.438 1.9l2.658 2.66c.645-.223 1.387-.078 1.9.435.721.72.721 1.884 0 2.604-.719.719-1.881.719-2.6 0-.539-.541-.674-1.337-.404-1.996L12.86 8.955v6.525c.176.086.342.203.488.348.713.721.713 1.883 0 2.6-.719.721-1.889.721-2.609 0-.719-.719-.719-1.879 0-2.598.182-.18.387-.316.605-.406V8.835c-.217-.091-.424-.222-.6-.401-.545-.545-.676-1.342-.396-2.009L7.636 3.7.45 10.881c-.6.605-.6 1.584 0 2.189l10.48 10.477c.604.604 1.582.604 2.186 0l10.43-10.43c.605-.603.605-1.582 0-2.187"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Git</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-700 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-10"></div>
        <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/20 rounded-full filter blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ __('Need a Custom Solution?') }}</h2>
            <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
                {{ __('Let\'s discuss how I can help you achieve your goals. Get a free consultation today.') }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('quote') }}" class="inline-flex items-center bg-white text-indigo-600 px-8 py-4 rounded-xl font-semibold hover:shadow-lg hover:shadow-white/30 transition-all duration-300">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ __('Get a Quote') }}
                </a>
                <a href="mailto:dev.abdo.shrief@gmail.com" class="inline-flex items-center bg-white/10 backdrop-blur-sm border border-white/20 text-white px-8 py-4 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Email Me') }}
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
