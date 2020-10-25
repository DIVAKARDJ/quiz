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
                        <h2>{{ isset($pageTitle) ? $pageTitle : 'Book Category' }}</h2>
                        <div class="d-flex align-items-center">
                            <a href="{{route('addBookCategory')}}" class="btn btn-primary px-3">{{__('Add New')}}</a>
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
                                    <th class="teblet">Image</th>
                                    <th class="teblet">{{__('Status')}}</th>
                                    <th class="all">{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(isset($bookCategory[0]))
                                    @php ($sl = 1)
                                    @foreach($bookCategory as $item)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if($item->image)
                                                <img class="datatable-img"
                                                     src="{{ asset(path_book_category_image().$item->image) }}"
                                                     alt="no image"/>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td><span @if($item->status == 1) class="text-success"
                                                      @else class="text-danger" @endif>{{ statusType($item->status) }}</span>
                                            </td>
                                            <td>
                                                <ul class="d-flex justify-content-center">
                                                    <a href="{{ route('editBookCategory', $item->id) }}"
                                                       data-toggle="tooltip" title="User Details">
                                                        <li class="qz-details"><span class="flaticon-pencil"></span>
                                                        </li>
                                                    </a>
                                                    <a href="{{ route('editBookCategory', encrypt($item->id)) }}"
                                                       data-toggle="tooltip" title="Edit">
                                                        <li class=" ml-2 qz-edit"><span class="flaticon-pencil"></span>
                                                        </li>
                                                    </a>
                                                    @if($item->status == STATUS_INACTIVE)
                                                        <a href="{{ route('bookCategoryChangeStatus', $item->id) }}" data-toggle="tooltip" title="Activate">
                                                            <li class="ml-2 qz-deactive"><span class="flaticon-check-mark"></span></li>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('bookCategoryChangeStatus', $item->id) }}" data-toggle="tooltip" title="Dectivate">
                                                            <li class="ml-2 qz-check"><span class="flaticon-check-mark"></span></li>
                                                        </a>
                                                    @endif
                                                    <a href="{{ route('deleteBookCategegory', $item->id) }}"
                                                       data-toggle="tooltip" title="Delete"
                                                       onclick="return confirm('Are you sure to delete this ?');">
                                                        <li class="ml-2 qz-close"><span
                                                                    class="flaticon-error"></span></li>
                                                    </a>
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
    <!-- End content area  -->
@endsection

@section('script')
@endsection
