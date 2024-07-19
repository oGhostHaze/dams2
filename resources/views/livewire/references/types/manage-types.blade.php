<div class="w-full">
    <h2 class="mt-10 text-lg font-medium intro-y">
        <div class="text-sm breadcrumbs">
            <ul>
                <li class="breadcrumb-item">
                    <i class="las la-database la-lg"></i> Reference Tables
                </li>
                <li>
                    Types
                </li>
            </ul>
        </div>
    </h2>
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
    <div class="flex flex-col justify-center space-y-2">
        <div class="flex justify-end mb-3">
            <button class="btn btn-sm btn-primary" onclick="add_type()">Add Type</button>
        </div>
        @forelse ($types as $type)
            <div class="bg-white collapse box">
                <input type="radio" name="my-accordion-1" id="{{ $type->code }}"
                    @if ($loop->iteration == 1) checked @endif />

                <label class="text-xl font-medium collapse-title" for="{{ $type->code }}">
                    <span>[{{ $type->code }}]</span>
                    <span class="ml-3">{{ $type->description }}</span>
                    <button class="text-sm text-success btn btn-sm"
                        onclick="add_type2({{ $type->id }}, '{{ $type->code }}')"><i
                            class="las la-plus"></i></button>
                    <button class="text-sm text-warning btn btn-sm"
                        onclick="update_type('{{ $type->id }}', '{{ $type->description }}')"><i
                            class="las la-edit"></i></button>
                </label>
                <div class="collapse-content">
                    <div class="flex flex-col pl-3 ml-8 space-y-3">
                        @foreach ($type->secondaries as $type2)
                            <div class="flex space-x-3" wire:key='{{ $type2->code }}'>
                                <span class="ml-3">
                                    <span class="font-bold">{{ $type2->code }}</span>
                                    <span class="ml-3">{{ $type2->description }}</span>
                                    <button class="text-sm text-success btn btn-sm"
                                        onclick="add_type3({{ $type2->id }}, '{{ $type2->code }}')"><i
                                            class="las la-plus"></i></button>
                                    <button class="text-sm text-warning btn btn-sm"
                                        onclick="update_type2('{{ $type2->id }}', '{{ $type2->description }}')"><i
                                            class="las la-edit"></i></button>
                                </span>
                            </div>
                            <div class="flex flex-col pl-3 ml-8 space-y-3 border-l border-l-slate-400">
                                @foreach ($type2->tertiaries as $type3)
                                    <div class="flex space-x-3" wire:key='{{ $type3->code }}'>
                                        <span class="ml-3">
                                            <span class="font-semibold">{{ $type3->code }}</span>
                                            <span class="ml-3">{{ $type3->description }}</span>
                                            <button class="text-sm text-success btn btn-sm"
                                                onclick="add_type4({{ $type3->id }}, '{{ $type3->code }}')"><i
                                                    class="las la-plus"></i></button>
                                            <button class="text-sm text-warning btn btn-sm"
                                                onclick="update_type3('{{ $type3->id }}', '{{ $type3->description }}')"><i
                                                    class="las la-edit"></i></button>
                                        </span>
                                    </div>
                                    <div class="flex flex-col pl-3 ml-8 space-y-3 border-l border-l-slate-400">
                                        @foreach ($type3->tertiary_subs as $sub)
                                            <div class="flex space-x-3" wire:key='{{ $sub->code }}'>
                                                <span class="ml-3">
                                                    <span class="font-semibold">{{ $sub->code }}</span>
                                                    <span class="ml-3">{{ $sub->description }}</span>
                                                    <button class="text-sm text-warning btn btn-sm"
                                                        onclick="update_type4('{{ $sub->id }}', '{{ $sub->description }}')"><i
                                                            class="las la-edit"></i></button>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div>
                <td colspan="2">No record found!</td>
            </div>
        @endforelse
    </div>
</div>

@push('scripts')
    <script>
        function add_type() {
            Swal.fire({
                html: `
                    <span class="text-xl font-bold"> Add Type </span>
                    <div class="w-full px-2 form-control">
                        <label class="label">
                            <span class="label-text">Code</span>
                        </label>
                        <input id="code" type="text" class="w-full" />
                    </div>
                    <div class="w-full px-2 form-control">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input id="description" type="text" class="w-full" />
                    </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const code = Swal.getHtmlContainer().querySelector('#code');
                    const description = Swal.getHtmlContainer().querySelector('#description');
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_code', code.value);
                    @this.set('type_desc', description.value);
                    Livewire.emit('save_type');
                }
            });
        }

        function add_type2(type_id, code) {
            Swal.fire({
                html: `
                    <span class="text-xl font-bold"> Add Second Level Type </span>
                    <div class="w-full px-2 form-control">
                        <label class="label">
                            <span class="label-text">Code</span>
                        </label>
                        <div class="join">
                            <div class="indicator">
                                <button class="btn join-item">` + code + `</button>
                            </div>
                            <div>
                                <div>
                                    <input id="code2" type="text" class="w-full bg-white input input-bordered join-item" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 form-control">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input id="description2" type="text" class="w-full bg-white input input-bordered" />
                    </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const code2 = Swal.getHtmlContainer().querySelector('#code2');
                    const description2 = Swal.getHtmlContainer().querySelector('#description2');
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_code', code2.value);
                    @this.set('type_desc', description2.value);
                    Livewire.emit('save_type2', type_id, code);
                }
            });
        }

        function add_type3(type_id, code) {
            Swal.fire({
                html: `
                <span class="text-xl font-bold"> Add Third Level Type </span>
                <div class="w-full px-2 form-control">
                    <label class="label">
                        <span class="label-text">Code</span>
                    </label>
                    <div class="join">
                        <div class="indicator">
                            <button class="btn join-item">` + code + `</button>
                        </div>
                        <div>
                            <div>
                                <input id="code3" type="text" class="w-full bg-white input input-bordered join-item" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-2 form-control">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <input id="description3" type="text" class="w-full bg-white input input-bordered" />
                </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const code3 = Swal.getHtmlContainer().querySelector('#code3');
                    const description3 = Swal.getHtmlContainer().querySelector('#description3');
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_code', code3.value);
                    @this.set('type_desc', description3.value);
                    Livewire.emit('save_type3', type_id, code);
                }
            });
        }

        function add_type4(type_id, code) {
            Swal.fire({
                html: `
                <span class="text-xl font-bold"> Add Fourth Level Type </span>
                <div class="w-full px-2 form-control">
                    <label class="label">
                        <span class="label-text">Code</span>
                    </label>
                    <div class="join">
                        <div class="indicator">
                            <button class="btn join-item">` + code + `</button>
                        </div>
                        <div>
                            <div>
                                <input id="code4" type="text" class="w-full bg-white input input-bordered join-item" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-2 form-control">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <input id="description4" type="text" class="w-full bg-white input input-bordered" />
                </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const code4 = Swal.getHtmlContainer().querySelector('#code4');
                    const description4 = Swal.getHtmlContainer().querySelector('#description4');
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_code', code4.value);
                    @this.set('type_desc', description4.value);
                    Livewire.emit('save_type4', type_id, code);
                }
            });
        }

        function update_type(type_id, type_name) {
            Swal.fire({
                html: `
                    <span class="text-xl font-bold"> Update Type </span>
                    <div class="w-full px-2 mb-3 form-control">
                        <label class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <input id="update_description" type="text" class="w-full bg-white input input-bordered" />
                    </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const update_description = Swal.getHtmlContainer().querySelector('#update_description');
                    update_description.value = type_name;
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_desc', update_description.value);
                    Livewire.emit('update', [type_id]);
                }
            });
        }

        function update_type2(type_id, type_name) {
            Swal.fire({
                html: `
                <span class="text-xl font-bold"> Update Type </span>
                <div class="w-full px-2 mb-3 form-control">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <input id="update_description2" type="text" class="w-full bg-white input input-bordered" />
                </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const update_description2 = Swal.getHtmlContainer().querySelector('#update_description2');
                    update_description2.value = type_name;
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_desc', update_description2.value);
                    Livewire.emit('update2', [type_id]);
                }
            });
        }

        function update_type3(type_id, type_name) {
            Swal.fire({
                html: `
                <span class="text-xl font-bold"> Update Type </span>
                <div class="w-full px-2 mb-3 form-control">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <input id="update_description3" type="text" class="w-full bg-white input input-bordered" />
                </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const update_description3 = Swal.getHtmlContainer().querySelector('#update_description3');
                    update_description3.value = type_name;
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_desc', update_description3.value);
                    Livewire.emit('update3', [type_id]);
                }
            });
        }

        function update_type4(type_id, type_name) {
            Swal.fire({
                html: `
                <span class="text-xl font-bold"> Update Type </span>
                <div class="w-full px-2 mb-3 form-control">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <input id="update_description4" type="text" class="w-full bg-white input input-bordered" />
                </div>`,
                showCancelButton: true,
                confirmButtonText: `Save`,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                didOpen: () => {
                    const update_description4 = Swal.getHtmlContainer().querySelector('#update_description4');
                    update_description4.value = type_name;
                }
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    @this.set('type_desc', update_description4.value);
                    Livewire.emit('update4', [type_id]);
                }
            });
        }
    </script>
@endpush
