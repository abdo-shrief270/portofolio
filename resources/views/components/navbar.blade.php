<nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg shadow-sm sticky top-0 z-50 border-b border-gray-100 dark:border-gray-800" aria-label="{{ __('Main navigation') }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 rtl:space-x-reverse" aria-label="{{ __('Home') }} - {{ $settings->get('profile_name', 'Abdelrahman Shrief') }}">
                    <div class="w-10 h-10 rounded-xl overflow-hidden">
                        <img src="{{ $settings->get('profile_image', '/assets/profile_image.jpg') }}"
                             alt=""
                             class="w-full h-full object-cover">
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">{{ explode(' ', $settings->get('profile_name', 'Abdelrahman Shrief'))[0] }}</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-1 rtl:space-x-reverse" role="list">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ request()->routeIs('home') ? 'bg-gray-100 dark:bg-gray-800 text-indigo-600' : '' }}" {{ request()->routeIs('home') ? 'aria-current=page' : '' }}>
                    {{ __('Home') }}
                </a>
                <a href="{{ route('about') }}" class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ request()->routeIs('about') ? 'bg-gray-100 dark:bg-gray-800 text-indigo-600' : '' }}" {{ request()->routeIs('about') ? 'aria-current=page' : '' }}>
                    {{ __('About') }}
                </a>
                <a href="{{ route('projects.index') }}" class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ request()->routeIs('projects.*') ? 'bg-gray-100 dark:bg-gray-800 text-indigo-600' : '' }}" {{ request()->routeIs('projects.*') ? 'aria-current=page' : '' }}>
                    {{ __('Projects') }}
                </a>
                <a href="{{ route('services') }}" class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ request()->routeIs('services') ? 'bg-gray-100 dark:bg-gray-800 text-indigo-600' : '' }}" {{ request()->routeIs('services') ? 'aria-current=page' : '' }}>
                    {{ __('Services') }}
                </a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ request()->routeIs('blog.*') ? 'bg-gray-100 dark:bg-gray-800 text-indigo-600' : '' }}" {{ request()->routeIs('blog.*') ? 'aria-current=page' : '' }}>
                    {{ __('Blog') }}
                </a>
                <a href="{{ route('quote') }}" class="ms-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-5 py-2 rounded-xl hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Hire Me') }}
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" onclick="toggleMobileMenu()" class="text-gray-700 dark:text-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-expanded="false" aria-controls="mobile-menu" aria-label="{{ __('Toggle navigation menu') }}">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t dark:border-gray-800" role="navigation" aria-label="{{ __('Mobile navigation') }}">
        <div class="px-4 py-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" {{ request()->routeIs('home') ? 'aria-current=page' : '' }}>{{ __('Home') }}</a>
            <a href="{{ route('about') }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" {{ request()->routeIs('about') ? 'aria-current=page' : '' }}>{{ __('About') }}</a>
            <a href="{{ route('projects.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" {{ request()->routeIs('projects.*') ? 'aria-current=page' : '' }}>{{ __('Projects') }}</a>
            <a href="{{ route('services') }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" {{ request()->routeIs('services') ? 'aria-current=page' : '' }}>{{ __('Services') }}</a>
            <a href="{{ route('blog.index') }}" class="block px-4 py-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" {{ request()->routeIs('blog.*') ? 'aria-current=page' : '' }}>{{ __('Blog') }}</a>
            <a href="{{ route('quote') }}" class="block bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-2 rounded-xl text-center mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ __('Hire Me') }}</a>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const button = document.querySelector('[aria-controls="mobile-menu"]');
        const isHidden = menu.classList.toggle('hidden');
        button.setAttribute('aria-expanded', !isHidden);
    }
</script>
