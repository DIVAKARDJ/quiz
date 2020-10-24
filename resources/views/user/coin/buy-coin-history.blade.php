@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('main-body')
    <!-- leader-board start -->
    <div class="account-area">
        <div class="row">
            <div class="col-md-1 offset-10">
                <div class="cmt-button pull-right back-button">
                    <a href="{{route('userDashboardView')}}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="pr-head">@if (isset($pageTitle)) {{ $pageTitle }} @endif</h2>
            <div class="profile-wrap leader-wrap">
                <div class="leader-simple">
                    <div class="row">
                        <div class="col-lg-12">

                            <table id="dtBasicExample" class="table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>{{__('Coin Name')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Price Rate')}}</th>
                                    <th>{{__('Payment method')}}</th>
                                    <th>{{__('Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($items[0]))
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{isset($item->coin->name) ? $item->coin->name : ''}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{isset($item->payment->name) ? $item->payment->name : ''}}</td>
                                            <td>{{date('d M y', strtotime($item->created_at))}}</td>
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
    <!-- leader-board end -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
        });
    </script>


@endsection