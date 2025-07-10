<?php

use Illuminate\Support\Facades\Route;

$currentRoute = Route::currentRouteName();

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ !empty($title) ? $title : 'Basic Funde Clear' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(!empty($metadata))
    <meta name="keywords" content="@php
        $metakeyArray = json_decode($metadata->metakey);
        if (!empty($metakeyArray) && is_array($metakeyArray)) {
            $keywords = array_map(function($item) {
                return $item->value; 
            }, $metakeyArray); echo implode(', ', $keywords); }
    @endphp">
    <meta name="description" content="{{ $metadata->metadescription }}">
    <meta name="author" content="{{ $metadata->metatitle }}">
    @elseif(empty($metadata))
    <meta name="keywords" content="Investmeent,Finance">
    <meta name="description" content="Basic Funde Clear">
    <meta name="author" content="BFC">
    @endif


    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/webassets/img/favicon.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('assets/webassets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/mobile-nav.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/webassets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/webassets/css/teamstyle.css')}}">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-xmE/roY6xJIL1zYS2BgQyz1Vz7RkvXZs4QWfLS/Ye5+DxRr4qT8pdEdFDtKb3HhKXshYNxsqEKP1QUuIbHeQ4w==" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>
</head>

<body>



    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header>
        <div id="sticky-header" class="menu-area transparent-header">
            <!-- <div id="sticky-header" class="menu-area transparent-header @if($currentRoute=='about' || 'showdetails')About_header_bfc_content @endif"> -->
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav show">
                                <!-- <div class="logo">
                                    <a href="{{route('index')}}">
                                        <img src="{{asset('assets/webassets/img/logo/logo.png')}}" alt="Logo">
                                    </a>
                                </div> -->
                                <div class="logo">
                                    <a class="d-flex align-items-center logo-bfc-with-name" href="index">
                                        <img class="pr-2" src="{{asset('assets/webassets/img/logo/favicon.png')}}" alt="Logo">
                                        <div class="logo_funde_name">
                                            <h1 class="mb-0">Basic Funde Clear</h1>
                                        </div>
                                    </a>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li class="menu-item-has-children">
                                            <a class="@if($currentRoute=='index')active @endif" href="{{route('index')}}" alt="">
                                                Home
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="{{route('about')}}" class="bfc-content-menu-link @if($currentRoute=='about')active @endif">
                                                About Us
                                            </a>
                                        </li>

                                        <li>
                                            <a class="bfc-content-menu-link @if($currentRoute=='show')active @endif" href="{{route('show')}}">Shows</a>
                                        </li>
                                        <!-- <li>
                                            <a onclick="addactive()" id="bfcshort" class="bfc-content-menu-link @if($currentRoute=='shorts')active @endif" href="{{route('shorts')}}">
                                                Shorts
                                            </a>
                                        </li> -->
                                        <li>
                                            <a onclick="addactive()" id="contact" class="bfc-content-menu-link @if($currentRoute=='contact')active @endif" href="{{route('contact')}}">contact Us</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="{{route('rentstudiodetails')}}" class="bfc-content-menu-link @if($currentRoute=='rentstudiodetails')active @endif">
                                                Rent Studio
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->

    <!-- Mobile_menu -->
    <section class="header_mobile_nav">
        <nav class="container">
            <div class="mobile_bfccontent_menu">

                <ul class="mobile-bfccontent-menu-list">
                    <li class="bfcmenu-item mobile_active_iconbfc @if($currentRoute=='index')bfcbg-active @endif">
                        <a href="{{route('index')}}" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                            </svg>
                        </a>
                    </li>
                    <li class="bfcmenu-item mobile_active_iconbfc @if($currentRoute=='show')bfcbg-active @endif">
                        <a href="{{route('show')}}" class="">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 256 256" xml:space="preserve">

                                <defs>
                                </defs>
                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                    <path d="M 87.424 13.729 H 45.239 h -0.478 H 2.576 C 1.153 13.729 0 14.883 0 16.305 v 57.39 c 0 1.422 1.153 2.576 2.576 2.576 h 42.185 h 0.478 h 42.185 c 1.422 0 2.576 -1.153 2.576 -2.576 v -57.39 C 90 14.883 88.847 13.729 87.424 13.729 z M 13.631 68.988 c 0 0.733 -0.594 1.328 -1.328 1.328 H 6.328 C 5.595 70.316 5 69.721 5 68.988 v -5.976 c 0 -0.733 0.595 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 68.988 z M 13.631 54.988 c 0 0.733 -0.594 1.328 -1.328 1.328 H 6.328 C 5.595 56.316 5 55.721 5 54.988 v -5.976 c 0 -0.733 0.595 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 54.988 z M 13.631 40.988 c 0 0.733 -0.594 1.328 -1.328 1.328 H 6.328 C 5.595 42.316 5 41.721 5 40.988 v -5.976 c 0 -0.733 0.595 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 40.988 z M 13.631 26.988 c 0 0.733 -0.594 1.328 -1.328 1.328 H 6.328 C 5.595 28.316 5 27.721 5 26.988 v -5.976 c 0 -0.733 0.595 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 26.988 z M 56.287 46.381 L 35.604 58.322 c -1.063 0.614 -2.392 -0.153 -2.392 -1.381 V 33.059 c 0 -1.228 1.329 -1.995 2.392 -1.381 l 20.683 11.941 C 57.35 44.233 57.35 45.767 56.287 46.381 z M 85 68.988 c 0 0.733 -0.595 1.328 -1.328 1.328 h -5.976 c -0.733 0 -1.328 -0.595 -1.328 -1.328 v -5.976 c 0 -0.733 0.594 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 68.988 z M 85 54.988 c 0 0.733 -0.595 1.328 -1.328 1.328 h -5.976 c -0.733 0 -1.328 -0.595 -1.328 -1.328 v -5.976 c 0 -0.733 0.594 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 54.988 z M 85 40.988 c 0 0.733 -0.595 1.328 -1.328 1.328 h -5.976 c -0.733 0 -1.328 -0.595 -1.328 -1.328 v -5.976 c 0 -0.733 0.594 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 40.988 z M 85 26.988 c 0 0.733 -0.595 1.328 -1.328 1.328 h -5.976 c -0.733 0 -1.328 -0.595 -1.328 -1.328 v -5.976 c 0 -0.733 0.594 -1.328 1.328 -1.328 h 5.976 c 0.733 0 1.328 0.594 1.328 1.328 V 26.988 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #ffff; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                </g>
                            </svg>
                        </a>
                    </li>
                    <!-- <li class="bfcmenu-item mobile_active_iconbfc @if($currentRoute=='shorts')bfcbg-active @endif">
                        <a href="{{route('shorts')}}" class="">

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 256 256" xml:space="preserve">

                                <defs>
                                </defs>
                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                    <path d="M 69.186 38.498 c -1.406 -0.795 -2.751 -1.651 -4.34 -2.568 c 1.589 -0.978 3.057 -1.834 4.463 -2.629 c 6.541 -3.546 10.148 -10.759 9.047 -18.095 C 76.766 3.164 62.889 -3.804 52.375 2.186 C 41.616 8.361 30.857 14.413 20.22 20.77 c -8.436 5.074 -9.659 11.798 -8.314 19.745 c 0.856 4.952 4.157 8.619 8.497 11.126 c 1.528 0.856 2.995 1.712 4.646 2.69 c -1.834 1.1 -3.484 2.078 -5.257 2.995 c -7.825 4.952 -10.515 15.099 -6.113 23.291 c 4.646 8.62 15.405 11.921 24.024 7.275 c 9.292 -5.257 18.584 -10.637 27.815 -16.016 c 2.201 -1.284 4.524 -2.445 6.48 -4.035 C 81.84 59.649 80.373 44.795 69.186 38.498 z M 36.359 58.549 V 31.835 l 23.108 13.327 L 36.359 58.549 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: #ffff; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                </g>
                            </svg>

                        </a>
                    </li> -->
                    <li class="bfcmenu-item mobile_active_iconbfc @if($currentRoute=='about')bfcbg-active @endif">
                        <a href="{{route('about')}}" class="">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                            </svg>

                        </a>
                    </li>
                </ul>

            </div>
        </nav>
    </section>
    <!--header section end here--->

    <!-- main content section start here -->

    @yield('content')

    <!-- main content section end here -->

    <!-- footer-area -->
    <footer id="contact1-section">
        <div class="footer-top-wrap pb-2">
            <div class="container-fluid">
                <div class="footer-menu-wrap">
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- <div class="footer-logo">
                                <a href="{{route('index')}}"><img src="{{asset('assets/webassets/img/logo/logo.png')}}" alt=""></a>
                            </div> -->
                            <div class="logo">
                                <a class="d-flex align-items-center logo-bfc-with-name" href="index">
                                    <img class="pr-2 py-0" src="{{asset('assets/webassets/img/logo/favicon.png')}}" alt="Logo">
                                    <div class="logo_funde_name">
                                        <h1 class="mb-0 footer-logotext">Basic Funde Clear</h1>
                                    </div>
                                </a>
                            </div>

                            <p class="footer-text p-4 mb-0">Basic Funde Clear is a platform that provides information about various shows, including their schedules, cast, and other details.</p>

                        </div>
                        <div class="col-lg-3">
                            <div class="bfc-content-area">
                                <h5 class="ml-2 mb-3">Contact Us</h5>
                                <p> <span>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                        </svg>
                                    </span>: &nbsp; +91 7348700888</p>
                                <p><span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                        </svg>
                                    </span>: &nbsp;info@basicfundeclear.com</p>
                                <p><span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        </svg>
                                    </span>: &nbsp; CP-61, Viraj Khand, Gomti Nagar, Lucknow, Uttar Pradesh 226010</p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="footer-menu">
                                <nav>
                                    <ul class="navigation">

                                        <li><a class="bfc-content-menu-link @if($currentRoute=='about')active @endif" href="{{route('about')}}">About Us</a></li>
                                        <li><a class="bfc-content-menu-link @if($currentRoute=='show')active @endif" href="{{route('show')}}">shows</a></li>
                                        <!-- <li><a class="bfc-content-menu-link @if($currentRoute=='shorts')active @endif" href="{{route('shorts')}}">Shorts</a></li> -->
                                        <li><a class="bfc-content-menu-link @if($currentRoute=='privacypolicy')active @endif" href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                                        <li><a class="bfc-content-menu-link @if($currentRoute=='termsandconditions')active @endif" href="{{route('termsandconditions')}}">Terms & Conditions</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="map-funde pt-md-4 pt-2">

                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2970.9862583816275!2d81.01974917450269!3d26.851981912699532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399be2e63c8d5997%3A0x33e9ebd3d6fdd310!2sBFC%20Capital%20Pvt.%20Ltd.!5e1!3m2!1sen!2sin!4v1751698258803!5m2!1sen!2sin" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-quick-link-wrap">

                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="copyright-text">
                                <p>Copyright &copy; {{ date("Y") }}. All Rights Reserved By <a href="{{ route('index') }}">BFC Content</a></p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="footer-social">
                                <ul>

                                    <li>
                                        <a href="https://www.youtube.com/@Basicfundeclear" target="_blank"><i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://facebook.com/basicfundeclear" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="https://www.instagram.com/basicfundeclear/" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>


                                    <li>
                                        <a href="https://twitter.com/Basicfundeclear" target="_blank"><i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                    </li>

                                    <!-- <li>
                                        <a href="https://www.linkedin.com/company/basic-funde-clear/about/" target="_blank"><i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- footer-area-end -->

    <!-- JS here -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/webassets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/webassets/js/bootstrap.min.js')}}"></script>
    <!-- jQuery library -->

    <!-- <script src="{{asset('assets/webassets/js/imagesloaded.pkgd.min.js')}}"></script> -->
    <script src="{{asset('assets/webassets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- <script src="{{asset('assets/webassets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/webassets/js/jquery.appear.js')}}"></script> -->

    <script src="{{asset('assets/webassets/js/jquery.odometer.min.js')}}"></script>
    <script src="{{asset('assets/webassets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/webassets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/webassets/js/plugins.js')}}"></script>

    <script src="{{asset('assets/webassets/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/webassets/js/main.js')}}"></script>
    <script src="{{asset('assets/webassets/js/videos.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/webassets/js/aos.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!---script section for mail--->

    @stack('validation-js')

    <script>
        // Scroll to the desired section on page load
        window.addEventListener('load', function() {
            var currentRoute = <?php echo json_encode($currentRoute); ?>;
            console.log("Current Route:", currentRoute);

            // Construct the section ID based on the current route
            var sectionId = currentRoute + '-section'; // Example: 'contact-section', 'show-section', 'shorts-section'

            // Find the section element in the HTML
            var section = document.getElementById(sectionId);
            console.log("Section:", section);

            // Scroll to the section if it exists
            if (section) {
                var headerOffset = 80; // Adjust this value based on your fixed header height
                var sectionPosition = section.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: sectionPosition,
                    behavior: 'smooth'
                });
            }
        });
    </script>

    <script src="{{asset('assets/webassets/js/custom.js')}}"></script>

</body>


</html>