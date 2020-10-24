@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection


@section('main-body')
    <div class="account-area">
        <div class="row">
            <div class="col-md-1 offset-10">
                <div class="cmt-button pull-right back-button">
                    <a href="{{route('userDashboardView')}}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="pr-head">{{__('Referral System')}}</h2>
            <div class="profile-wrap leader-wrap">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="coin-select">
                            <input class="text-center" type="text" id="sharelink" value="{{url('/signup/'.$referral_code)}}" readonly/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4 text-center">
                        <div class="submit-btn-area">
                            <button onclick="copyText();"><i class="fa fa-link"></i> {{__('Copy Link')}}</button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4 text-center">
                        <div class="submit-btn-area">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/signup/'.$referral_code)}}" class="btn" target="_blank"><i class="fa fa-facebook-square"></i> {{__('Facebook Share')}}</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4 text-center">
                        <div class="submit-btn-area">
                            <a href="https://twitter.com/intent/tweet?url={{url('/signup/'.$referral_code)}}" class="btn" target="_blank"><i class="fa fa-twitter"></i> {{__('Twitter Share')}}</a>
                        </div>
                    </div>
                </div>
                <hr/>
                <h4 class="my-4">My Referral List</h4>
                <div class="leader-simple">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="referralList" class="table" cellspacing="0" width="100%" style="border-bottom: none!important;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: none!important;">{{__('Name')}}</th>
                                        <th style="border-bottom: none!important;">{{__('Email')}}</th>
                                        <th style="border-bottom: none!important;">{{__('Phone')}}</th>
                                        <th style="border-bottom: none!important;">{{__('Joined Date')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($referral_list[0]))
                                        @foreach($referral_list as $list)
                                            <tr>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->email}}</td>
                                                <td>{{$list->phone ?? ''}}</td>
                                                <td>{{date('d M y', strtotime($list->created_at))}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">{{__('No data found')}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <hr/>
                <h4 class="my-4">My Referral Earnings</h4>
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                @if (isset($all_settings['register_though_affiliate']) && $all_settings['register_though_affiliate'] != 0)
                                    <h6>{{__('Registration Through Affiliate')}}: {{$all_settings['register_though_affiliate']}} {{$all_settings['reward_system_as']}}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                @if (isset($all_settings['affiliate_owner_on_register']) && $all_settings['affiliate_owner_on_register'] != 0)
                                    <h6>{{__('When Referral Register')}}: {{$all_settings['affiliate_owner_on_register']}} {{$all_settings['reward_system_as']}}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                @if (isset($all_settings['affiliate_owner_on_purchase']) && $all_settings['affiliate_owner_on_purchase'] != 0)
                                    <h6>{{__('When Referral User purchase')}}: {{$all_settings['affiliate_owner_on_purchase']}} {{$all_settings['reward_system_as']}}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="leader-simple">
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="referralHistory" class="table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{__('Purpose')}}</th>
                                    <th>{{__('Commission')}}</th>
                                    <th>{{__('Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($point_histories[0]))
                                    @foreach($point_histories as $history)
                                        <tr>
                                            <td>{{ucfirst(str_replace('_'," ",$history->admin_setting_slug))}}</td>
                                            <td>{{$history->point}}</td>
                                            <td>{{date('d M y', strtotime($history->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{__('No data found')}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#referralList').DataTable();
            $('#referralHistory').DataTable();
        });
    </script>
    <script>
        function copyText() {
           document.getElementById("sharelink").select();
           document.execCommand('copy');
           $('#sharelink').css('color', 'green');
        }
    </script>
@endsection