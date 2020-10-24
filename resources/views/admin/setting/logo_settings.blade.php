<div class="col-lg-12 tabcontent mt-5" id="Paris">
    {{ Form::open(['route' => 'saveSettings', 'files' => 'true']) }}
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>{{__('Company logo')}}</label>
                <div id="file-upload" class="section">
                    <div class="row section">
                        <div class="col s12 m12 l12">
                            <input name="logo" type="file" id="input-file-now" class="dropify"
                                   data-default-file="{{isset($adm_setting['logo']) && !empty($adm_setting['logo']) ? asset(path_image().$adm_setting['logo']) : ''}}" />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="app_title" value ="@if(isset($adm_setting['app_title'])) {{ $adm_setting['app_title'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-3 offset-1">
            <div class="form-group">
                <label>{{__('Login logo')}}</label>
                <div id="file-upload" class="section">
                    <div class="row section">
                        <div class="col s12 m12 l12">
                            <input name="login_logo" type="file" id="input-file-now" class="dropify"
                                   data-default-file="{{isset($adm_setting['login_logo']) && !empty($adm_setting['login_logo']) ? asset(path_image().$adm_setting['login_logo']) : ''}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 offset-1">
            <div class="form-group">
                <label>{{__('Fevicon')}}</label>
                <div id="file-upload" class="section">
                    <div class="row section">
                        <div class="col s12 m12 l12">
                            <input name="favicon" type="file" id="input-file-now" class="dropify"
                                   data-default-file="{{isset($adm_setting['favicon']) && !empty($adm_setting['favicon']) ? asset(path_image().$adm_setting['favicon']) : ''}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
        </div>
    </div>
    {{ Form::close() }}
</div>