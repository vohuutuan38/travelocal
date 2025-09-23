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
    <title>Traveloka - {{ $title }}</title>
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
        <header
            class="main-header header-one white-menu menu-absolute {{ Request::is('tour-detail/*') || Request::is('login') || Request::is('tour') ? 'header-login' : '' }}">
            <!--Header-Upper-->
            <div class="header-upper py-15 rpy-0">
                <div class="container-fluid clearfix">

                    <div class="header-inner rel d-flex align-items-center">
                        <div class="logo-outer">
                            <div class="logo"><a href="{{ route('home') }}"><img
                                        src="{{ asset('clients/images/logos/logo.png') }}" alt="Logo"
                                        title="Logo"></a></div>
                        </div>

                        <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-lg">
                                <div class="navbar-header">
                                    <div class="mobile-logo">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('clients/images/logos/logo.png') }}" alt="Logo"
                                                title="Logo">
                                        </a>
                                    </div>

                                    <!-- Toggle Button -->
                                    <button type="button" class="navbar-toggle" data-bs-toggle="collapse"
                                        data-bs-target=".navbar-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix">
                                    <ul class="navigation clearfix">
                                        <li class="current {{ Request::url() == route('home') ? 'active' : '' }}"><a
                                                href="{{ route('home') }}">Trang chủ</a></li>
                                        <li class="{{ Request::url() == route('about') ? 'active' : '' }}"><a
                                                href="{{ route('about') }}">Giới thiệu</a></li>
                                        <li
                                            class="dropdown {{ Request::url() == route('tour') || Request::url() == route('tour-guide') ? 'active' : '' }}">
                                            <a href="{{ route('tour') }}">Tours</a>
                                            <ul>
                                                <li><a href="{{ route('tour') }}">Tour</a></li>
                                                <li><a href="{{ route('tour-guide') }}">Hướng dẫn viên</a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ Request::url() == route('destination') ? 'active' : '' }}"><a
                                                href="{{ route('destination') }}">Điểm đến</a></li>
                                        <li class="{{ Request::url() == route('contact') ? 'active' : '' }}"><a
                                                href="{{ route('contact') }}">Liên hệ</a></li>

                                        <li class="{{ Request::url() == route('blog') ? 'active' : '' }}"><a
                                                href="{{ route('blog') }}">blog</a></li>
                                        {{-- <a href="contact.html" class="theme-btn  bgc-secondary">
                                            <span data-hover="Register">Register</span>
                                        </a> --}}
                                    </ul>
                                </div>

                            </nav>
                            <!-- Main Menu End-->
                        </div>

                        <!-- Nav Search -->
                        <div class="nav-search">
                            <button class="far fa-search"></button>
                            <form action="#" class="hide">
                                <input type="text" placeholder="Search" class="searchbox" required="">
                                <button type="submit" class="searchbutton far fa-search"></button>
                            </form>
                        </div>

                        <!-- Menu Button -->
                        <div class="menu-btns py-10">
                            <a href="contact.html" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Book Now">Book Now</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                            <!-- menu sidbar -->
                            <div class="menu-sidebar">
                                <li class="drop-down">
                                    <button class="dropdown-toggle bg-transparent" id="userDropdown"
                                        style="border: none;">
                                        @auth
                                            <img src="{{ Auth::user()->avatar ? asset('clients/images/avatar/' . Auth::user()->avatar) : asset('clients/images/avatar/avatar-default.png') }}"
                                                alt="Avatar"
                                                style="width:40px; height:40px; border-radius:50%; border:2px solid white; object-fit:cover;">
                                        @endauth

                                        @guest
                                          <i class="fad fa-user-circle" style="font-size: 40px; color:#f7921e; border: 2px solid white; border-radius: 30px;"></i>
                                        @endguest
                                    </button>

                                    <ul class="dropdown-menu" id="dropdownMenu">
                                        @guest
                                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                        @endguest

                                        @auth
                                            <li><a href="{{ route('profile') }}">Thông tin cá nhân</a></li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit"
                                                        style="background:none; border:none; padding:0; color:red;">
                                                        Đăng xuất
                                                    </button>
                                                </form>
                                            </li>
                                        @endauth
                                    </ul>
                                </li>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->

            {{-- thông báo --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show flex-center-message" role="alert"
                    id="flash-message">
                    <i class="fad fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show flex-center-message" role="alert"
                    id="flash-message">
                    <i class="fad fa-times-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

        </header>
