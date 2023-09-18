<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BLOG</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('front/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('front.layouts.nav')
        <!-- Page header with logo and tagline-->
        @include('front.layouts.header')
        <!-- Page content-->
        @yield('container')
        <!-- Footer-->
        @include('front.layouts.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js')}}"></script>
    </body>
</html>
