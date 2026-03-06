<div>
    @if($submitted)
        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-8 rounded-xl text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold mb-2">{{ __('Thank you for your inquiry!') }}</h3>
            <p>{{ __('We will get back to you within 24-48 hours.') }}</p>
            <button wire:click="$set('submitted', false)" class="mt-4 text-green-600 hover:text-green-800 underline">
                {{ __('Submit another request') }}
            </button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" wire:model="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Email') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" wire:model="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Phone') }}
                    </label>
                    <input type="tel" id="phone" wire:model="phone" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Company') }}
                    </label>
                    <input type="text" id="company" wire:model="company" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('company') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="project_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Project Type') }}
                    </label>
                    <select id="project_type" wire:model="project_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">{{ __('Select a type') }}</option>
                        <option value="website">{{ __('Website') }}</option>
                        <option value="web_app">{{ __('Web Application') }}</option>
                        <option value="mobile_app">{{ __('Mobile Application') }}</option>
                        <option value="e_commerce">{{ __('E-Commerce') }}</option>
                        <option value="api">{{ __('API Development') }}</option>
                        <option value="consulting">{{ __('Consulting') }}</option>
                        <option value="other">{{ __('Other') }}</option>
                    </select>
                    @error('project_type') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="budget_range" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Budget Range') }}
                    </label>
                    <select id="budget_range" wire:model="budget_range" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">{{ __('Select a range') }}</option>
                        <option value="under_1k">{{ __('Under $1,000') }}</option>
                        <option value="1k_5k">{{ __('$1,000 - $5,000') }}</option>
                        <option value="5k_10k">{{ __('$5,000 - $10,000') }}</option>
                        <option value="10k_25k">{{ __('$10,000 - $25,000') }}</option>
                        <option value="25k_plus">{{ __('$25,000+') }}</option>
                        <option value="not_sure">{{ __('Not Sure') }}</option>
                    </select>
                    @error('budget_range') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Project Details') }} <span class="text-red-500">*</span>
                </label>
                <textarea id="message" wire:model="message" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="{{ __('Tell us about your project...') }}"></textarea>
                @error('message') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center">
                <span wire:loading.remove>{{ __('Send Request') }}</span>
                <span wire:loading>
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </form>
    @endif
</div>
