<!DOCTYPE html>
<html lang="en">
@php
    $adm_setting = allsetting();
@endphp
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Title -->
    <link rel="shortcut icon" type="image/png" href="@if(!empty(allsetting('favicon'))) {{ asset(path_image().allsetting('favicon')) }} @endif "/>
    <title>@yield('title','Quiz App | iTech')</title>
    @include('user.header_includes')
</head>

<body class="cat-b">

    @include('user.header')

    {{--<div class="row mt-4">
        <div class="col-lg-8 offset-2">
            @if(empty($adm_setting['is_authenticated']) || ($adm_setting['is_authenticated'] == LICENSE_NOT_VERIFIED))
                <marquee behavior="" direction="">
                    <h4 class="text-center text-danger">{{__('This product is not verified or purchase code expired')}}</h4>
                </marquee>
            @endif
            @include('layout.message_new')
        </div>
    </div>--}}

    @yield('main-body')

    @include('user.footer')

    @include('user.scripts')

    @yield('script')
</body>

</html>