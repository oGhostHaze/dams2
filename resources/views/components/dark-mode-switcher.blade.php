<div data-url="{{ route('dark-mode-switcher') }}" class="fixed bottom-0 right-0 z-50 flex items-center justify-center w-40 h-12 mb-10 mr-10 border rounded-full shadow-md cursor-pointer dark-mode-switcher box">
    <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
    <div class="border dark-mode-switcher__toggle {{ Auth::user()->dark_mode ? 'dark-mode-switcher__toggle--active' : '' }}"></div>
</div>
