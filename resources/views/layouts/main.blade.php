<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Z-Books</title>
        <!--Boostrap css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!--Font-awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
                integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Custom styles for this carousel -->
        <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet">
        <!-- Custom styles for this style.css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        <!-- icon web -->
        <link rel="shortcut icon" href="{{ asset('assets/images/icon-books.png') }}" type="image/x-icon">
        <!-- swiper -css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <!-- jquery ui Css -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <!-- select2 cdn-->
        <!--- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
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

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <!--Boostrap js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
        <!--Font-awesome js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
            integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- swiper js -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <!-- select()2 script -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
        <!-- midtrans -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BEF5FN-7hSPvPyIg"></script>
        <!-- my script -->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        @yield('script')
    </body>
</html>