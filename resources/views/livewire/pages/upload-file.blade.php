@section('top-bar')
    <x-top-bar>
        <li class="breadcrumb-item">
            <i class="las la-folder la-lg"></i> File Manager
        </li>
        <li class="breadcrumb-item">
            Upload File
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
                <div>
                    <label for="type" class="form-label">1st Level Type</label>
                    <div class="w-full join">
                        <div>
                            <div>
                                <input class="bg-slate-200 input input-bordered join-item" placeholder="Search"
                                    wire:model.lazy="search_type" />
                            </div>
                        </div>
                        <select class="w-full join-item" wire:model='type_id'>
                            <option value="">{{ !$types ? 'N/A' : '' }}</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                        @error('search_type3')
                            <label for="tags" class="form-label text-error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="type" class="form-label">2nd Level Type</label>
                    <div class="w-full join">
                        <div>
                            <div>
                                <input class="bg-slate-200 input input-bordered join-item" placeholder="Search"
                                    wire:model.lazy="search_type2" />
                            </div>
                        </div>
                        <select class="w-full join-item" wire:model='type_secondary_id'
                            placeholder="{{ !$types2 ? 'N/A' : '' }}">
                            <option value="">{{ !$types2 ? 'N/A' : '' }}</option>
                            @foreach ($types2 as $type)
                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('search_type2')
                        <label for="tags" class="form-label text-error">{{ $message }}</label>
                    @enderror
                </div>
                <div>
                    <label for="type" class="form-label">3rd Level Type</label>
                    <div class="w-full join">
                        <div>
                            <div>
                                <input class="bg-slate-200 input input-bordered join-item" placeholder="Search"
                                    wire:model.lazy="search_type3" />
                            </div>
                        </div>
                        <select class="w-full join-item" wire:model='type_tertiary_id'
                            placeholder="{{ !$types3 ? 'N/A' : '' }}">
                            <option value="">{{ !$types3 ? 'N/A' : '' }}</option>
                            @foreach ($types3 as $type)
                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('search_type3')
                        <label for="tags" class="form-label text-error">{{ $message }}</label>
                    @enderror
                </div>
                <div>
                    <label for="type" class="form-label">4th Level Type</label>
                    <div class="w-full join">
                        <div>
                            <div>
                                <input class="bg-slate-200 input input-bordered join-item" placeholder="Search"
                                    wire:model.lazy="search_type4" />
                            </div>
                        </div>
                        <select class="w-full join-item" wire:model='type_tertiary_sub_id'
                            placeholder="{{ !$types4 ? 'N/A' : '' }}">
                            <option value="">{{ !$types4 ? 'N/A' : '' }}</option>
                            @foreach ($types4 as $type)
                                <option value="{{ $type->id }}">{{ $type->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('search_type4')
                        <label for="tags" class="form-label text-error">{{ $message }}</label>
                    @enderror
                </div>
                {{-- <div wire:ignore.self>
                    <label for="type" class="form-label">1st Level Type</label>
                    <select class="w-full" id="type" wire:model='type_id'>
                        <option></option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore.self>
                    <label for="type2" class="form-label">2nd Level Type</label>
                    <select class="w-full" id="type" wire:model='type_secondary_id'>
                        <option></option>
                        @foreach ($types2 as $type)
                            <option value="{{ $type->id }}">{{ $type->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore.self>
                    <label for="type3" class="form-label">3rd Level Type</label>
                    <select class="w-full" id="type" wire:model='type_tertiary_id'>
                        <option></option>
                        @foreach ($types3 as $type)
                            <option value="{{ $type->id }}">{{ $type->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore.self>
                    <label for="type4" class="form-label">4th Level Type</label>
                    <select class="w-full" id="type" wire:model='type_tertiary_sub_id'>
                        <option></option>
                        @foreach ($types4 as $type)
                            <option value="{{ $type->id }}">{{ $type->description }}</option>
                        @endforeach
                    </select>
                </div> --}}
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
