<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>جمعية أدندان الخيرية</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="{{ asset('icons/download.png') }}" type="image/x-icon">
    @vite('resources/sass/app.scss')
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-ecdc8d53.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui-pro@4.5.0/dist/css/coreui.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css') }}">
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <img src="{{ asset('icons/full-logo.png') }}" class="mr-2 sidebar-brand-full text-center" width="80%" height="80%" alt="CoreUI Logo">
            <img src="{{ asset('icons/download.png') }}" class="sidebar-brand-narrow text-center" width="46" height="46" alt="CoreUI Logo">
        </div>
        @include('layouts.navigation')
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @yield('header')
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div>
                كل الحقوق محفوظة
                <span>
                    <span id="year"></span>
                </span>
                &copy;
                جمعية أدندان الخيرية
            </div>
            <div class="mr-auto">تم التصميم و التطوير بواسطة
                <a href="https://www.facebook.com/omar.elmalek.5">Omar Abdelatif</a>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{asset('assets/backend/js/jquery.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/@coreui/coreui-pro@4.5.0/dist/js/coreui.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src=""></script>
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>
</body>

</html>
