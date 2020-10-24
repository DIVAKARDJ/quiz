<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Title -->
    <title>{{isset($pageTitle) ? $pageTitle : ''}} </title>
    <!-- Icon fonts -->
    <link href="{{asset('assets/user/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/themify-icons.css')}}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/user/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Plugins for this template -->
    <link href="{{asset('assets/user/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/slicknav.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/user/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/css/responsive.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- start page-loader -->
<div class="page-loader">
    <div class="page-loader-inner">
        <div class="inner"></div>
    </div>
</div>
<!-- end page-loader -->
<!-- header-area start -->
<header  class="sticky-header">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-9 col-sm-9 col-9">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img @if(!empty($adm_setting['logo'])) src ="{{ asset(path_image().$adm_setting['logo']) }}"
                                 @else src="{{asset('assets/user/images/logo.png')}}" @endif alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="main-menu">
                        <nav class="nav_mobile_menu">
                            <ul id="nav_menu">
                                <li class="active"><a href="#home">Home</a></li>
                                <li><a href="#About">About Us </a></li>
                                <li><a href="#features">Feature</a></li>
                                <li><a href="#work">How It Works</a></li>
                                <li><a  class="header-btn" href="{{route('login')}}">{{__('Sign In')}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    @if(empty($adm_setting['is_authenticated']) || ($adm_setting['is_authenticated'] == LICENSE_NOT_VERIFIED))
        <div>
            <h4 class="text-center text-danger">{{__('This product is not verified or purchase code expired.')}}</h4>
        </div>
    @endif
</header>
<!-- header-area end -->
<!-- start of hero -->
<section  id="home" class="hero-style-1">
    <div class="hero-slider bg-animate-shape">
        <div class="slide">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-7 hero-caption">
                        <h2 class=" wow fadeInDown" data-wow-duration="2000ms">
                            @if(isset($adm_setting['landing_banner_title']))
                                {{$adm_setting['landing_banner_title']}}
                            @else
                             Complete Quiz Solution With Android And Interactive Admin.
                            @endif
                        </h2>
                        <p class=" wow fadeInUp" data-wow-duration="2500ms">
                            @if(isset($adm_setting['landing_banner_des']))
                                {{str_limit($adm_setting['landing_banner_des'], 200)}}
                            @else
                                which of us ever undertakes laborious physical exercise,
                                except to obtain some advantage from it? But who has any right to find fault with a man.
                            @endif
                        </p>
                        <div class="btns wow fadeInUp" data-wow-duration="2700ms">
                            <div class="btn-style"><a href="{{route('login')}}">{{__('Get Started')}}</a></div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="hero-img wow fadeInRightSlow" data-wow-duration="2700ms">
                            @if(isset($adm_setting['landing_banner_image']))
                                <img src="{{asset(path_image().$adm_setting['landing_banner_image'])}}" alt="">
                            @else
                                <img src="{{asset('assets/user/images/slider/img-1.png')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape3">
            <img alt="" src="{{asset('assets/user/images/shape/shape-1.png')}}">
        </div>
    </div>
</section>
<!-- end of hero slider -->

<!-- start about-section -->
<section id="About" class="about-section bg-animate-shape">
    <div class="content-area">
        <div class="left-content">
            @if(isset($adm_setting['landing_about_image']))
                <img src="{{asset(path_image().$adm_setting['landing_about_image'])}}" alt="">
            @else
                <img src="{{asset('assets/user/images/about-pic2.png')}}" alt>
            @endif
            <div class="about-shape-1">
                <img src="{{asset('assets/user/images/about-shape-1.png')}}" alt>
            </div>
            <div class="about-shape-2">
                <img src="{{asset('assets/user/images/about-shape-1.png')}}" alt>
            </div>
        </div>
        <div class="right-content">
            <div class="about-content">
                <div class="section-title">
                    <span>{{__('About us')}}</span>
                    <h2>
                        @if(isset($adm_setting['landing_about_title']))
                            {{$adm_setting['landing_about_title']}}
                        @else
                            Vehicula Donec Dignissim Dristique Vivamus.
                        @endif
                    </h2>
                </div>
                <div class="details">
                    <p>
                        @if(isset($adm_setting['landing_about_des']))
                            {{$adm_setting['landing_about_des']}}
                        @else
                            Etiam vitae sodales nisi, nec vehicula justo. Donec dignissim nulla non purus tristique placerat.
                            Vivamus sed erat arcu. Vestibulum eget gravida dolor. Praesent ultricies lacinia lorem vel bibendum.
                            Proin viverra arcu at mollis porttitor. Nulla facilisi. Etiam pellentesque, lacus nec hendrerit scelerisque,
                            lectus elit convallis augue, id condimentum nulla tellus sit amet nisi. Vivamus sed ultrices risus.
                            Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="shape1">
        <img alt="" src="{{asset('assets/user/images/shape/shape-3.png')}}">
    </div>
    <div class="shape2">
        <img alt="" src="{{asset('assets/user/images/shape/shape-2.png')}}">
    </div>
    <div class="shape4">
        <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
    </div>
    <div class="shape5">
        <img alt="" src="{{asset('assets/user/images/shape/shape-3.png')}}">
    </div>
    <div class="shape6">
        <img alt="" src="{{asset('assets/user/images/shape/shape-2.png')}}">
    </div>
    <div class="shape7">
        <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
    </div>
</section>
<!-- end about-section -->
<!-- .feature-area start -->
<section id="features">
    <div class="features-area bg-animate-shape">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title section-title-2">
                        <span>{{__('Our Features')}}</span>
                        <h2>
                            @if(isset($adm_setting['landing_feature_title']))
                                {{$adm_setting['landing_feature_title']}}
                            @else
                                We Offer To Complete Range Of Feature.
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($features[0]))
                    @php $i= 1 @endphp
                    @foreach($features as $item)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="features-item wow fadeInUp @if($i == 1) features-item-6 @elseif($i== 2) features-item-2
                                @elseif($i== 3) features-item-3 @elseif($i== 4) features-item-4 @else features-item-5 @endif" data-wow-duration="1500ms">
                                <div class="features-icon">
                                    <div class="normal-img">
                                        <img alt="" src="{{$item->image}}">
                                    </div>
                                    <div class="active-img">
                                        <img alt="" src="{{$item->image}}">
                                    </div>
                                </div>
                                <div class="features-content">
                                    <h2>{{$item->title}}</h2>
                                    <p>
                                        @if(!empty($item->description))
                                            {{str_limit($item->description, 100)}}
                                        @else
                                            Etiam laoreet or vestibulum aliquam tortor sed tell us feugiat aliquam varius.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @php $i++ @endphp
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-center text-danger">{{__("No data found")}}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="shape5 shape-l">
            <img alt="" src="{{asset('assets/user/images/shape/shape-1.png')}}">
        </div>
        <div class="shape4">
            <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
        </div>
        <div class="shape1 shape-b">
            <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
        </div>
    </div>
</section>

<!-- .feature-area end -->
<!-- work-area start -->
<section id="work">
    <div  class="work-area bg-animate-shape">
        <div class="work-sub">
            <div class="work-wrap">
                <div class="work-left wow fadeInLeftSlow" data-wow-duration="1500ms">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="work-single work-single-5">
                                <h4>{{__('Create Account')}}</h4>
                                <p>
                                    @if(isset($adm_setting['landing_work_step1']))
                                        {{str_limit($adm_setting['landing_work_step1'], 200)}}
                                    @else
                                        which of us ever undertakes laborious physical exercise,
                                        except to obtain some advantage from it? But who has any right to find fault with a man.
                                    @endif
                                </p>
                                <span>1</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="work-single work-single-2">
                                <h4>{{__('Sign In')}}</h4>
                                <p>
                                    @if(isset($adm_setting['landing_work_step2']))
                                        {{str_limit($adm_setting['landing_work_step2'], 200)}}
                                    @else
                                        which of us ever undertakes laborious physical exercise,
                                        except to obtain some advantage from it? But who has any right to find fault with a man.
                                    @endif
                                </p>
                                <span>2</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="work-single work-single-3">
                                <h4>{{__('Select Category')}}</h4>
                                <p>
                                    @if(isset($adm_setting['landing_work_step3']))
                                        {{str_limit($adm_setting['landing_work_step3'], 200)}}
                                    @else
                                        which of us ever undertakes laborious physical exercise,
                                        except to obtain some advantage from it? But who has any right to find fault with a man.
                                    @endif
                                </p>
                                <span>3</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="work-single work-single-4">
                                <h4>{{__('Start Play')}}</h4>
                                <p>
                                    @if(isset($adm_setting['landing_work_step4']))
                                        {{str_limit($adm_setting['landing_work_step4'], 200)}}
                                    @else
                                        which of us ever undertakes laborious physical exercise,
                                        except to obtain some advantage from it? But who has any right to find fault with a man.
                                    @endif
                                </p>
                                <span>4</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="work-right wow fadeInRightSlow" data-wow-duration="1500ms">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <span>{{__('How It Works')}}</span>
                                <h2>
                                    @if(isset($adm_setting['work_process_title']))
                                        {{$adm_setting['work_process_title']}}
                                    @else
                                        How Does It Work, Know With Us.
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                    <p>
                        @if(isset($adm_setting['landing_work_des']))
                            {{$adm_setting['landing_work_des']}}
                        @else
                            Etiam vitae sodales nisi, nec vehicula justo. Donec dignissim nulla non purus tristique placerat.
                            Vivamus sed erat arcu. Vestibulum eget gravida dolor. Praesent ultricies lacinia lorem vel bibendum.
                            Proin viverra arcu at mollis porttitor. Nulla facilisi. Etiam pellentesque.
                        @endif
                    </p>
                    <div class="btns">
                        <div class="btn-style"><a href="{{route('login')}}">{{__('Start PlaY')}}</a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shape1 shape-n">
            <img alt="" src="{{asset('assets/user/images/shape/shape-3.png')}}">
        </div>
        <div class="shape2 shape-t">
            <img alt="" src="{{asset('assets/user/images/shape/shape-2.png')}}">
        </div>
        <div class="shape4">
            <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
        </div>
        <div class="shape5">
            <img alt="" src="{{asset('assets/user/images/shape/shape-3.png')}}">
        </div>
        <div class="shape6">
            <img alt="" src="{{asset('assets/user/images/shape/shape-2.png')}}">
        </div>
        <div class="shape7">
            <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
        </div>
    </div>
</section>

<!-- work-area end -->

<!-- downloaded-area start-->
<div id="downloaded" class="download-area bg-animate-shape">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="download-text wow fadeInLeftSlow" data-wow-duration="1500ms">
                    <div class="section-title">
                        <span>{{__('Download')}}</span>
                        <h2>
                            @if(isset($adm_setting['landing_download_title']))
                                {{$adm_setting['landing_download_title']}}
                            @else
                                Download On Quizest Mobile App.
                            @endif
                        </h2>
                    </div>
                    <p>
                        @if(isset($adm_setting['landing_download_des']))
                            {{$adm_setting['landing_download_des']}}
                        @else
                            Etiam vitae sodales nisi, nec vehicula justo. Donec dignissim nulla non purus tristique placerat.
                            Vivamus sed erat arcu. Vestibulum eget gravida dolor. Praesent ultricies lacinia lorem vel bibendum.
                            Proin viverra arcu at mollis porttitor. Nulla facilisi. Etiam pellentesque.
                        @endif
                    </p>
                    <div class="download-btn">
                        <div class="btn-1">
                            <a @if(isset($adm_setting['landing_app_download_link']))
                               href="{{$adm_setting['landing_app_download_link']}}"
                               {{--href="https://stackoverflow.com/questions/13955667/disabled-href-tag/13955695"--}}
                               @else href="#" @endif>
                                <img alt="" src="{{asset('assets/user/images/btn-1.png')}}"> {{__('Google Play')}}
                            </a>
                        </div>
                        <div class="btn-2">
                            <a @if(isset($adm_setting['landing_ios_download_link']))
                               href="{{$adm_setting['landing_ios_download_link']}}"
                               @else href="#" @endif>
                                <img alt="" src="{{asset('assets/user/images/btn-2.png')}}"> {{__('Apple Store')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="download-img wow fadeInRightSlow" data-wow-duration="1500ms">
                    <img alt="" src="{{asset('assets/user/images/download.png')}}">
                </div>
            </div>
        </div>
    </div>
    <div class="shape1 shape-n">
        <img alt="" src="{{asset('assets/user/images/shape/shape-3.png')}}">
    </div>
    <div class="shape2 shape-t">
        <img alt="" src="{{asset('assets/user/images/shape/shape-2.png')}}">
    </div>
    <div class="shape4">
        <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
    </div>
    <div class="shape5">
        <img alt="" src="{{asset('assets/user/images/shape/shape-3.png')}}">
    </div>
    <div class="shape6">
        <img alt="" src="{{asset('assets/user/images/shape/shape-2.png')}}">
    </div>
    <div class="shape7">
        <img alt="" src="{{asset('assets/user/images/shape/shape-4.png')}}">
    </div>
</div>
<!-- downloaded-area end-->

<!-- .footer-area start -->

<div class="footer-area">
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="footer-item">
                        <div class="footer-logo">
                            <a href="{{route('home')}}">
                                <img @if(!empty($adm_setting['logo'])) src ="{{ asset(path_image().$adm_setting['logo']) }}"
                                     @else src="{{asset('assets/user/images/logo.png')}}" @endif alt="">
                            </a>
                        </div>
                        <div class="footer-text">
                            <p>
                                @if(isset($adm_setting['landing_about_des']))
                                    {{str_limit($adm_setting['landing_about_des'], 200)}}
                                @else
                                    Lorem Ipsum is simply dummy text of the and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the  when an unknown.
                                @endif
                            </p>
                            <ul>
                                <li><a href="https://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-item">
                        <div class="footer-single">
                            <div class="footer-header">
                                <h2>Company</h2>
                            </div>
                            <ul>
                                <li><a href="#home">Home</a></li>
                                <li><a href="{{route('userSignUp')}}">Sign Up</a></li>
                                <li><a href="{{route('login')}}">Sign In</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="footer-item footer-item-2">
                        <div class="footer-single">
                            <div class="footer-header">
                                <h2>Support</h2>
                            </div>
                            <ul>
                                <li><a href="{{route('termsCondition')}}">Terms & Conditions</a></li>
                                <li><a href="{{route('privacyPolicy')}}">Privacy Policy</a></li>
                                <li><a href="#About">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="footer-item">
                        <div class="footer-single">
                            <div class="footer-header">
                                <h2>Links</h2>
                            </div>
                            <ul>
                                <li><a href="#features">Feature</a></li>
                                <li><a href="#work">How it works</a></li>
                                <li><a href="#downloaded">Download</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <span>
            @if(isset($adm_setting['copyright_text']))
                {{$adm_setting['copyright_text']}}
            @else
                2019 | All Right Reserved By Quizest
            @endif
        </span>
    </div>
</div>

<!-- .footer-area end -->

<!-- All JavaScript files
================================================== -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/easing-min.js')}}"></script>
<script src="{{asset('assets/js/jquery-sticky-menu.js')}}"></script>
<script src="{{asset('assets/js/wow.js')}}"></script>
<!-- Plugins for this template -->
<script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
<!-- Custom script for this template -->
<script src="{{asset('assets/js/script.js')}}"></script>
<script>
    new WOW().init();
</script>


</body>

</html>