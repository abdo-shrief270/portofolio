<div class="relative">
    <div class="flex items-center space-x-2 rtl:space-x-reverse">
        <button wire:click="switchLanguage('en')" class="px-2 py-1 rounded text-sm {{ $currentLocale === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} hover:bg-blue-500 hover:text-white transition">
            EN
        </button>
        <button wire:click="switchLanguage('ar')" class="px-2 py-1 rounded text-sm {{ $currentLocale === 'ar' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} hover:bg-blue-500 hover:text-white transition">
            AR
        </button>
    </div>
</div>
