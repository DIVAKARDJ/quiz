@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection
@if(session()->has('question_list.0'))
    @php $qId = session('question_list.0.id'); @endphp
    @php $index = 0; @endphp
@endif
@section('main-body')
    <!-- Chemistry area start-->
    <div class="chemistry">
        <div class="container">
            <div class="chemistry-wrap">
                <div class="cmt-button">
                    <a href="{{route('userDashboardView')}}">{{__('Back')}}</a>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="chemistry-item">
                            <h2>{{__('In')}} {{$category->name}} {{__('Category')}}</h2>
                            <ul>
                                <li>{{__('Total Question')}} <span>{{isset($total_question) ? $total_question : 0}}</span></li>
                                <li>{{__('Total Point')}} <span>{{isset($total_point) ? $total_point : 0}}</span></li>
                                <li>{{__('Total Coin')}} <span>{{isset($total_coin) ? $total_coin : 0}}</span></li>
                            </ul>
                        </div>
                        <div class="unlock-btn">
                            @if(isset($index))
                                <a href="{{route('singleQuestion',[$index,$qId])}}">
                                    <button type="button" >{{__("Let’s Start")}}</button>
                                </a>
                            @endif
                            <a href="{{route('userDashboardView')}}">
                                <button type="button" class="btn-cl">{{__('Cancel')}}</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chemistry area end-->
@endsection

@section('script')
@endsection