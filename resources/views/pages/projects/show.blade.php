<x-layouts.app title="{{ $project->title }} - Abdelrahman Shrief">
    <!-- Hero Section -->
    <section class="relative min-h-[50vh] flex items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0" aria-hidden="true">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>
        <div class="absolute inset-0 bg-grid opacity-10" aria-hidden="true"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center text-indigo-300 hover:text-white mb-8 transition group">
                <svg class="w-5 h-5 me-2 rtl:rotate-180 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('Back to Projects') }}
            </a>

            <div class="max-w-4xl">
                @if($project->is_featured)
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-300 text-sm mb-4">
                        <svg class="w-4 h-4 me-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        {{ __('Featured Project') }}
                    </div>
                @endif

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">{{ $project->title }}</h1>

                @if($project->description)
                    <p class="text-xl text-gray-300 mb-8">{{ $project->description }}</p>
                @endif

                @if($project->techStacks->count())
                    <div class="flex flex-wrap gap-2 mb-8">
                        @foreach($project->techStacks as $tech)
                            <span class="px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm" @if($tech->color) style="background-color: {{ $tech->color }}30; border-color: {{ $tech->color }}50" @endif>
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-wrap gap-4">
                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50" aria-label="{{ __('View Live') }} - {{ $project->title }}">
                            <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            {{ __('View Live') }}
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center bg-white/10 backdrop-blur-sm border border-white/20 text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/20 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-white/50" aria-label="{{ __('View Code') }} - {{ $project->title }}">
                            <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            {{ __('View Code') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Project Content -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Featured Image -->
                    @if($project->getFirstMediaUrl('thumbnail'))
                        <div class="rounded-2xl overflow-hidden shadow-2xl">
                            <img src="{{ $project->getFirstMediaUrl('thumbnail') }}" alt="{{ $project->title }}" class="w-full">
                        </div>
                    @endif

                    <!-- Content -->
                    @if($project->content)
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-8 md:p-10">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 me-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ __('Project Overview') }}
                            </h2>
                            <div class="prose prose-lg dark:prose-invert max-w-none">
                                {!! $project->content !!}
                            </div>
                        </div>
                    @endif

                    <!-- Gallery -->
                    @if($project->getMedia('gallery')->count())
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 me-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ __('Gallery') }}
                            </h2>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($project->getMedia('gallery') as $image)
                                    <div class="rounded-xl overflow-hidden shadow-lg card-hover cursor-pointer">
                                        <img src="{{ $image->getUrl() }}" alt="{{ $project->title }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Features -->
                    @if($project->features->count())
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-6 h-6 me-3 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                {{ __('Key Features') }}
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($project->features as $feature)
                                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-100 dark:border-gray-700 card-hover">
                                        <div class="flex items-start">
                                            <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div class="ms-4">
                                                <h4 class="font-bold text-gray-900 dark:text-white mb-1">{{ $feature->title }}</h4>
                                                @if($feature->description)
                                                    <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $feature->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Project Details Card -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                                <svg class="w-5 h-5 me-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Project Details') }}
                            </h3>

                            <div class="space-y-4">
                                @if($project->client_name)
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg flex items-center justify-center me-4">
                                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400 block">{{ __('Client') }}</span>
                                            <span class="text-gray-900 dark:text-white font-medium">{{ $project->client_name }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if($project->start_date || $project->end_date)
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center me-4">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-500 dark:text-gray-400 block">{{ __('Duration') }}</span>
                                            <span class="text-gray-900 dark:text-white font-medium">
                                                {{ $project->start_date?->format('M Y') }} - {{ $project->end_date?->format('M Y') ?? __('Present') }}
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                @if($project->techStacks->count())
                                    <div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 block mb-3">{{ __('Technologies') }}</span>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($project->techStacks as $tech)
                                                <span class="text-sm px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium" @if($tech->color) style="background-color: {{ $tech->color }}15; color: {{ $tech->color }}" @endif>
                                                    {{ $tech->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-8 space-y-3">
                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 px-4 rounded-xl hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        {{ __('View Live') }}
                                    </a>
                                @endif

                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center bg-gray-900 dark:bg-gray-700 text-white py-3 px-4 rounded-xl hover:bg-gray-800 transition-all duration-300 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                        {{ __('View Code') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Contact CTA -->
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white">
                            <h4 class="font-bold mb-2">{{ __('Like what you see?') }}</h4>
                            <p class="text-indigo-100 text-sm mb-4">{{ __('Let\'s discuss your project') }}</p>
                            <a href="{{ route('quote') }}" class="inline-flex items-center bg-white text-indigo-600 px-4 py-2 rounded-lg text-sm font-medium hover:shadow-lg transition">
                                <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                {{ __('Get in Touch') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Projects -->
    @if($relatedProjects->count())
        <section class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-sm mb-4">
                        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        {{ __('More Work') }}
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('Related Projects') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedProjects as $relatedProject)
                        <x-project-card :project="$relatedProject" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
