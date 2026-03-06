@props(['project'])

<div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 card-hover">
    <div class="relative overflow-hidden">
        @if($project->getFirstMediaUrl('thumbnail'))
            <img src="{{ $project->getFirstMediaUrl('thumbnail') }}" alt="{{ $project->title }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-52 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                <span class="text-5xl text-white/50 font-bold">{{ substr($project->title, 0, 1) }}</span>
            </div>
        @endif

        <!-- Overlay on hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
            <div class="p-6 w-full">
                <div class="flex gap-3">
                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" class="flex-1 bg-white text-gray-900 py-2 px-4 rounded-lg text-sm font-medium text-center hover:bg-indigo-500 hover:text-white transition">
                            {{ __('Live Demo') }}
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="flex-1 bg-gray-800 text-white py-2 px-4 rounded-lg text-sm font-medium text-center hover:bg-gray-700 transition">
                            {{ __('Code') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($project->is_featured)
            <span class="absolute top-4 right-4 rtl:right-auto rtl:left-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs px-3 py-1.5 rounded-full font-medium shadow-lg flex items-center">
                <svg class="w-3 h-3 me-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                {{ __('Featured') }}
            </span>
        @endif
    </div>

    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-2">
            <a href="{{ route('projects.show', $project->slug) }}">{{ $project->title }}</a>
        </h3>

        @if($project->description)
            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                {{ $project->description }}
            </p>
        @endif

        @if($project->techStacks->count())
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($project->techStacks->take(4) as $tech)
                    <span class="text-xs px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium" @if($tech->color) style="background-color: {{ $tech->color }}15; color: {{ $tech->color }}" @endif>
                        {{ $tech->name }}
                    </span>
                @endforeach
                @if($project->techStacks->count() > 4)
                    <span class="text-xs px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-medium">
                        +{{ $project->techStacks->count() - 4 }}
                    </span>
                @endif
            </div>
        @endif

        <a href="{{ route('projects.show', $project->slug) }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium text-sm group/link">
            {{ __('View Details') }}
            <svg class="w-4 h-4 ms-1 rtl:rotate-180 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div>
