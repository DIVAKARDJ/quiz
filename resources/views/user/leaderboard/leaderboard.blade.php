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
            <h2 class="pr-head">{{__('Leader Board')}}</h2>
            <div class="profile-wrap-2 leader-wrap">
                <div class="row">
                    <div class="col-12">
                        <div class="user-header">
                            <ul class="nav nav-tabs">
                                <li><a class="active" data-toggle="tab" href="#All">{{__('All Users')}}</a></li>
                                <li><a data-toggle="tab" href="#Top">{{__('Weekly Top Users')}}</a></li>
                                <li><a data-toggle="tab" href="#Daily">{{__('Daily Top Users')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="All" class="tab-pane active">
                        <div class="leader-wrap">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table-responsive">
                                        <thead>
                                        <tr>
                                            <th>{{__('User')}}</th>
                                            <th>{{__('Score')}}</th>
                                            <th>{{__('Rank')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($all_leaders[0]))
                                            @php $i=1 @endphp
                                            @foreach($all_leaders as $item)
                                                <tr>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <img @if(!empty($item->photo)) src="{{ asset(pathUserImage().$item->photo)}}"
                                                                     @else src="{{asset('assets/images/avater.jpg')}}" @endif alt="">
                                                            </li>
                                                            <li>{{$item->name ?? ''}}</li>
                                                        </ul>
                                                    </td>
                                                    <td>{{$item->point}}</td>
                                                    <td class="color-1">{{$i}}</td>
                                                </tr>
                                                @php $i++ @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3"><span class="text-danger">{{__('No data found')}}</span></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="pagination-wrapper text-center">
                                        <ul class="page-numbers">
                                            @if(isset($all_leaders[0])) {{ $all_leaders->links() }} @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Top" class="tab-pane">
                        <div class="leader-wrap">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table-responsive">
                                        <thead>
                                        <tr>
                                            <th>{{__('User')}}</th>
                                            <th>{{__('Score')}}</th>
                                            <th>{{__('Rank')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($weekly_leaders[0]))
                                            @php $i=1 @endphp
                                            @foreach($weekly_leaders as $item)
                                                <tr>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <img @if(!empty($item->user->photo)) src="{{ asset(pathUserImage().$item->user->photo)}}"
                                                                     @else src="{{asset('assets/images/avater.jpg')}}" @endif alt="">
                                                            </li>
                                                            <li>{{$item->user->name}}</li>
                                                        </ul>
                                                    </td>
                                                    <td>{{$item->score}}</td>
                                                    <td class="color-1">{{$i}}</td>
                                                </tr>
                                                @php $i++ @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3"><span class="text-danger">{{__('No data found')}}</span></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="pagination-wrapper text-center">
                                        <ul class="page-numbers">
                                            @if(isset($weekly_leaders[0])) {{ $weekly_leaders->links() }} @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="Daily" class="tab-pane">
                        <div class="leader-wrap">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table-responsive">
                                        <thead>
                                        <tr>
                                            <th>{{__('User')}}</th>
                                            <th>{{__('Score')}}</th>
                                            <th>{{__('Rank')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($today_leaders[0]))
                                            @php $i=1 @endphp
                                            @foreach($today_leaders as $item)
                                                <tr>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <img @if(!empty($item->user->photo)) src="{{ asset(pathUserImage().$item->user->photo)}}"
                                                                     @else src="{{asset('assets/images/avater.jpg')}}" @endif alt="">
                                                            </li>
                                                            <li>{{$item->user->name}}</li>
                                                        </ul>
                                                    </td>
                                                    <td>{{$item->score}}</td>
                                                    <td class="color-1">{{$i}}</td>
                                                </tr>
                                                @php $i++ @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3"><span class="text-danger">{{__('No data found')}}</span></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12">
                                    <div class="pagination-wrapper text-center">
                                        <ul class="page-numbers">
                                            @if(isset($today_leaders[0])) {{ $today_leaders->links() }} @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection