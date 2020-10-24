@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('main-body')
<!-- category-area start-->
<div class="category-area">
    <div class="container">
        <div class="category-wrap">
            <div class="row">
                <div class="col-lg-4">
                    <div class="category-tab-list">
                        <ul class="nav nav-tabs">
                            @if(isset($categories[0]))
                                @foreach($categories as $item)
                                    <li>
                                        <a @if($category->id == $item->id) class="active" @endif
                                            @if(check_category_unlock($item->id, $item->coin) == 1) onclick='open_modal("{{$item->id}}","{{$item->coin}}","{{$item->name}}");'
                                            @else href="{{route('categoryData', encrypt($item->id))}}" @endif >
                                            <img @if(!empty($item->image)) src="{{asset(path_category_image().$item->image)}}" @else
                                            src="{{asset('assets/user/images/category/img-6.png')}}" @endif  alt="">
                                            @if(check_category_unlock($item->id, $item->coin) == 1)
                                                <span class="pull-right">
                                                    <img src="{{asset('assets/user/images/category/img-10.png')}}" alt="">
                                                </span>
                                            @endif
                                            {{$item->name}} ({{count_question($item->id)}})
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                                <li><a class="br-b"></a></li>
                                <li><a class="br-b"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content">
                        <div id="Science" class="tab-pane active">
                            <div class="category-sub-area category-sub-area-p">
                                @if(isset($subCategories[0]))
                                    <div class="row">
                                        @php $in = 1 @endphp
                                        @foreach($subCategories as $item)
                                            <div class="col-lg-3 col-sm-6 col-12">
                                                <a @if(check_category_unlock($item->id, $item->coin) == 1)
                                                   onclick='open_modal("{{$item->id}}","{{$item->coin}}","{{$item->name}}");'
                                                   @else href="{{route('categoryData', encrypt($item->id))}}" @endif>
                                                    <div class="category-single @if($in == 1) category-single-7 @elseif($in == 2) category-single-3
                                                             @elseif($in == 3) category-single-4 @elseif($in == 4) category-single-5 @elseif($in == 5) category-single-6
                                                                  @elseif($in == 6) category-single-7 @elseif($in == 12) category-single-8
                                                                @elseif($in == 7) category-single-8  @elseif($in == 11) category-single-10 @elseif($in == 8) category-single-10
                                                                @elseif($in == 9) category-single-6 @elseif($in == 10) category-single-8 @else category-single-2 @endif">
                                                        <div class="category-img">
                                                            <img @if(!empty($item->white_image)) src="{{asset(path_category_image().$item->white_image)}}" @else
                                                            src="{{asset('assets/user/images/category/sub/img-1.png')}}" @endif  alt="">
                                                        </div>
                                                        <div class="category-text">
                                                            <h2>{{$item->name}} ({{count_question($item->id)}})</h2>
                                                        </div>
                                                        @if(check_category_unlock($item->id, $item->coin) == 1)
                                                            <div class="lock">
                                                                <span><img src="{{asset('assets/user/images/category/img-11.png')}}" alt=""></span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            @php $in++ @endphp
                                        @endforeach
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="text-danger text-center">{{__('No data found')}}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- category-area end-->

<!-- Modal area start -->
<div class="modal fade show" id="UnlockModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{Form::open(['route' => ['categoryUnlock'], 'files' => true])}}
            <div class="modal-body">
                <div class="unlock-area">
                    <h2>{{__('Unlock')}} <span class="cat-name"></span></h2>
                    <div class="unlock-box">
                        <div class="unloack-header">
                            <ul>
                                <li>{{__('You have total coin')}} :</li>
                                <li>@if(isset(Auth::user()->userCoin->coin)) {{ Auth::user()->userCoin->coin }} @else 0 @endif</li>
                            </ul>
                        </div>
                        <div class="unlock-body">
                            <p>{{__('To unlock “')}}  <span class="cat-name"></span> {{__('” Category')}}</p>
                            <span><img src="{{asset('assets/user/images/category/img-12.png')}}" alt=""> <span id="cat-coin"></span></span>
                            <input type="hidden" id="cat-id" name="category_id">
                        </div>
                    </div>
                </div>
            </div>
            <div class="unlock-btn">
                <button type="submit" >{{__('Unlock')}}</button>
                <button type="button" class="close btn-cl" data-dismiss="modal" aria-label="Close">{{__('Cancel')}}</button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<!-- Modal area start -->

@endsection

@section('script')
    <script>
        function open_modal(id, coin, name)
        {
            $('#UnlockModal').modal('show');
            $('.cat-name').text(name);
            $('#cat-coin').text(coin);
            $('#cat-id').val(id);
        };
    </script>
@endsection