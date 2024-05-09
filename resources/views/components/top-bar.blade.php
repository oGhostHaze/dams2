<!-- BEGIN: Top Bar -->
<div class="border-b border-white/[0.08] -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
    <div class="flex items-center top-bar-boxed">
        <!-- BEGIN: Logo -->
        <a href="{{ route('top.dashboard') }}" class="hidden align-middle -intro-x md:flex">
            <img alt="Gledco" class="w-auto h-6" src="{{ url('dist/images/logo.svg') }}">
            <span class="ml-3 text-lg text-white"> Document Archive Management System </span>
        </a>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="h-full mr-auto -intro-x">
            <ol class="breadcrumb breadcrumb-light">
                {{ $slot }}
            </ol>
        </nav>
        <!-- END: Breadcrumb -->
        <!-- BEGIN: Notifications -->
        <div class="mr-4 intro-x dropdown sm:mr-6">
            <div class="cursor-pointer notification notification--light" role="button" id="time"> Time</div>
        </div>
        <!-- END: Notifications -->
        <!-- BEGIN: Account Menu -->
        <div class="w-8 h-8 intro-x dropdown">
            <div class="w-8 h-8 overflow-hidden scale-110 rounded-full shadow-lg dropdown-toggle image-fit zoom-in"
                role="button" aria-expanded="false" data-tw-toggle="dropdown">
                <img alt="Gledco" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            </div>
            <div class="w-56 dropdown-menu">
                <ul
                    class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500"> {{ Auth::user()->email }} </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="{{ route('profile.show') }}" class="dropdown-item hover:bg-white/5"> <i
                                data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                    </li>
                    {{-- <li>
                        <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                    </li> --}}
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5"
                                @click.prevent="$root.submit();">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
</div>
<!-- END: Top Bar -->
