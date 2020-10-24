@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('main-body')
    <div class="profile-area">
        <div class="row">
            <div class="col-md-1 offset-10">
                <div class="cmt-button pull-right back-button">
                    <a href="{{route('userDashboardView')}}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="pr-head">{{__('My profile')}}</h2>
            <div class="profile-wrap">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="profile-left">
                            <div class="row">
                                <div class="col-12">
                                    <div class="pro-details">
                                        <div class="pro-img">
                                            <img @if(isset($user->photo)) src="{{ asset(pathUserImage().$user->photo)}}"
                                                 @else src="{{asset('assets/images/avater.jpg')}}" @endif alt="" class="">
                                        </div>
                                        <div class="pro-text">
                                            <h2>{{$user->name}}</h2>
                                            <span>{{$user->email}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6">
                                    <div class="pro-item">
                                        <h4>{{calculate_score($user->id)}}</h4>
                                        <span>{{__('Total Point')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6">
                                    <div class="pro-item pro-item-2">
                                        <h4>{{calculate_ranking($user->id)}}</h4>
                                        <span>{{__('Ranking')}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6">
                                    <div class="pro-item pro-item-3">
                                        <h4>@if(isset($user->userCoin->coin)) {{ $user->userCoin->coin }} @else 0 @endif</h4>
                                        <span>{{__('Coin')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="profile-item">
                            <div class="profile-item-header profile-item-header-2">
                                <ul>
                                    <li>{{__('Edit Information')}}</li>
                                </ul>
                            </div>
                            {{ Form::open(['route' => 'updateProfile', 'files' => 'true']) }}
                            <div class="profile-content">
                                <div class="pro-onfo">
                                    <span>{{__('Name')}}</span>
                                    <input name="name" type="text" placeholder="Name" value="{{$user->name}}">
                                    <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                </div>
                            </div>
                            <div class="profile-content">
                                <div class="pro-onfo">
                                    <span>{{__('Email')}}</span>
                                    <p class="form-control span-email">{{$user->email}}</p>
                                </div>
                            </div>
                            <div class="profile-content">
                                <div class="pro-onfo">
                                    <span>{{__('Country')}}</span>
                                    <input name="country" type="text" placeholder="Country" value="{{$user->country}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-content profile-content-edit">
                                        <div class="pro-onfo">
                                            <span>{{__('Profile Image')}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="file-upload" class="section">
                                            <div class="row section">
                                                <div class="col s12 m12 l12">
                                                    <input name="photo" type="file" id="input-file-now" class="dropify"
                                                           data-default-file="{{isset($user) && !empty($user->photo) ? asset(pathUserImage().$user->photo) : ''}}" />
                                                </div>
                                            </div>
                                            <span class="text-danger"><strong>{{ $errors->first('photo') }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="unlock-btn question-btn pro-edit-btn  mt-4">
                                <button type="submit" class="btn-qu">{{__('Update')}}</button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection