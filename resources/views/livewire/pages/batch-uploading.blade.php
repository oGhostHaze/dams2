@section('top-bar')
    <x-top-bar>
        <li class="breadcrumb-item">
            <i class="las la-folder la-lg"></i> File Manager
        </li>
        <li class="breadcrumb-item">
            Upload File
        </li>
        <li class="breadcrumb-item">
            {{ $type->description }}
        </li>
    </x-top-bar>
@endsection

<div class="content">
    <div class="grid grid-cols-12 gap-6 mt-8">
        <div class="col-span-12 lg:col-span-3 2xl:col-span-2">
            <h2 class="mt-2 mr-auto text-lg font-medium">
                Upload File
            </h2>
        </div>

        <div id="horizontal-form" class="col-span-12 p-5">
            <div class="flex flex-col w-3/6 space-y-5 preview">
                <div class="flex items-center w-full" x-data="drop_file_component()">
                <div
                    class="flex flex-col items-center justify-center w-full py-6 border-2 border-dashed rounded"
                    x-bind:class="dropingFile ? 'bg-gray-400 border-gray-500' : 'border-gray-500 bg-gray-200'"
                    x-on:drop="dropingFile = false"
                    x-on:drop.prevent="
                        handleFileDrop($event)
                    "
                    x-on:dragover.prevent="dropingFile = true"
                    x-on:dragleave.prevent="dropingFile = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <div class="text-center" wire:loading.remove wire.target="files">Drop Your Files Here</div>
                    <div class="mt-1" wire:loading.flex wire.target="files">
                        <svg class="w-5 h-5 mr-3 -ml-1 text-gray-700 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <div>Processing Files</div>
                    </div>
                </div>
            </div>
            @error('file')
                <span class="text-error">{{ $message }}</span>
            @enderror
            <div class="flex flex-col w-3/6 space-y-5 preview">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>
                                Recently uploaded
                            </td>
                            <td>
                                Timestamp
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($archives as $archive)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $archive->title }}</td>
                            <td>{{ $archive->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function drop_file_component() {
            return {
                dropingFile: false,
                handleFileDrop(e) {
                    if (event.dataTransfer.files.length > 0) {
                        const files = e.dataTransfer.files[0];
                        @this.upload('file', files,
                            (uploadedFilename) => {}, () => {}, (event) => {}
                        )
                    }
                }
            };
        }
    </script>
</div>
