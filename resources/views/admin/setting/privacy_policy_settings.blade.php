<div class="col-lg-12 tabcontent mt-5" id="Privacy">
    {{ Form::open(['route' => 'saveSettings', 'files' => 'true']) }}
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>{{__('Privacy and Policy')}}</label>
                <input type="hidden" name="app_title" value ="@if(isset($adm_setting['app_title'])) {{ $adm_setting['app_title'] }} @endif" class="form-control" placeholder="">
                <textarea id="btEditor" name="privacy_policy">@if(isset($adm_setting['privacy_policy'])){{$adm_setting['privacy_policy']}}@else{{old('privacy_policy')}}@endif</textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>{{__('Terms and Conditions')}}</label>
                <textarea id="btEditor2" name="terms_conditions">@if(isset($adm_setting['terms_conditions'])) {{$adm_setting['terms_conditions']}} @else {{old('terms_conditions')}} @endif</textarea>
            </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
        </div>
    </div>
    {{ Form::close() }}
</div>