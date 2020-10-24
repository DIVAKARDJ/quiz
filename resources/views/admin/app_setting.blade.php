@extends('layout.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('left-sidebar')
    @include('layout.include.sidebar')
@endsection

@section('header')
    @include('layout.include.header')
@endsection

@section('main-body')
    <!-- Start page title -->
    <div class="qz-page-title">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>{{__('Application Settings')}}</h2>
                        <span class="sidebarToggler">
                            <i class="fa fa-bars d-lg-none d-block"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->
    @include('layout.message')
    <!-- Start content area  -->
    <div class="qz-content-area">
        <div class="card add-category">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 v-tab">
                            <div class="tab">
                                @if(isset($adm_setting['is_authenticated']) && ($adm_setting['is_authenticated'] == LICENSE_VERIFIED))
                                    <button class="tablinks" onclick="openCity(event, 'Referrals')" id="defaultOpen">{{__('Referrals')}}</button>
                                    <button class="tablinks" onclick="openCity(event, 'Withdrawal')" id="">{{__('Withdrawal')}}</button>
                                    <button class="tablinks" onclick="openCity(event, 'Reward')" id="">{{__('Reward')}} </button>
                                @else
                                    <button class="tablinks" onclick="openCity(event, 'License')" id="defaultOpen">{{__('License')}}</button>
                                @endif
                            </div>
                        </div>
                        @if(isset($adm_setting['is_authenticated']) && ($adm_setting['is_authenticated'] == LICENSE_VERIFIED))
                            <div class="col-lg-12 tabcontent mt-5" id="Referrals">
                                <form method="POST" action="{{route('app-settings-save')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>{{__('Referral Reward System as:')}}</label>
                                                <div class="qz-question-category">
                                                    <select name="reward_system_as" class="form-control">
                                                        <option @if(isset($adm_setting['reward_system_as']) && $adm_setting['reward_system_as']=='Point') selected @endif value="Point">{{__('Point')}}</option>
                                                        <option @if(isset($adm_setting['reward_system_as']) && $adm_setting['reward_system_as']=='Coin') selected @endif value="Coin">{{__('Coin')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>{{__('Registration Through Affiliate')}}</label>
                                                <input type="text" name="register_though_affiliate" value ="@if(isset($adm_setting['register_though_affiliate'])) {{ $adm_setting['register_though_affiliate'] }} @else 0 @endif" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>{{__('Affiliate Owner On Register')}}</label>
                                                <input type="text" name="affiliate_owner_on_register" value ="@if(isset($adm_setting['affiliate_owner_on_register'])) {{ $adm_setting['affiliate_owner_on_register'] }} @else 0 @endif" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>{{__('Affiliate Owner On purchase')}}</label>
                                                <input type="text" name="affiliate_owner_on_purchase" value ="@if(isset($adm_setting['affiliate_owner_on_purchase'])) {{ $adm_setting['affiliate_owner_on_purchase'] }} @else 0 @endif" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 tabcontent mt-5" id="Withdrawal">
                                <form method="POST" action="{{route('app-settings-save')}}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{__('Point Amount per USD')}}</label>
                                                <input type="text" name="point_amount_per_unit" value ="@if(isset($adm_setting['point_amount_per_unit'])) {{ $adm_setting['point_amount_per_unit'] }} @endif" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>{{__('Minimum Point Redemption Amount')}}</label>
                                                <input type="text" name="minimum_point_to_withdrawal" value ="@if(isset($adm_setting['minimum_point_to_withdrawal'])) {{ $adm_setting['minimum_point_to_withdrawal'] }} @endif" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>{{__('withdrawal Choice')}}</label>
                                                <div class="qz-question-category">
                                                    <select name="withdrawal_choice" class="form-control">
                                                        <option @if(isset($adm_setting['withdrawal_choice']) && $adm_setting['withdrawal_choice']== 1) selected @endif value="1">{{__('Enable')}}</option>
                                                        <option @if(isset($adm_setting['withdrawal_choice']) && $adm_setting['withdrawal_choice']== 0) selected @endif value="0">{{__('Disable')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 tabcontent mt-5" id="Reward">
                                <form method="POST" action="{{route('app-settings-save')}}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('Reward System as:')}}</label>
                                            <div class="qz-question-category">
                                                <select name="reward_system_as" class="form-control">
                                                    <option @if(isset($adm_setting['reward_system_as']) && $adm_setting['reward_system_as'] == 'Point') selected @endif value="Point">{{__('Point')}}</option>
                                                    <option @if(isset($adm_setting['reward_system_as']) && $adm_setting['reward_system_as'] == 'Coin') selected @endif value="Coin">{{__('Coin')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('Daily Login Reward')}}</label>
                                            <div class="qz-question-category">
                                                <select name="daily_login_reward" class="form-control">
                                                    <option @if(isset($adm_setting['daily_login_reward']) && $adm_setting['daily_login_reward']== 1) selected @endif value="1">{{__('Enable')}}</option>
                                                    <option @if(isset($adm_setting['daily_login_reward']) && $adm_setting['daily_login_reward']== 0) selected @endif value="0">{{__('Disable')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('Daily Login Reward Amount')}}</label>
                                            <input type="text" name="daily_login_reward_amount" value ="@if(isset($adm_setting['daily_login_reward_amount'])) {{ $adm_setting['daily_login_reward_amount'] }} @else 0 @endif" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('On Registration Get')}}</label>
                                            <input type="text" name="on_registration_reward" value ="@if(isset($adm_setting['on_registration_reward'])) {{ $adm_setting['on_registration_reward'] }} @else 0 @endif" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('On Purchase Get')}}</label>
                                            <input type="text" name="on_purchase_reward" value ="@if(isset($adm_setting['on_purchase_reward'])) {{ $adm_setting['on_purchase_reward'] }} @else 0 @endif" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('Daily Topper Reward Amount')}}</label>
                                            <input type="text" name="daily_topper_reward_amount" value ="@if(isset($adm_setting['daily_topper_reward_amount'])) {{ $adm_setting['daily_topper_reward_amount'] }} @else 0 @endif" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('Weekly Topper Reward Amount')}}</label>
                                            <input type="text" name="weekly_topper_reward_amount" value ="@if(isset($adm_setting['weekly_topper_reward_amount'])) {{ $adm_setting['weekly_topper_reward_amount'] }} @else 0 @endif" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>{{__('Monthly Topper Reward Amount')}}</label>
                                            <input type="text" name="monthly_topper_reward_amount" value ="@if(isset($adm_setting['monthly_topper_reward_amount'])) {{ $adm_setting['monthly_topper_reward_amount'] }} @else 0 @endif" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                    </div>
                                </div>
                                </form>
                            </div>

                        @else
                            <div class="col-lg-12 tabcontent mt-5" id="License">
                                {{ Form::open(['route' => 'verifyEnvatoCode', 'files' => 'true']) }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Purchase Code')}}</label>
                                            <input type="text" name="purchase_code" value ="" class="form-control" placeholder="{{__('Purchase Code')}}">
                                            <span class="text-danger"><strong>{{ $errors->first('purchase_code') }}</strong></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Varify License')}}</button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End content area  -->
@endsection
@section('script')
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
@endsection