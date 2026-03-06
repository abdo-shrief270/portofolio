<div>
    <!-- Filters -->
    <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <!-- Search -->
            <div class="flex-1">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search projects...') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Clear Filters -->
            @if($search || count($selectedTechStacks))
                <button wire:click="clearFilters" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 flex items-center">
                    <svg class="w-4 h-4 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    {{ __('Clear filters') }}
                </button>
            @endif
        </div>

        <!-- Tech Stack Filters -->
        @if($techStacks->count())
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach($techStacks as $tech)
                    <button wire:click="toggleTechStack({{ $tech->id }})" class="px-3 py-1 rounded-full text-sm transition {{ in_array($tech->id, $selectedTechStacks) ? 'bg-blue-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}" @if($tech->color && in_array($tech->id, $selectedTechStacks)) style="background-color: {{ $tech->color }}" @endif>
                        {{ $tech->name }}
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
            <x-project-card :project="$project" />
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('No projects found') }}</h3>
                <p class="text-gray-500 dark:text-gray-400">{{ __('Try adjusting your search or filter criteria.') }}</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($projects->hasPages())
        <div class="mt-8">
            {{ $projects->links() }}
        </div>
    @endif
</div>
