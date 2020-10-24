<!-- start page-loader -->
<div class="page-loader">
    <div class="page-loader-inner">
        <div class="inner"></div>
    </div>
</div>
<!-- end page-loader -->
<!-- header-area start -->
<header>
    <div class="header-area header-area-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                    <div class="logo">
                        <a href="{{route('userDashboardView')}}"><img src="{{asset('assets/user/images/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="header-search">
                        {{--<form>--}}
                        {{--<div class="input">--}}
                        {{--<input type="email" class="form-control" placeholder="Enter  For Search" required>--}}
                        {{--</div>--}}
                        {{--<div class="submit clearfix">--}}
                        {{--<button type="submit"><i class="ti-search"></i></button>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="header-profile profile-menu">
                        <ul>
                            <li>
                                <a href="#">{{Auth::user()->name}} <i class="ti-angle-down"></i>
                                    <img class="profile-menu-img" @if(!empty(Auth::user()->photo)) src ="{{asset(pathUserImage().Auth::user()->photo)}}" @else
                                    src="{{asset('assets/user/images/profile.png')}}" @endif alt="">
                                </a>
                                <ul class="submenu">
                                    <li class="active"><a href="{{route('userProfile')}}"><img src="{{asset('assets/user/images/header/img-1.png')}}" alt="">{{__('My Profile')}}</a></li>
                                    <li><a href="{{route('passwordChange')}}"><img src="{{asset('assets/user/images/header/img-2.png')}}" alt="">{{__('Change Password')}}</a></li>
                                    <li><a href="{{route('leaderBoards')}}"><img src="{{asset('assets/user/images/header/img-3.png')}}" alt="">{{__('Leader Board')}}</a></li>
                                    <li><a href="{{route('rewardSystem')}}"><i class="fa fa-graduation-cap"></i>{{__('Reward System')}}</a></li>
                                    <li><a href="{{route('buyCoin')}}"><img src="{{asset('assets/user/images/header/img-4.png')}}" alt="">{{__('Buy Coin')}}</a></li>
                                    @if(allsetting('withdrawal_choice') && allsetting('withdrawal_choice') == 1)
                                    <li><a href="{{route('withdrawalSystem')}}"><i class="fa fa-money"></i>{{__('Withdrawal system')}}</a></li>
                                    @endif
                                    <li><a href="{{route('buyCoinHistory')}}"><img src="{{asset('assets/user/images/header/img-5.png')}}" alt="">{{__('Buy Coin History')}}</a></li>
                                    <li><a href="{{route('referralSystem')}}"><i class="fa fa-link"></i> {{__('Referral System')}}</a></li>
                                    <li><a href="{{route('logOut')}}"><img src="{{asset('assets/user/images/header/logout.svg')}}" alt="">{{__('Logout')}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area end -->