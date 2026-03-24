<footer class="bg-gray-900 text-gray-300 mt-20" aria-label="{{ __('Site footer') }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand -->
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 rtl:space-x-reverse mb-6">
                    <div class="w-12 h-12 rounded-xl overflow-hidden">
                        <img src="{{ $settings->get('profile_image', '/assets/profile_image.jpg') }}"
                             alt="{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}</h3>
                        <p class="text-gray-400 text-sm">{{ $settings->get('profile_title', 'Senior Backend Developer') }}</p>
                    </div>
                </div>
                <p class="text-gray-400 mb-6 max-w-md">
                    {{ $settings->get('site_tagline', __('Building scalable, secure, and high-performance backend solutions with Laravel, PHP, and modern technologies.')) }}
                </p>
                <div class="flex space-x-4 rtl:space-x-reverse">
                    <a href="{{ $settings->get('social_github', 'https://github.com') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-indigo-600 hover:text-white transition focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('GitHub') }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="{{ $settings->get('social_linkedin', 'https://linkedin.com') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-indigo-600 hover:text-white transition focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('LinkedIn') }}">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <a href="{{ $settings->get('social_twitter', 'https://twitter.com') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-indigo-600 hover:text-white transition focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="X ({{ __('Twitter') }})">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="mailto:{{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-indigo-600 hover:text-white transition focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('Email') }}">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <nav aria-label="{{ __('Footer navigation') }}">
                <h4 class="text-white font-semibold mb-6">{{ __('Quick Links') }}</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition flex items-center focus:outline-none focus:text-indigo-400"><svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>{{ __('Home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-indigo-400 transition flex items-center focus:outline-none focus:text-indigo-400"><svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>{{ __('About') }}</a></li>
                    <li><a href="{{ route('projects.index') }}" class="hover:text-indigo-400 transition flex items-center focus:outline-none focus:text-indigo-400"><svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>{{ __('Projects') }}</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-indigo-400 transition flex items-center focus:outline-none focus:text-indigo-400"><svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>{{ __('Services') }}</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-indigo-400 transition flex items-center focus:outline-none focus:text-indigo-400"><svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>{{ __('Blog') }}</a></li>
                </ul>
            </nav>

            <!-- Contact -->
            <div>
                <h4 class="text-white font-semibold mb-6">{{ __('Contact') }}</h4>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-indigo-400 me-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}" class="hover:text-indigo-400 transition">{{ $settings->get('contact_email', 'dev.abdo.shrief@gmail.com') }}</a>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-indigo-400 me-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ $settings->get('contact_phone', '+201555440882') }}" class="hover:text-indigo-400 transition">{{ $settings->get('contact_phone', '+201555440882') }}</a>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-indigo-400 me-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $settings->get('contact_address', 'Cairo, Egypt') }}</span>
                    </li>
                </ul>
                <a href="{{ route('quote') }}" class="inline-flex items-center mt-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-5 py-2.5 rounded-xl hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    {{ __('Get in Touch') }}
                </a>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $settings->get('profile_name', 'Abdelrahman Shrief') }}. {{ __('All rights reserved.') }}</p>
            <p class="text-gray-500 text-sm mt-2 md:mt-0">{{ __('Built with') }} <span class="text-red-500">❤</span> {{ __('using Laravel & Tailwind') }}</p>
        </div>
    </div>
</footer>
