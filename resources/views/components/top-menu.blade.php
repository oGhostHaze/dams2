<!-- BEGIN: Top Menu -->
<nav class="top-nav">
    <ul>
        <x-jet-nav-link href="{{ route('top.dashboard') }}" :active="request()->routeIs('top.dashboard')">
            <div class="top-menu__icon"> <i data-feather="home"></i> </div>
            <div class="top-menu__title"> Dashboard </div>
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('type.manager') }}" :active="request()->routeIs('type.*')">
            <div class="top-menu__icon"> <i data-feather="folder"></i> </div>
            <div class="top-menu__title"> File Manager </div>
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('file.search') }}" :active="request()->routeIs('file.*')">
            <div class="top-menu__icon"> <i data-feather="search"></i> </div>
            <div class="top-menu__title"> File Search </div>
        </x-jet-nav-link>
        <li>
            <a href="javascript:;" class="top-menu">
                <div class="top-menu__icon"> <i data-feather="hard-drive"></i> </div>
                <div class="top-menu__title"> References <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('ref.types') }}" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="top-menu__title"> Type </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="top-menu">
                <div class="top-menu__icon"> <i data-feather="file-text"></i> </div>
                <div class="top-menu__title"> Reports <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('reports.archives') }}" class="top-menu">
                        <div class="top-menu__icon"> <i data-feather="list"></i> </div>
                        <div class="top-menu__title"> Archives </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- END: Top Menu -->
