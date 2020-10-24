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
                        <h2>{{__('General Settings')}}</h2>
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
                                    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">{{__('General')}}</button>
                                    <button class="tablinks" onclick="openCity(event, 'Paris')">{{__('Logo')}} </button>
                                    <button class="tablinks" onclick="openCity(event, 'Payment')">{{__('Payment')}}</button>
                                    <button class="tablinks" onclick="openCity(event, 'Privacy')">{{__('Privacy Policy')}}</button>
                                @else
                                    <button class="tablinks" onclick="openCity(event, 'License')" id="defaultOpen">{{__('License')}}</button>
                                @endif
                            </div>

                        </div>

                        @if(isset($adm_setting['is_authenticated']) && ($adm_setting['is_authenticated'] == LICENSE_VERIFIED))
                            @include('admin.setting.general_settings')
                            @include('admin.setting.logo_settings')
                            @include('admin.setting.payment_settings')
                            @include('admin.setting.privacy_policy_settings')
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