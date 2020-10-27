<!DOCTYPE html>
<html lang="en">
<head>
    <title>Unicat</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Unicat project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('web_assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('web_assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/styles/main_styles.css') }}">

    @stack('page-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('web_assets/styles/responsive.css') }}">


</head>
<body>

<div class="super_container">

    @include('web.layouts.header')

    @yield('main-body')

    @include('web.layouts.footer')
</div>

<script src="{{ asset('web_assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('web_assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('web_assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('web_assets/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('web_assets/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('web_assets/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('web_assets/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('web_assets/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('web_assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('web_assets/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('web_assets/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('web_assets/js/custom.js') }}"></script>

@stack('page-js')

</body>
</html>
