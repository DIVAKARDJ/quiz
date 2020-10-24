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
            <div class="profile-wrap">
                <div class="row">
                        <div class="col-lg-6 offset-3">
                            <h2 class="pr-head pr-head-w">{{__('Change Password')}}</h2>
                            {{ Form::open(['route' => 'changePassword', 'files' => 'true']) }}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="profile-content">
                                        <div class="pro-onfo">
                                            <span>{{__('Old Password')}}</span>
                                            <input  type="password" name="old_password" placeholder="{{__('Old Password')}}">
                                            <span class="text-danger"><strong>{{ $errors->first('old_password') }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="profile-content">
                                        <div class="pro-onfo">
                                            <span>{{__('New Password')}}</span>
                                            <input type="password" name="password" placeholder="{{__('New Password')}}">
                                            <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="profile-content">
                                        <div class="pro-onfo">
                                            <span>{{__('Confirm Password')}}</span>
                                            <input type="password" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                                            <span class="text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="unlock-btn question-btn pro-edit-btn pro-edit-btn-2 mt-4">
                                <button type="submit" class="btn-qu">{{__('Update')}}</button>
                            </div>
                            {{Form::close()}}
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection