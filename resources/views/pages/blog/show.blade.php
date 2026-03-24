<x-layouts.app title="{{ $post->title }} - {{ $settings->get('profile_name', 'Abdelrahman Shrief') }}">
    <!-- Highlight.js for code syntax highlighting -->
    @push('styles')
    <!-- JetBrains Mono: only loaded on blog post pages -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css"></noscript>
    <style>
        /* Code Block Styling */
        article pre {
            position: relative;
            margin: 1.5rem 0;
            padding: 0;
            border-radius: 0.75rem;
            overflow: hidden;
            background: #282c34;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        article pre code {
            display: block;
            padding: 1.25rem 1.5rem;
            overflow-x: auto;
            font-family: 'JetBrains Mono', 'Fira Code', 'Monaco', 'Consolas', monospace;
            font-size: 0.875rem;
            line-height: 1.7;
            tab-size: 4;
        }

        /* Code block header with language badge */
        article pre::before {
            content: attr(data-language);
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.25rem 0.75rem;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #abb2bf;
            background: rgba(255, 255, 255, 0.05);
            border-bottom-left-radius: 0.5rem;
        }

        /* Copy button */
        .code-copy-btn {
            position: absolute;
            top: 0.5rem;
            right: 4rem;
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #abb2bf;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
            cursor: pointer;
            opacity: 0;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        article pre:hover .code-copy-btn {
            opacity: 1;
        }

        .code-copy-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .code-copy-btn.copied {
            color: #98c379;
            border-color: #98c379;
        }

        /* Line numbers */
        .line-numbers {
            counter-reset: line;
        }

        .line-numbers code {
            padding-left: 3.5rem !important;
        }

        .line-numbers code::before {
            content: counter(line);
            counter-increment: line;
            position: absolute;
            left: 0;
            width: 2.5rem;
            padding-right: 0.75rem;
            text-align: right;
            color: #636d83;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            user-select: none;
        }

        /* Inline code */
        article :not(pre) > code {
            background: linear-gradient(135deg, #667eea15, #764ba215);
            color: #6366f1;
            padding: 0.2rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875em;
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .dark article :not(pre) > code {
            background: linear-gradient(135deg, #667eea25, #764ba225);
            color: #a5b4fc;
            border-color: rgba(165, 180, 252, 0.2);
        }

        /* Terminal/bash styling */
        pre[data-language="bash"] code,
        pre[data-language="shell"] code,
        pre[data-language="terminal"] code {
            color: #98c379;
        }

        pre[data-language="bash"]::before,
        pre[data-language="shell"]::before,
        pre[data-language="terminal"]::before {
            content: "Terminal";
        }

        /* Scrollbar styling for code blocks */
        article pre code::-webkit-scrollbar {
            height: 8px;
        }

        article pre code::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }

        article pre code::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        article pre code::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Table of contents styling */
        .toc-link {
            transition: all 0.2s ease;
        }

        .toc-link:hover {
            color: #6366f1;
            transform: translateX(4px);
        }

        /* Reading progress bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            z-index: 9999;
            transition: width 0.1s ease;
        }
    </style>
    @endpush

    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="reading-progress" role="progressbar" aria-label="{{ __('Reading progress') }}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>

    <!-- Hero Section -->
    <section class="relative min-h-[50vh] flex items-center bg-gradient-to-br from-gray-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0" aria-hidden="true">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>
        <div class="absolute inset-0 bg-grid opacity-10" aria-hidden="true"></div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center text-indigo-300 hover:text-white mb-8 transition group">
                <svg class="w-5 h-5 me-2 rtl:rotate-180 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ __('Back to Blog') }}
            </a>

            @if($post->category)
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-indigo-500/20 text-indigo-300 text-sm font-medium mb-4">
                    {{ $post->category->name }}
                </span>
            @endif

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">{{ $post->title }}</h1>

            <div class="flex flex-wrap items-center gap-6 text-gray-400">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full overflow-hidden me-3 ring-2 ring-indigo-500/50">
                        <img src="{{ $settings->get('profile_image', '/assets/profile_image.jpg') }}"
                             alt="{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-white font-medium block">{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}</span>
                        <span class="text-sm">{{ $post->published_at?->format('F d, Y') }}</span>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span id="reading-time">5 min read</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($post->getFirstMediaUrl('featured_image'))
                <div class="rounded-2xl overflow-hidden shadow-2xl mb-12 -mt-32 relative z-10">
                    <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" class="w-full" loading="eager" fetchpriority="high">
                </div>
            @endif

            <article id="article-content" class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-bold prose-headings:tracking-tight prose-a:text-indigo-600 dark:prose-a:text-indigo-400 prose-img:rounded-xl prose-h2:border-b prose-h2:border-gray-200 dark:prose-h2:border-gray-700 prose-h2:pb-3 prose-h2:mt-12 prose-h3:mt-8 prose-p:leading-relaxed prose-li:leading-relaxed">
                {!! $post->content !!}
            </article>

            <!-- Tags / Share -->
            <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                <div class="flex flex-wrap items-center justify-between gap-6">
                    <!-- Author -->
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-xl overflow-hidden me-4 ring-2 ring-indigo-500/30">
                            <img src="{{ $settings->get('profile_image', '/assets/profile_image.jpg') }}"
                                 alt="{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}"
                                 class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="text-gray-900 dark:text-white font-bold block">{{ $settings->get('profile_name', 'Abdelrahman Shrief') }}</span>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $settings->get('profile_title', __('Senior Backend Developer')) }}</span>
                        </div>
                    </div>

                    <!-- Share -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">{{ __('Share this post') }}</h3>
                        <div class="flex space-x-3 rtl:space-x-reverse">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-900 hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('Share on X (Twitter)') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-blue-600 hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('Share on LinkedIn') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-green-500 hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('Share on WhatsApp') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </a>
                            <button onclick="copyToClipboard('{{ request()->url() }}', this)" class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-indigo-500 hover:text-white transition-all group focus:outline-none focus:ring-2 focus:ring-indigo-500" aria-label="{{ __('Copy link to clipboard') }}">
                                <svg class="w-5 h-5 group-[.copied]:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                <svg class="w-5 h-5 hidden group-[.copied]:block text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts->count())
        <section class="py-20 bg-gray-50 dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-sm mb-4">
                        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        {{ __('Keep Reading') }}
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('Related Posts') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <article class="group bg-white dark:bg-gray-900 rounded-2xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700 card-hover">
                            @if($relatedPost->getFirstMediaUrl('featured_image'))
                                <div class="overflow-hidden">
                                    <img src="{{ $relatedPost->getFirstMediaUrl('featured_image') }}" alt="{{ $relatedPost->title }}" class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" width="400" height="176">
                                </div>
                            @else
                                <div class="w-full h-44 bg-gradient-to-br from-indigo-500 to-purple-600"></div>
                            @endif
                            <div class="p-6">
                                @if($relatedPost->category)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-xs font-medium mb-2">
                                        {{ $relatedPost->category->name }}
                                    </span>
                                @endif
                                <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-2 mb-2">
                                    <a href="{{ route('blog.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                </h3>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $relatedPost->published_at?->format('M d, Y') }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl p-12 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full filter blur-3xl"></div>
                <div class="relative">
                    <h2 class="text-3xl font-bold mb-4">{{ __('Need Help With Your Project?') }}</h2>
                    <p class="text-indigo-100 mb-8 max-w-xl mx-auto">
                        {{ __('Let\'s discuss how I can help bring your ideas to life with expert backend development.') }}
                    </p>
                    <a href="{{ route('quote') }}" class="inline-flex items-center bg-white text-indigo-600 px-8 py-4 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                        <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        {{ __('Get in Touch') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <!-- Highlight.js (deferred to avoid render blocking) -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/bash.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/javascript.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/sql.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/json.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Highlight.js
            document.querySelectorAll('article pre code').forEach((block) => {
                hljs.highlightElement(block);

                // Detect language and add to parent pre
                const language = block.className.match(/language-(\w+)/)?.[1] ||
                                 block.result?.language ||
                                 'code';
                block.parentElement.setAttribute('data-language', language);

                // Add copy button
                const copyBtn = document.createElement('button');
                copyBtn.className = 'code-copy-btn';
                copyBtn.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <span>Copy</span>
                `;
                copyBtn.onclick = function() {
                    navigator.clipboard.writeText(block.textContent).then(() => {
                        copyBtn.classList.add('copied');
                        copyBtn.innerHTML = `
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Copied!</span>
                        `;
                        setTimeout(() => {
                            copyBtn.classList.remove('copied');
                            copyBtn.innerHTML = `
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                <span>Copy</span>
                            `;
                        }, 2000);
                    });
                };
                block.parentElement.style.position = 'relative';
                block.parentElement.appendChild(copyBtn);
            });

            // Calculate reading time
            const article = document.getElementById('article-content');
            if (article) {
                const text = article.textContent || article.innerText;
                const wordCount = text.trim().split(/\s+/).length;
                const readingTime = Math.ceil(wordCount / 200);
                document.getElementById('reading-time').textContent = `${readingTime} min read`;
            }

            // Reading progress bar
            const progressBar = document.getElementById('reading-progress');
            const articleContent = document.getElementById('article-content');

            if (progressBar && articleContent) {
                window.addEventListener('scroll', function() {
                    const articleRect = articleContent.getBoundingClientRect();
                    const articleTop = articleRect.top + window.scrollY;
                    const articleHeight = articleRect.height;
                    const windowHeight = window.innerHeight;
                    const scrollY = window.scrollY;

                    // Calculate progress based on article position
                    const start = articleTop - windowHeight;
                    const end = articleTop + articleHeight;
                    const current = scrollY - start;
                    const total = end - start;

                    let progress = (current / total) * 100;
                    progress = Math.max(0, Math.min(100, progress));

                    progressBar.style.width = progress + '%';
                });
            }
        });

        // Copy to clipboard function for share button
        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                button.classList.add('copied');
                setTimeout(() => {
                    button.classList.remove('copied');
                }, 2000);
            });
        }
    </script>
    @endpush
</x-layouts.app>
