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
                <div>
                    <label for="horizontal-form-1" class="form-label">Title/Subject</label>
                    <input id="horizontal-form-1" type="text" class="form-control" wire:model="title">
                    @error('title')
                        <label for="tags" class="form-label text-error">{{ $message }}</label>
                    @enderror
                </div>
                <div wire:ignore>
                    <label for="tags" class="form-label">Tags</label>
                    <select class="w-full tom-select" id="tags" wire:model="archive_tags" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->description }}">{{ $tag->description }}</option>
                        @endforeach
                    </select>
                    @error('archive_tags')
                        <label for="tags" class="form-label text-error">{{ $message }}</label>
                    @enderror
                </div>
                <div>
                    <label for="tags" class="form-label">File</label>
                    <input id="file" type="file" class="bg-white form-control" wire:model.live="file" />
                    @error('file')
                        <label for="tags" class="form-label text-error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="mt-5">
                <button class="btn btn-primary" wire:click="save">Upload</button>
            </div>
        </div>
    </div>
</div>
</div>
