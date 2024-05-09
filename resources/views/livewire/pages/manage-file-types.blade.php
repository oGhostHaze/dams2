@section('top-bar')
    <x-top-bar>
        <li class="breadcrumb-item">
            <i class="las la-folder la-lg"></i> File Manager
        </li>
        <li class="breadcrumb-item">
            Types
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
            <div class="col-span-12">
                <h2 class="mt-2 mr-auto text-lg font-medium intro-y">
                    File Manager
                </h2>
            </div>
            <div class="col-span-12">
                <!-- BEGIN: File Manager Filter -->
                <div class="flex flex-col-reverse items-center intro-y sm:flex-row">
                    <div class="relative w-full mt-3 mr-auto sm:w-auto sm:mt-0">
                        <i class="absolute inset-y-0 left-0 z-10 w-4 h-4 my-auto ml-3 text-slate-500"
                            data-feather="search"></i>
                        <input type="text" class="w-full px-10 form-control sm:w-64 box" placeholder="Search files">
                        <div class="absolute inset-y-0 right-0 flex items-center mr-3 inbox-filter dropdown"
                            data-tw-placement="bottom-start">
                            <i class="w-4 h-4 cursor-pointer dropdown-toggle text-slate-500" role="button"
                                aria-expanded="false" data-tw-toggle="dropdown" data-feather="chevron-down"></i>
                            <div class="pt-2 inbox-filter__dropdown-menu dropdown-menu">
                                <form action="{{ route('file.search') }}" method="GET" class="dropdown-content">
                                    <div class="grid grid-cols-12 gap-4 p-3 gap-y-3">
                                        <div class="col-span-6">
                                            <label for="input-filter-1" class="text-xs form-label">Title/Subject</label>
                                            <input id="input-filter-1" type="text" class="flex-1 form-control"
                                                name="title">
                                        </div>
                                        <div class="col-span-6">
                                            <label for="input-filter-2" class="text-xs form-label">Tags</label>
                                            <select class="w-full tom-select" id="input-filter-2" name="archive_tags[]"
                                                multiple>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->description }}">
                                                        {{ $tag->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-span-6">
                                            <label for="input-filter-3" class="text-xs form-label">Created
                                                At</label>
                                            <input id="input-filter-3" type="text" class="flex-1 form-control"
                                                placeholder="Important Meeting">
                                        </div>
                                        <div class="col-span-6">
                                            <label for="input-filter-4" class="text-xs form-label">Size</label>
                                            <select id="input-filter-4" class="flex-1 form-select" name="per_page">
                                                <option value="10" selected>10</option>
                                                <option value="25">25</option>
                                                <option value="35">35</option>
                                                <option value="50">50</option>
                                            </select>
                                        </div>
                                        <div class="flex items-center col-span-12 mt-3">
                                            <button class="w-32 ml-auto btn btn-secondary">Create
                                                Filter</button>
                                            <button class="w-32 ml-2 btn btn-primary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                <!-- BEGIN: Directory & Files -->
                <div class="grid grid-cols-12 gap-3 mt-5 intro-y sm:gap-6">
                    @foreach ($types as $type)
                        <div
                            class="w-48 h-48 col-span-6 sm:w-56 sm:h-56 intro-y sm:col-span-4 md:col-span-3 2xl:col-span-2">
                            <div
                                class="relative w-48 h-48 px-3 pt-8 pb-5 rounded-md sm:w-56 sm:h-56 file box sm:px-5 zoom-in">
                                <a href="{{ route('type.second.manager', ['type_id' => $type->id]) }}"
                                    class="w-3/5 mx-auto file__icon file__icon--directory">
                                    <div class="uppercase file__icon__file-name">{{ $type->code }}</div>
                                </a>
                                <a href="{{ route('type.second.manager', ['type_id' => $type->id]) }}"
                                    class="block mt-4 font-medium text-center">{{ $type->description }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- END: Directory & Files -->
                {{-- <div>
                    <button id="prev">Previous</button>
                    <button id="next">Next</button>
                    &nbsp; &nbsp;
                    <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                </div> --}}
                {{-- <canvas id="the-canvas"></canvas> --}}
            </div>
        </div>
    </div>
    <!-- END: Content -->

</div>

{{-- @push('scripts')
    <script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>
    <script type="module">
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '{{ asset('storage/documents/annual.pdf') }}';

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var {
            pdfjsLib
        } = globalThis;

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

        // Asynchronous download of PDF
        var loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(function(pdf) {
            console.log('PDF loaded');

            // Fetch the first page
            var pageNumber = 1;
            pdf.getPage(pageNumber).then(function(page) {
                console.log('Page loaded');

                var scale = 1.5;
                var viewport = page.getViewport({
                    scale: scale
                });

                // Prepare canvas using PDF page dimensions
                var canvas = document.getElementById('the-canvas');
                var context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    console.log('Page rendered');
                });
            });
        }, function(reason) {
            // PDF loading error
            console.error(reason);
        });
    </script>
@endpush --}}
