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
                        <h2>@if (isset($pageTitle)) {{ $pageTitle }} @endif</h2>
                        <span class="sidebarToggler">
                            <i class="fa fa-bars d-lg-none d-block"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->
    @include('layout.message')
    <!-- Start content area  -->
    <div class="qz-content-area">
        <div class="card add-category">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 v-tab">
                            <div class="tab">
                                <button class="tablinks" onclick="openCity(event, 'FeatureList')" id="defaultOpen">{{__('Features')}}</button>
                                <button class="tablinks" onclick="openCity(event, 'Feature')" id="">{{__('Landing Feature')}}</button>
                                <button class="tablinks" onclick="openCity(event, 'London')" id="">{{__('Landing Banner')}}</button>
                                <button class="tablinks" onclick="openCity(event, 'Paris')">{{__('About Us')}} </button>
                                <button class="tablinks" onclick="openCity(event, 'Payment')">{{__('How Works')}}</button>
                                <button class="tablinks" onclick="openCity(event, 'Privacy')">{{__('Download')}}</button>
                            </div>

                        </div>
                        <div class="col-lg-12 tabcontent mt-5" id="FeatureList">
                            <div class="qz-page-title">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h2>{{__('Feature List')}}</h2>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('addWebFeature')}}" class="btn btn-primary px-3">{{__('Add New')}}</a>
                                                    <span class="sidebarToggler ml-4">
                                                        <i class="fa fa-bars d-lg-none d-block"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table id="category-table" class="table category-table table-bordered  text-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="all">{{__('SL.')}}</th>
                                            <th class="teblet">{{__('Image')}}</th>
                                            <th class="teblet">{{__('Feature Title')}}</th>
                                            <th class="teblet">{{__('Status')}}</th>
                                            <th class="all">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($items[0]))
                                            @php ($sl = 1)
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td class="table-image"><img src="{{ $item->image }}" alt=""></td>
                                                    <td>{{ $item->title }}</td>
                                                    <td><span @if($item->status == STATUS_ACTIVE) class="text-success" @else class="text-danger" @endif>{{ statusType($item->status) }}</span></td>
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <a href="{{ route('editWebFeature', encrypt($item->id)) }}" data-toggle="tooltip" title="Edit"><li class=" ml-2 qz-edit"><span class="flaticon-pencil"></span></li></a>
                                                            <a href="{{ route('featureDelete', encrypt($item->id)) }}" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure to delete this ?');"><li class="ml-2 qz-close"><span class="flaticon-error"></span></li></a>
                                                        </ul>
                                                    </td>
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
                        <div class="col-lg-12 tabcontent mt-5" id="Feature">
                            {{ Form::open(['route' => 'webSettingSaveProcess', 'files' => 'true']) }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Landing Feature Title')}}</label>
                                            <input type="text" name="landing_feature_title" value ="@if(isset($adm_setting['landing_feature_title'])) {{ $adm_setting['landing_feature_title'] }} @endif"
                                                   class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Landing Feature Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_feature_des">@if(isset($adm_setting['landing_feature_des'])){{$adm_setting['landing_feature_des']}}@else{{old('landing_feature_des')}}@endif</textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-lg-12 tabcontent mt-5" id="London">
                            {{ Form::open(['route' => 'webSettingSaveProcess', 'files' => 'true']) }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Landing Banner Title')}}</label>
                                            <input type="text" name="landing_banner_title" value ="@if(isset($adm_setting['landing_banner_title'])) {{ $adm_setting['landing_banner_title'] }} @endif"
                                                   class="form-control" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>{{__('Landing Banner Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_banner_des">@if(isset($adm_setting['landing_banner_des'])){{$adm_setting['landing_banner_des']}}@else{{old('landing_banner_des')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Landing Banner Image')}}</label>
                                            <div id="file-upload" class="section">
                                                <div class="row section">
                                                    <div class="col s12 m12 l12">
                                                        <input name="landing_banner_image" type="file" id="input-file-now" class="dropify"
                                                               data-default-file="{{isset($adm_setting['landing_banner_image']) && !empty($adm_setting['landing_banner_image']) ?
                                                                asset(path_image().$adm_setting['landing_banner_image']) : ''}}" />
                                                    </div>
                                                    <span class="text-danger"><strong>{{ $errors->first('landing_banner_image') }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-lg-12 tabcontent mt-5" id="Paris">
                            {{ Form::open(['route' => 'webSettingSaveProcess', 'files' => 'true']) }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('Landing About Title')}}</label>
                                        <input type="text" name="landing_about_title" value ="@if(isset($adm_setting['landing_about_title'])) {{ $adm_setting['landing_about_title'] }} @endif"
                                               class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Landing About Description')}}</label>
                                        <textarea id="" rows="3" cols="" class="form-control" name="landing_about_des">@if(isset($adm_setting['landing_about_des'])){{$adm_setting['landing_about_des']}}@else{{old('landing_about_des')}}@endif</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__('Landing About Image')}}</label>
                                        <div id="file-upload" class="section">
                                            <div class="row section">
                                                <div class="col s12 m12 l12">
                                                    <input name="landing_about_image" type="file" id="input-file-now" class="dropify"
                                                           data-default-file="{{isset($adm_setting['landing_about_image']) && !empty($adm_setting['landing_about_image']) ?
                                                                asset(path_image().$adm_setting['landing_about_image']) : ''}}" />
                                                </div>
                                                <span class="text-danger"><strong>{{ $errors->first('landing_about_image') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-lg-12 tabcontent mt-5" id="Payment">
                            {{ Form::open(['route' => 'webSettingSaveProcess', 'files' => 'true']) }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Work Process Title')}}</label>
                                            <input type="text" name="work_process_title" value ="@if(isset($adm_setting['work_process_title'])) {{ $adm_setting['work_process_title'] }} @endif"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Work Process Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_work_des">@if(isset($adm_setting['landing_work_des'])){{$adm_setting['landing_work_des']}}@else{{old('landing_work_des')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Create Account Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_work_step1">@if(isset($adm_setting['landing_work_step1'])){{$adm_setting['landing_work_step1']}}@else{{old('landing_work_step1')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Sign in Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_work_step2">@if(isset($adm_setting['landing_work_step2'])){{$adm_setting['landing_work_step2']}}@else{{old('landing_work_step2')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Category Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_work_step3">@if(isset($adm_setting['landing_work_step3'])){{$adm_setting['landing_work_step3']}}@else{{old('landing_work_step3')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Start Play Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_work_step4">@if(isset($adm_setting['landing_work_step4'])){{$adm_setting['landing_work_step4']}}@else{{old('landing_work_step4')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-lg-12 tabcontent mt-5" id="Privacy">
                            {{ Form::open(['route' => 'webSettingSaveProcess', 'files' => 'true']) }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Download Title')}}</label>
                                            <input type="text" name="landing_download_title" value ="@if(isset($adm_setting['landing_download_title'])) {{ $adm_setting['landing_download_title'] }} @endif"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Android App Download Link')}}</label>
                                            <input type="text" name="landing_app_download_link" value ="@if(isset($adm_setting['landing_app_download_link'])) {{ $adm_setting['landing_app_download_link'] }} @endif"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Ios App Download Link')}}</label>
                                            <input type="text" name="landing_ios_download_link" value ="@if(isset($adm_setting['landing_ios_download_link'])) {{ $adm_setting['landing_ios_download_link'] }} @endif"
                                                   class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>{{__('Download Description')}}</label>
                                            <textarea id="" rows="3" cols="" class="form-control" name="landing_download_des">@if(isset($adm_setting['landing_download_des'])){{$adm_setting['landing_download_des']}}@else{{old('landing_download_des')}}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>{{__('Landing Download Image')}}</label>
                                            <div id="file-upload" class="section">
                                                <div class="row section">
                                                    <div class="col s12 m12 l12">
                                                        <input name="landing_download_image" type="file" id="input-file-now" class="dropify"
                                                               data-default-file="{{isset($adm_setting['landing_download_image']) && !empty($adm_setting['landing_download_image']) ?
                                                                asset(path_image().$adm_setting['landing_download_image']) : ''}}" />
                                                    </div>
                                                    <span class="text-danger"><strong>{{ $errors->first('landing_download_image') }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
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
    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
@endsection