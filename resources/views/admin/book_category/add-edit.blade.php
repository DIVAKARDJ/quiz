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
                        <h2>{{ isset($pageTitle) ? $pageTitle : '' }}</h2>
                        <span class="sidebarToggler">
                            <i class="fa fa-bars d-lg-none d-block"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->
    @include('layout.message_new')
    <!-- Start content area  -->
    <div class="qz-content-area">
        <div class="card add-category">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::open(['route' => 'saveBookCategory', 'files' => 'true']) }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label>{{__('Book Category Name')}}<span class="text-danger">*</span></label>
                                        <input type="text" name="name"
                                               @if(isset($bookCategory)) value="{{$bookCategory->name}}"
                                               @else value="{{old('name')}}" @endif class="form-control"
                                               placeholder="Book Category Name">
                                        <span class="text-danger"><strong>{{ $errors->first('name') }}</strong></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('Activation Status')}}</label>
                                        <div class="qz-question-category">
                                            <select name="status" class="form-control">
                                                @foreach(active_statuses() as $key => $value)
                                                    <option @if(isset($question) && ($question->status == $key)) selected
                                                            @elseif((old('status') != null) && (old('status') == $key)) @endif value="{{ $key }}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('Image')}}</label><span class="text-danger">*</span>
                                        <div id="file-upload" class="section">
                                            <!--Default version-->
                                            <div class="row section">
                                                <div class="col s12 m12 l12">
                                                    <input name="image" type="file" id="input-file-now" class="dropify"
                                                           data-default-file="{{isset($bookCategory) && !empty($bookCategory->image) ? asset(path_book_category_image().$bookCategory->image) : ''}}"/>
                                                </div>
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="text-danger">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                        @endif
                                        <!--Default value-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    @if(isset($bookCategory))
                                        <input type="hidden" name="edit_id" value="{{$bookCategory->id}}">
                                    @endif
                                    <button type="submit" class="btn btn-primary btn-block add-category-btn">
                                        @if(isset($bookCategory)) {{__('Update')}} @else {{__('Add New')}} @endif
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
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
