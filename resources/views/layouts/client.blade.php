<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from webtendtheme.net/html/2024/ravelo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Oct 2024 09:26:27 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Traveloka - @yield('title')</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('clients/images/logos/favicon.png') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <!-- Flaticon -->
    <link rel="stylesheet" href="{{ asset('clients/css/flaticon.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('clients/css/fontawesome-5.14.0.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"> --}}

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('clients/css/bootstrap.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('clients/css/magnific-popup.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('clients/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/jquery-ui.min.css') }}">
    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('clients/css/aos.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('clients/css/slick.min.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('clients/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/css/custom-css.css') }}">

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('clients/css/css-login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('clients/css/css-login/style.css') }}">

</head>

<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader">
            <div class="custom-loader"></div>
        </div>

        <!-- main header -->
        @include('clients.blocks.header')

              @yield('content')
        <!-- footer area start -->
       @include('clients.blocks.footer')
        <!-- footer area end -->

    </div>
    <!--End pagewrapper-->
   
    
    <!-- Jquery -->
    <script src="{{ asset('clients/js/jquery-3.6.0.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('clients/js/bootstrap.min.js')}}"></script>
    <!-- Appear Js -->
    <script src="{{ asset('clients/js/appear.min.js')}}"></script>
    <!-- Slick -->
    <script src="{{ asset('clients/js/slick.min.js')}}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('clients/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Nice Select -->
    <script src="{{ asset('clients/js/jquery.nice-select.min.js')}}"></script>
    <!-- Image Loader -->
    <script src="{{ asset('clients/js/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Skillbar -->
    <script src="{{ asset('clients/js/skill.bars.jquery.min.js')}}"></script>
    <!-- Isotope -->
    <script src="{{ asset('clients/js/isotope.pkgd.min.js')}}"></script>
     <!-- Jquery UI -->
    <script src="{{ asset('clients/js/jquery-ui.min.js')}}"></script>
    <!-- Isotope -->
    <!--  AOS Animation -->
    <script src="{{ asset('clients/js/aos.js')}}"></script>
    <!-- Custom script -->
    <script src="{{ asset('clients/js/script.js')}}"></script>
    <script src="{{ asset('clients/js/custom-js.js')}}"></script>
    <script src="{{ asset('clients/js/jquery.datetimepicker.full.min.js')}}"></script>


</body>

<!-- Mirrored from webtendtheme.net/html/2024/ravelo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Oct 2024 09:27:04 GMT -->
</html>
