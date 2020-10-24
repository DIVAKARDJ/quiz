<div class="row mt-5">
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{__('Merchant Id')}}</label>
            <input type="text" name="payu_merchant_id" value ="@if(isset($adm_setting['payu_merchant_id'])) {{ $adm_setting['payu_merchant_id'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{__('Merchant Key')}}</label>
            <input type="text" name="payu_merchant_key" value ="@if(isset($adm_setting['payu_merchant_key'])) {{ $adm_setting['payu_merchant_key'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{__('PayU Salt')}}</label>
            <input type="text" name="payu_salt" value ="@if(isset($adm_setting['payu_salt'])) {{ $adm_setting['payu_salt'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>{{__('Description')}}</label>
            <input type="text" name="payu_description" value ="@if(isset($adm_setting['payu_description'])) {{ $adm_setting['payu_description'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
</div>