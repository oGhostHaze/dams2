@section('top-bar')
    <x-top-bar>
        <li class="breadcrumb-item">
            <i class="las la-home la-lg"></i> Dashboard
        </li>
    </x-top-bar>
@endsection
<!-- BEGIN: Content -->
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="flex items-center h-10 intro-y">
                    <h2 class="mr-5 text-lg font-medium truncate">
                        General Report
                    </h2>
                    <a href="" class="flex items-center ml-auto text-primary"> <i data-feather="refresh-ccw"
                            class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <!-- BEGIN: Sales Report -->
                    <div class="col-span-12 sm:col-span-4">
                        <div class="p-5 intro-y box">
                            <h2 class="mr-5 text-lg font-medium truncate">
                                Total Archives per Type
                            </h2>
                            <canvas id="archives_donut" height="300"></canvas>
                        </div>
                    </div>
                    <!-- END: Sales Report -->
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="p-5 box">
                                <div class="flex">
                                    <i data-feather="file-text" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="mt-6 text-3xl font-medium leading-8">{{ $archives_total }}</div>
                                <div class="mt-1 text-base text-slate-500">Number of Uploaded Archives</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
        </div>
    </div>
</div>
<!-- END: Content -->

@push('scripts')
    <script>
        if ($("#archives_donut").length) {
            let ctx = $("#archives_donut")[0].getContext("2d");
            let myDoughnutChart = new Chart(ctx, {
                labels: [
                    @foreach ($types as $type)
                        "{{ $type->description }}",
                    @endforeach
                ],
                title: "Archives per type",
                type: "doughnut",
                data: {
                    labels: [
                        @foreach ($types as $type)
                            "{{ $type->description }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($types as $type)
                                {{ $type->archives->count() }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(225, 159, 64, 0.2)',
                            'rgba(125, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(225, 159, 64, 0.2)',
                            'rgba(125, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(185, 139, 64, 1)',
                            'rgba(125, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(185, 139, 64, 1)',
                            'rgba(125, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                    },
                    cutoutPercentage: 80,
                },
            });
        }
    </script>
@endpush
