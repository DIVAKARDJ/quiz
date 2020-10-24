<div class="col-lg-12 tabcontent mt-5" id="London">
    {{ Form::open(['route' => 'saveSettings', 'files' => 'true']) }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('App Title')}}</label>
                <input type="text" name="app_title" value ="@if(isset($adm_setting['app_title'])) {{ $adm_setting['app_title'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Language')}}</label>
                <div class="qz-question-category">
                    <select name="lang" class="form-control">
                        @foreach(language() as $val)
                            <option @if(isset($adm_setting['lang']) && $adm_setting['lang']==$val) selected @endif value="{{$val}}">{{langName($val)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Company name')}}</label>
                <input type="text" name="company_name" value ="@if(isset($adm_setting['company_name'])) {{ $adm_setting['company_name'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Coin for hints')}}</label>
                <input type="text" name="hints_coin" value ="@if(isset($adm_setting['hints_coin'])) {{ $adm_setting['hints_coin'] }} @endif" class="form-control number-only no-regx" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Coin for 50/50 answer')}}</label>
                <input type="text" name="fifty_fifty_answer" value ="@if(isset($adm_setting['fifty_fifty_answer'])) {{ $adm_setting['fifty_fifty_answer'] }} @endif" class="form-control number-only no-regx" placeholder="0">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Ad Mob Coin')}}</label>
                <input type="text" name="admob_coin" value ="@if(isset($adm_setting['admob_coin'])) {{ $adm_setting['admob_coin'] }} @endif" class="form-control number-only no-regx" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Sign up Reward Coin')}}</label>
                <input type="text" name="signup_coin" value ="@if(isset($adm_setting['signup_coin'])) {{ $adm_setting['signup_coin'] }} @endif" class="form-control number-only no-regx" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('User Registration')}}</label>
                <div class="qz-question-category">
                    <select name="user_registration" class="form-control">
                        <option @if(isset($adm_setting['user_registration']) && $adm_setting['user_registration']== 1) selected @endif value="1">{{__('Enable')}}</option>
                        <option @if(isset($adm_setting['user_registration']) && $adm_setting['user_registration']== 2) selected @endif value="2">{{__('Disable')}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Primary Email')}}</label>
                <input type="text" name="primary_email" value ="@if(isset($adm_setting['primary_email'])) {{ $adm_setting['primary_email'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Login Text')}}</label>
                <input type="text" name="login_text" value ="@if(isset($adm_setting['login_text'])) {{ $adm_setting['login_text'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Sign Up Text')}}</label>
                <input type="text" name="signup_text" value ="@if(isset($adm_setting['signup_text'])) {{ $adm_setting['signup_text'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>{{__('Copyright Text')}}</label>
                <input type="text" name="copyright_text" value ="@if(isset($adm_setting['copyright_text'])) {{ $adm_setting['copyright_text'] }} @endif" class="form-control" placeholder="">
            </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
        </div>
    </div>
    {{ Form::close() }}
</div>