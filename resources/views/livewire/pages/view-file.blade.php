@section('top-bar')
    <x-top-bar>
        <li class="breadcrumb-item">
            <i class="las la-folder la-lg"></i> File Manager
        </li>
        <li class="breadcrumb-item">
            <i class="las la-eye la-lg"></i> Viewer
        </li>
        <li class="breadcrumb-item">{{ $archive->title }}</li>
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
            <div class="col-span-12 p-10 lg:col-span-4 2xl:col-span-3 box">
                <h2 class="mt-2 mb-3 mr-auto text-lg font-bold text-center underline intro-y">
                    {{ $archive->title }}
                </h2>

                <div class="grid grid-cols-12 gap-4 mt-2 gap-y-3">
                    <div class="col-span-12 border-b border-b-slate-400">
                        <span class="mb-2 mr-auto text-base font-medium uppercase intro-y">
                            File Details:
                        </span>
                    </div>
                    <div class="flex flex-col col-span-12 space-y-2">
                        <span class="flex flex-col">
                            <span class="font-semibold">
                                Category
                            </span>
                            <span>
                                <small class="font-semibold">
                                    [{{ $archive->type->code }}]
                                </small>
                                {{ $archive->type->description }}
                            </span>
                        </span>
                        @if ($archive->type_tertiary_sub_id)
                            <span class="flex flex-col">
                                <span class="font-semibold">
                                    Type
                                </span>
                                <span>
                                    {{ $archive->sub->description }}
                                </span>
                            </span>
                            <span class="flex flex-col">
                                <span class="font-semibold">
                                    Code
                                </span>
                                <span>
                                    {{ $archive->sub->code }}
                                </span>
                            </span>
                        @elseif ($archive->type_tertiary_id)
                            <span class="flex flex-col">
                                <span class="font-semibold">
                                    Type
                                </span>
                                <span>
                                    {{ $archive->tertiary->description }}
                                </span>
                            </span>
                            <span class="flex flex-col">
                                <span class="font-semibold">
                                    Code
                                </span>
                                <span>
                                    {{ $archive->tertiary->code }}
                                </span>
                            </span>
                        @elseif ($archive->type_secondary_id)
                            <span class="flex flex-col">
                                <span class="font-semibold">
                                    Type
                                </span>
                                <span>
                                    {{ $archive->secondary->description }}
                                </span>
                            </span>
                            <span class="flex flex-col">
                                <span class="font-semibold">
                                    Code
                                </span>
                                <span>
                                    {{ $archive->secondary->code }}
                                </span>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-2 gap-y-3">
                    <div class="col-span-12 border-b border-b-slate-400">
                        <span class="mb-2 mr-auto text-base font-medium uppercase intro-y">
                            Additional Details:
                        </span>
                    </div>
                    <div class="flex flex-col col-span-12 space-y-2">
                        <span class="flex flex-col">
                            <span class="font-semibold">
                                Tags:
                            </span>
                            <div class="flex flex-wrap">
                                @foreach (explode(',', $archive->tags) as $item)
                                    <span class="mt-1 mr-1 truncate badge badge-xs badge-primary">
                                        #{{ $item }}
                                    </span>
                                @endforeach
                            </div>
                        </span>
                        <span class="flex flex-col">
                            <span class="font-semibold">
                                Size:
                            </span>
                            <span>
                                {{ $size }}
                            </span>
                        </span>
                        <span class="flex flex-col">
                            <span class="font-semibold">
                                Created:
                            </span>
                            <span>
                                {{ date('F j Y H:i A', strtotime($archive->created_at)) }}
                            </span>
                        </span>
                        <span class="flex flex-col">
                            <span class="font-semibold">
                                Modified:
                            </span>
                            <span>
                                {{ $last_modified }}
                            </span>
                        </span>
                        <span class="flex flex-col">
                            <span class="font-semibold">
                                Uploaded by:
                            </span>
                            <span>
                                {{ $archive->user->name }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <div class="col-span 12">
                    <div class="mb-3">
                        <button id="prev" class="!text-black btn btn-outline btn-sm">Previous</button>
                        <button id="next" class="!text-black btn btn-outline btn-sm">Next</button>
                        &nbsp; &nbsp;
                        <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                        <a href="{{ url('/storage/' . $file_name) }}" target="_blank"
                            class="ml-5 !text-black btn btn-outline btn-sm">Full
                            View</a>
                    </div>
                </div>
                <div class="col-span-12">
                    <iframe src="{{ url('/storage/' . $file_name) }}" frameborder="0" width="100%" height="720px"></iframe>
                    <canvas id="viewer" class="block w-2/4"></canvas>
                </div>

            </div>
        </div>
    </div>
    <script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>

    <script type="module">
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        var url = '{{ url('/storage/' . $file_name) }}';

        // Loaded via <script> tag, create shortcut to access PDF.js exports.
        var {
            pdfjsLib
        } = globalThis;

        // The workerSrc property shall be specified.
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 0.8,
            canvas = document.getElementById('viewer'),
            ctx = canvas.getContext('2d');

        /**
         * Get page info from document, resize canvas accordingly, and render page.
         * @param num Page number.
         */
        function renderPage(num) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport({
                    scale: scale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').textContent = num;
        }

        /**
         * If another page rendering in progress, waits until the rendering is
         * finised. Otherwise, executes rendering immediately.
         */
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            queueRenderPage(pageNum);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            queueRenderPage(pageNum);
        }
        document.getElementById('next').addEventListener('click', onNextPage);

        /**
         * Asynchronously downloads PDF.
         */
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);
        });
    </script>
</div>
