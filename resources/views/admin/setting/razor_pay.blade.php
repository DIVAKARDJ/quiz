<div class="row mt-5">
    <div class="col-lg-6 razor_pay">
        <div class="form-group">
            <label>{{__('Api Key')}}</label>
            <input type="text" name="razorpay_api_key" value ="@if(isset($adm_setting['razorpay_api_key'])) {{ $adm_setting['razorpay_api_key'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6 razor_pay">
        <div class="form-group">
            <label>{{__('Razorpay App Name')}}</label>
            <input type="text" name="razorpay_api_app_name" value ="@if(isset($adm_setting['razorpay_api_app_name'])) {{ $adm_setting['razorpay_api_app_name'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6 razor_pay">
        <div class="form-group">
            <label>{{__('Description')}}</label>
            <input type="text" name="razorpay_api_app_description" value ="@if(isset($adm_setting['razorpay_api_app_description'])) {{ $adm_setting['razorpay_api_app_description'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
</div>