<!-- BEGIN: Main Color Switcher-->
<div class="fixed bottom-0 right-0 z-50 flex items-center justify-center h-12 px-5 mb-10 border rounded-full shadow-md box mr-52">
    <div class="hidden mr-4 sm:block text-slate-600 dark:text-slate-200">Color Scheme</div>
    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'default']) }}" class="block w-8 h-8 cursor-pointer bg-blue-800 rounded-full border-4 mr-1 hover:border-slate-200 {{ Auth::user()->color_scheme =='default' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-1']) }}" class="block w-8 h-8 cursor-pointer bg-emerald-900 rounded-full border-4 mr-1 hover:border-slate-200 {{ Auth::user()->color_scheme =='theme-1' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-2']) }}" class="block w-8 h-8 cursor-pointer bg-blue-900 rounded-full border-4 mr-1 hover:border-slate-200 {{ Auth::user()->color_scheme =='theme-2' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-3']) }}" class="block w-8 h-8 cursor-pointer bg-cyan-900 rounded-full border-4 mr-1 hover:border-slate-200 {{ Auth::user()->color_scheme =='theme-3' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-4']) }}" class="block w-8 h-8 cursor-pointer bg-indigo-900 rounded-full border-4 hover:border-slate-200 {{ Auth::user()->color_scheme =='theme-4' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
</div>
<!-- END: Main Color Switcher-->
