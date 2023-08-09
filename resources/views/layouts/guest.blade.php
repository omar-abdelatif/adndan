<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('icons/download.png') }}" type="image/x-icon">
    <title>جمعية أدندان الخيرية</title>
    <meta name="theme-color" content="#ffffff">
    @vite('resources/sass/app.scss')
</head>
<body>

<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
</body>
</html>
