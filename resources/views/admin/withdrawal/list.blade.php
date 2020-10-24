@extends('layout.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('left-sidebar')
    @include('layout.include.sidebar',['menu'=>'withdrawal'])
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
                        <h2>{{ isset($pageTitle) ? $pageTitle : 'Withdrawal List' }}</h2>
                        <div class="d-flex align-items-center">
                            <span class="sidebarToggler ml-4">
                                <i class="fa fa-bars d-lg-none d-block"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->
    @include('layout.message')
    <!-- Start content area  -->
    <div class="qz-content-area">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- <div class="table-responsive"> -->
                            <table id="category-table" class="table category-table table-bordered  text-center mb-0">
                                <thead>
                                <tr>
                                    <th class="all">{{__('SL.')}}</th>
                                    <th class="teblet">{{__('Name')}}</th>
                                    <th class="desktop">{{__('Point')}}</th>
                                    <th class="desktop">{{__('Withdrawal Method')}}</th>
                                    <th class="teblet">{{__('Status')}}</th>
                                    <th>{{__('Requested Date')}}</th>
                                    <th class="all">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($withdrawalLists[0]))
                                    @php ($sl = 1)
                                    @foreach($withdrawalLists as $item)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->point }}</td>
                                    <td>{{ $item->withdrawal_by }}</td>
                                    @if($item->status == 'Requested')
                                        <td><span class="badge badge-warning">{{ $item->status }}</span></td>
                                    @elseif($item->status == 'Declined')
                                        <td><span class="badge badge-danger">{{ $item->status }}</span></td>
                                    @else
                                        <td><span class="badge badge-success">{{ $item->status == 'Withdrawn' ? 'Delivered': $item->status}}</span></td>
                                    @endif
                                    <td>{{ date('d M y', strtotime($item->created_at)) }}</td>
                                    <td>
                                        <ul class="d-flex justify-content-center">
                                            <a href="{{url('withdrawal-details/'.$item->id)}}"  data-toggle="tooltip" class="modal-global" title="Details"><li class="qz-details"><span class="flaticon-pencil"></span></li></a>
                                            @if($item->status == 'Requested')
                                                <a href="{{url('withdrawal-approve/'.$item->id)}}" data-toggle="tooltip" title="Approve" class="approve">
                                                    <li class="ml-2 qz-check"><span class="flaticon-check-mark"></span></li>
                                                </a>
                                                <a href="{{url('withdrawal-decline/'.$item->id)}}" data-toggle="tooltip" title="Decline" class="decline">
                                                    <li class="ml-2 qz-close"><span class="flaticon-error"></span></li>
                                                </a>
                                            @elseif($item->status == 'Approved')
                                                <a href="{{url('withdraw/'.$item->id)}}" data-toggle="tooltip" title="Deliver" class="withdrawal">
                                                    <li class="ml-2 qz-deactive"><span class="flaticon-check-mark"></span></li>
                                                </a>
                                            @endif

                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalGlobal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Withdrawal Details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fa fa-3x fa-refresh fa-spin"></i>
                        <div>Please wait...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End content area  -->
@endsection

@section('script')
    <script>
        $('.modal-global').on('click',function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $('#modalGlobal').modal('show');
            makeAjaxGet(url).done(function (response) {
              $("#modalGlobal").find('.modal-body').html(response);
            });

        });

        $('.approve').on('click',function (e) {
            e.preventDefault();
            var approve_url = $(this).attr('href');
            swalConfirm("Do you really want to approve ?").then(function (s) {
                if (s.value){
                    makeAjaxGet(approve_url).done(function (response) {
                        var redirect_url = "{{Request::url()}}";
                        if (response.success == true){
                            swalRedirect(redirect_url,response.message,'success');
                        }else{
                            swalRedirect(redirect_url,response.message,'error');
                        }

                    });
                }

            });
        });

        $('.decline').on('click',function (e) {
            e.preventDefault();
            var decline_url = $(this).attr('href');
            swalConfirm("Do you really want to decline ?").then(function (s) {
                if (s.value){
                    makeAjaxGet(decline_url).done(function (response) {
                        var redirect_url = "{{Request::url()}}";
                        if (response['success'] == true){
                            console.log('Working');
                            swalRedirect(redirect_url,response.message,'success');
                        }else{
                            swalRedirect(redirect_url,response.message,'error');
                        }
                    });
                }
            });
        });
        $('.withdrawal').on('click',function (e) {
            e.preventDefault();
            var decline_url = $(this).attr('href');
            swalConfirm("Do you really want to withdraw ?").then(function (s) {
                if (s.value){
                    makeAjaxGet(decline_url).done(function (response) {
                        var redirect_url = "{{Request::url()}}";
                        if (response.success == true){
                            swalRedirect(redirect_url,response.message,'success');
                        }else{
                            swalRedirect(redirect_url,response.message,'error');
                        }
                    });
                }
            });
        });

    </script>

@endsection