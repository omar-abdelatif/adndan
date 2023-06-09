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
    <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui-pro@4.5.0/dist/css/coreui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/backend/css/style.css') }}">
</head>

<body>
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <div class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <img src="{{ asset('icons/full-logo.png') }}" class="mr-2" width="80%" height="46%" alt="">
            </div>
            <div class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
                <img src="{{ asset('icons/download.png') }}" width="80%" alt="">
            </div>
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
    <script src="{{asset('build/assets/backend/js/jquery.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/@coreui/coreui-pro@4.5.0/dist/js/coreui.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="{{ asset('build/assets/backend/js/custom.js') }}"></script>
</body>

</html>
