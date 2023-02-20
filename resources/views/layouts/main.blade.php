<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Z-Books</title>
        <!--Boostrap css-->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <!--Font-awesome-->
        <link href="{{ asset('assets/css/font-awesome-all.min.css') }}" rel="stylesheet" />
        <!-- Custom styles for this carousel -->
        <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet">
        <!-- Custom styles for this style.css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <!-- icon web -->
        <link rel="shortcut icon" href="{{ asset('assets/images/icon-books.png') }}" type="image/x-icon">
        <!-- swiper -css -->
        <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet" />
        <!-- jquery ui Css -->
        <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <!---datatables -->
        <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}" />
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </head>

    <body>
        @include('layouts.nav.mainNavbar')
        <div class="container mt-4">
            @yield('main-content')
        </div>

        <!-- Footer -->
        <footer class="bg-dark py-5 mt-5">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Ahmad Zuhril {{ date('Y'); }}</p>
            </div>
        </footer>
        <!-- Footer -->

        <!--Boostrap js-->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <!--Font-awesome js-->
        <script src="{{ asset('assets/js/font-awesome-all.min.js') }}"></script>
        <!-- swiper js -->
        <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
        <!-- midtrans -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BEF5FN-7hSPvPyIg"></script>
        <!-- my script -->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <!-- sweetalert 2-->
        <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
        @yield('script')
    </body>
</html>