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
            <h2 class="pr-head">{{__('My Rewards')}}</h2>
            <div class="profile-wrap leader-wrap">
                <div class="leader-simple">
                    <h4 class="text-center text-success mb-5"><b>{{__('Availabe Points : ')}} {{$balance_point ?? 0}}</b></h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mb-4">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (isset($all_settings['daily_login_reward_amount']) && $all_settings['daily_login_reward_amount'] != 0)
                                                <h6>{{__('Daily Login Reward')}}: {{$all_settings['daily_login_reward_amount']}} {{$all_settings['reward_system_as']}}</h6>
                                            @endif
                                            @if (isset($all_settings['on_registration_reward']) && $all_settings['on_registration_reward'] != 0)
                                                <h6>{{__('Registration Bonus')}}: {{$all_settings['on_registration_reward']}} {{$all_settings['reward_system_as']}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (isset($all_settings['on_purchase_reward']) && $all_settings['on_purchase_reward'] != 0)
                                                <h6>{{__('Purchase Bonus')}}: {{$all_settings['on_purchase_reward']}} {{$all_settings['reward_system_as']}}</h6>
                                            @endif
                                            @if (isset($all_settings['daily_topper_reward_amount']) && $all_settings['daily_topper_reward_amount'] != 0)
                                                <h6>{{__('Daily Topper Reward')}}: {{$all_settings['daily_topper_reward_amount']}} {{$all_settings['reward_system_as']}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            @if (isset($all_settings['weekly_topper_reward_amount']) && $all_settings['weekly_topper_reward_amount'] != 0)
                                                <h6>{{__('Weekly Topper Reward')}}: {{$all_settings['weekly_topper_reward_amount']}} {{$all_settings['reward_system_as']}}</h6>
                                            @endif
                                            @if (isset($all_settings['monthly_topper_reward_amount']) && $all_settings['monthly_topper_reward_amount'] != 0)
                                                <h6>{{__('Monthly Topper Reward')}}: {{$all_settings['monthly_topper_reward_amount']}} {{$all_settings['reward_system_as']}}</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table id="dtBasicExample" class="table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th style="text-align: left">{{__('Event')}}</th>
                                    <th>{{__('Time')}}</th>
                                    <th>{{__('Reward')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($rewards))
                                    @foreach($rewards as $reward)
                                        <tr>
                                            <td style="text-align: left">{{ ucfirst(str_replace('_'," ",$reward->admin_setting_slug)) }}</td>
                                            <td>{{date('d M y', strtotime($reward->created_at))}}</td>
                                            <td>{{$reward->point}}</td>
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
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrapper text-center">
                            <ul class="page-numbers">
                                @if(isset($rewards[0])) {{ $rewards->links() }} @endif
                            </ul>
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
            $('#dtBasicExample').DataTable();
        });
    </script>

@endsection