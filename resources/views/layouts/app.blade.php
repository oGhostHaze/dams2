<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="theme-2" data-theme="forest">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Styles --}}
    {{-- BEGIN: CSS Assets --}}
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
    {{-- END: CSS Assets --}}
    @livewireStyles

</head>

<body class="py-5">
    <x-mobile-menu />
    @yield('top-bar')
    <x-top-menu />

    <main class="content">
        {{ $slot }}
    </main>

    {{-- <x-dark-mode-switcher />
    <x-color-scheme-switcher /> --}}

    {{-- BEGIN: JS Assets --}}
    @livewireScripts
    <script src="{{ mix('dist/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- END: JS Assets --}}
    <x-livewire-alert::scripts />
    @stack('modals')

    <script type="text/javascript">
        function printDiv(divName) {
            $(".table th:last-child, .table td:last-child").hide();

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.document.close();
            $(".table th:last-child, .table td:last-child").show();

            window.focus();
        }

        function printDivFix(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.document.close();

            window.focus();
        }
    </script>
    @stack('scripts')
</body>

</html>
