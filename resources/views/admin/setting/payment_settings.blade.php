<div class="col-lg-12 tabcontent mt-5" id="Payment">
    <div class="row ">
        <div class="col-md-12">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="brainTree" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="brainTree">Brain Tree</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="razorPay" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="razorPay">Razor Pay</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="payU" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="payU">PayU</label>
            </div>
        </div>
    </div>
    {{ Form::open(['route' => 'savePaymentSettings', 'files' => 'true']) }}
        <div class="brain_tree">
            @include('admin.setting.brain_tree')
        </div>

        <div class="razor_pay" style="display: none">
            @include('admin.setting.razor_pay')
        </div>
        <div class="payu_money" style="display: none">
            @include('admin.setting.payu')
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary btn-block add-category-btn mt-4">{{__('Save Change')}}</button>
        </div>
    </div>
    {{ Form::close() }}
</div>
<script>
    $(document).ready(function () {
        $('#brainTree').prop('checked',true);
        $('input[type=radio]').on('change', function() {
            var id = $(this).attr('id');
            if (id == 'brainTree'){
                $('.brain_tree').show();
                $('.razor_pay').hide();
                $('.payu_money').hide();
            }else if (id == 'razorPay') {
                $('.brain_tree').hide();
                $('.payu_money').hide();
                $('.razor_pay').show();
            }else if (id == 'payU'){
                console.log(id);
                $('.brain_tree').hide();
                $('.razor_pay').hide();
                $('.payu_money').show();
            }
        });
    });
</script>