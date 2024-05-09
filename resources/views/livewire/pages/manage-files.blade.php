@section('top-bar')
    <x-top-bar>
        <li class="breadcrumb-item">
            <i class="las la-folder la-lg"></i> File Manager
        </li>
    </x-top-bar>
@endsection

<div class="p-3">
    @if ($errors->first())
        <div class="px-8 mx-auto mb-2 max-w-7xl">
            <div class="shadow-lg alert alert-error">
                <div>
                    <button wire:click="$emit('refresh')"><svg xmlns="http://www.w3.org/2000/svg"
                            class="flex-shrink-0 w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg></button>
                    <i class="mr-2 las la-lg la-exclamation-triangle"></i> {{ $errors->first() }}
                </div>
            </div>
        </div>
    @endif
    <!-- BEGIN: Content -->
    <div class="content">
        <div class="grid grid-cols-12 gap-6 mt-8">
            <div class="col-span-12 lg:col-span-3 2xl:col-span-2">
                <h2 class="mt-2 mr-auto text-lg font-medium intro-y">
                    File Manager
                </h2>

                <form action="{{ route('file.search') }}" method="GET">
                    <div class="grid grid-cols-12 gap-4 p-3 gap-y-3">
                        <div class="col-span-12 border-b border-b-slate-400">
                            <span class="mb-2 mr-auto text-base font-medium intro-y">
                                Search
                            </span>
                        </div>
                        <div class="col-span-12">
                            <label for="input-filter-1" class="text-xs form-label">Title/Subject</label>
                            <input id="input-filter-1" type="text" class="flex-1 form-control" name="title">
                        </div>
                        <div class="col-span-12">
                            <label for="input-filter-2" class="text-xs form-label">Tags</label>
                            <select class="w-full tom-select" id="input-filter-2" name="archive_tags[]" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->description }}">{{ $tag->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12">
                            <label for="input-filter-3" class="text-xs form-label">From Date</label>
                            <input id="input-filter-3" type="date" class="flex-1 form-control" name="from_date">
                        </div>
                        <div class="col-span-12">
                            <label for="input-filter-3" class="text-xs form-label">To Date</label>
                            <input id="input-filter-3" type="date" class="flex-1 form-control" name="to_date">
                        </div>
                        <div class="col-span-12">
                            <label for="input-filter-4" class="text-xs form-label">Page Size</label>
                            <select id="input-filter-4" class="flex-1 form-select" name="per_page">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="35">35</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="flex items-center col-span-12 mt-3">
                            <button class="w-32 ml-auto btn btn-secondary">Create Filter</button>
                            <button class="w-32 ml-2 btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-span-12 lg:col-span-9 2xl:col-span-10">
                <!-- BEGIN: File Manager Filter -->
                <div class="flex flex-col-reverse items-center justify-end intro-y sm:flex-row">
                    <div class="flex w-full sm:w-auto">
                        <a class="mr-2 shadow-md btn btn-primary" href="{{ route('file.upload') }}">
                            Upload New File
                        </a>
                        <div class="dropdown">
                            <button class="px-2 dropdown-toggle btn box" aria-expanded="false"
                                data-tw-toggle="dropdown">
                                <span class="flex items-center justify-center w-5 h-5"> <i class="w-4 h-4"
                                        data-feather="plus"></i> </span>
                            </button>
                            <div class="w-40 dropdown-menu">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-feather="file"
                                                class="w-4 h-4 mr-2"></i> Share Files </a>
                                    </li>
                                    <li>
                                        <a href="" class="dropdown-item"> <i data-feather="settings"
                                                class="w-4 h-4 mr-2"></i> Settings </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: File Manager Filter -->
                <div class="col-span-12">
                    <h2 class="mt-2 mr-auto text-base font-thin intro-y">
                        Search Results: {{ count($archives) }} Found
                    </h2>
                    <!-- BEGIN: Directory & Files -->
                    <div class="grid grid-cols-12 gap-3 pt-5 border-t intro-y sm:gap-6 border-t-slate-300">
                        @foreach ($archives as $archive)
                            <div
                                class="w-48 h-48 col-span-6 sm:w-56 sm:h-56 intro-y sm:col-span-4 md:col-span-3 2xl:col-span-2">
                                <div
                                    class="relative w-48 h-48 px-3 pt-8 pb-5 rounded-md sm:w-56 sm:h-56 file box sm:px-5 zoom-in">
                                    <a href="{{ route('file.view', ['archive_id' => $archive->id]) }}"
                                        class="w-3/5 mx-auto file__icon file__icon--file">
                                        <div class="uppercase file__icon__file-name">{{ $archive->file_ext }}</div>
                                    </a>
                                    <a href="{{ route('file.view', ['archive_id' => $archive->id]) }}"
                                        class="block mt-4 font-medium text-center">{{ $archive->title }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- END: Directory & Files -->
                </div>
                <!-- BEGIN: Pagination -->
                <div class="flex flex-wrap items-center mt-6 intro-y sm:flex-row sm:flex-nowrap">
                    <nav class="w-full sm:w-auto sm:mr-auto">
                        {{ $archives->links() }}
                    </nav>
                </div>
                <!-- END: Pagination -->
            </div>
        </div>
    </div>
    <!-- END: Content -->

</div>
