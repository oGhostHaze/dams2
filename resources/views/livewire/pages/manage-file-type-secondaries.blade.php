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
                <!-- BEGIN: Directory & Files -->
                <div class="grid grid-cols-12 gap-3 mt-5 intro-y sm:gap-6">
                    <div
                        class="w-48 h-48 col-span-6 sm:w-56 sm:h-56 intro-y sm:col-span-4 md:col-span-3 2xl:col-span-2">
                        <div
                            class="relative w-48 h-48 px-3 pt-8 pb-5 rounded-md sm:w-56 sm:h-56 file box sm:px-5 zoom-in">
                            <a href="javascript:history.back()"
                                class="w-3/5 mx-auto file__icon file__icon--empty-directory">
                                <div class="uppercase file__icon__file-name"><i class="las la-undo la-lg"></i></div>
                            </a>
                            <a href="javascript:history.back()" class="block mt-4 font-medium text-center">RETURN</a>
                        </div>
                    </div>
                    @foreach ($types as $type)
                        <div
                            class="w-48 h-48 col-span-6 sm:w-56 sm:h-56 intro-y sm:col-span-4 md:col-span-3 2xl:col-span-2">
                            <div
                                class="relative w-48 h-48 px-3 pt-8 pb-5 rounded-md sm:w-56 sm:h-56 file box sm:px-5 zoom-in">
                                <a href="{{ route('type.third.manager', ['type_id' => $type->id]) }}"
                                    class="w-3/5 mx-auto file__icon file__icon--directory">
                                    <div class="uppercase file__icon__file-name">{{ $type->code }}</div>
                                </a>
                                <a href="{{ route('type.third.manager', ['type_id' => $type->id]) }}"
                                    class="block mt-4 font-medium text-center">{{ $type->description }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- END: Directory & Files -->
            </div>
            <div class="col-span-12">
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
        </div>
    </div>
    <!-- END: Content -->

</div>
