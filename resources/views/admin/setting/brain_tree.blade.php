<div class="row mt-5">
    <div class="col-lg-6 brain_tree">
        <div class="form-group"><label>{{__('Braintree Mode')}}</label>
            <select name="braintree_mode" id="" class="form-control">
                <option value="sandbox" @if(isset($adm_setting['braintree_mode']) && ($adm_setting['braintree_mode'] == 'sandbox'))
                selected  @endif >{{__("Sandbox")}}</option>
                <option value="production" @if(isset($adm_setting['braintree_mode']) && ($adm_setting['braintree_mode'] == 'production'))
                selected  @endif >{{__("Production")}}</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 brain_tree">
        <div class="form-group">
            <label>{{__('Braintree Merchant Id')}}</label>
            <input type="text" name="braintree_marchant_id" value ="@if(isset($adm_setting['braintree_marchant_id'])) {{ $adm_setting['braintree_marchant_id'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6 brain_tree">
        <div class="form-group">
            <label>{{__('Braintree Public Key')}}</label>
            <input type="text" name="braintree_public_key" value ="@if(isset($adm_setting['braintree_public_key'])) {{ $adm_setting['braintree_public_key'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6 brain_tree">
        <div class="form-group">
            <label>{{__('Braintree Private Key')}}</label>
            <input type="text" name="braintree_private_key" value ="@if(isset($adm_setting['braintree_private_key'])) {{ $adm_setting['braintree_private_key'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-lg-6 brain_tree">
        <div class="form-group">
            <label>{{__('Braintree Client Token')}}</label>
            <input type="text" name="braintree_client_token" value ="@if(isset($adm_setting['braintree_client_token'])) {{ $adm_setting['braintree_client_token'] }} @endif" class="form-control" placeholder="">
        </div>
    </div>
</div>