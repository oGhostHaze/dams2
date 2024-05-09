@push('header')
    {{ $header = 'Guest' }}
@endpush

<x-guest-layout>
    <div class="container sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
            <!-- BEGIN: Login Info -->
            <div class="flex-col hidden min-h-screen xl:flex">
                <a href="" class="flex items-center pt-5 -intro-x">
                    <img alt="{{ $header }}" class="w-6" src="{{ url('dist/images/logo.svg') }}">
                    <span class="ml-3 text-lg text-white"> {{ config('app.name', 'Laravel') }} </span>
                </a>
                <div class="my-auto">
                    <div class="mt-10 text-4xl font-medium leading-tight text-white -intro-x">
                        A few more clicks to
                        <br>
                        sign in to your account.
                    </div>
                    <div class="mt-5 text-lg text-white -intro-x text-opacity-70 dark:text-slate-400">Manage all your
                        accounts in one place</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            {{ $slot }}
            <!-- END: Login Form -->
        </div>
    </div>
</x-guest-layout>
