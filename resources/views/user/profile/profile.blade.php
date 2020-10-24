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
                                        <h4>{{\App\Services\PointService::getUserPoints()}}</h4>
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
                            <div class="profile-item-header">
                                <ul>
                                    <li>{{__('Personal Information')}}</li>
                                    <li><a href="{{route('editProfile')}}">{{__('Edit')}}</a></li>
                                </ul>
                            </div>
                            <div class="profile-content">
                                <div class="pro-onfo">
                                    <span>{{__('Name')}}</span>
                                    <p>{{$user->name}}</p>
                                </div>
                            </div>
                            <div class="profile-content">
                                <div class="pro-onfo">
                                    <span>{{__('Email')}}</span>
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>
                            <div class="profile-content">
                                <div class="pro-onfo">
                                    <span>{{__('Country')}}</span>
                                    <p>{{$user->country}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pro-chart">
                <div class="row">
                    <div class="col-12">
                        <div class="view-pro">
                            <h2>{{__('Progress Chart')}}</h2>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ctx = document.getElementById('myChart').getContext("2d");

        var gradientStroke = ctx.createLinearGradient(87,125, 249, .5);
        gradientStroke.addColorStop(0, '#3865F6');
        gradientStroke.addColorStop(1, 'rgba(87,125, 249, .5)');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Dec","Nov","Oct","Sep","Aug","Jul", "Jun", "May", "Apr", "Mar", "Feb", "Jan"],
                datasets: [{
                    label: "Score",
                    borderColor: gradientStroke,
                    pointRadius: 0,
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderWidth: 1,
                    data: {!! json_encode($monthly_score) !!}
                }]
            },
            options: {
                legend: {
                    position: "bottom"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "#575757",
                            fontStyle: "bold",
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: true,
                            display: true
                        }

                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "#575757",
                            fontStyle: "bold"
                        }
                    }]
                }
            }
        });
    </script>
@endsection