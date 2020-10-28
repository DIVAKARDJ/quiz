<div class="coin-select">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <label>{{__('Coin Amount')}} <span class="text-danger">*</span></label>
            <input type="hidden" value="{{$coin->id}}" name="coin_id" id="razor_coin_id">
            <input type="hidden" value="{{\App\Model\PaymentMethods::where(['id' => 3,'status'=>1])->first()->id ?? ''}}" name="payment_id" id="razor_payment_id">
            <input type="number" placeholder="10 Test Coin" name="amount" id="razor_amount_id">
            <input type="hidden" name="coin_price" id="coin_price" value="{{$coin->price}}" >
            <pre class="text-danger" id="error_text"></pre>
        </div>
    </div>
</div>
<div class="coin-select coin-select-2">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="submit-btn-area">
                <button type="submit" id="rzp-button1">{{__('Buy Coin')}}</button>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('rzp-button1').onclick = function(e) {
        var totalCoin = $('#razor_amount_id').val();
        var indianRupee = "{{convertCurrency(1,'USD', 'INR')}}";
        var coinPrice = $('#coin_price').val();
        var amount = totalCoin*coinPrice*indianRupee;
        console.log(amount);
        if (amount){
            var coin_id =  $('#razor_coin_id').val();
            var payment_id =  $('#razor_payment_id').val();
            var key = "{{allsetting('razorpay_api_key')}}";
            var name = "{{allsetting('razorpay_api_app_name')}}";
            var description = "{{allsetting('razorpay_api_app_description')}}";
            var options = {
                "key": key,
                "amount": (amount*100),
                "name": name,
                "description": description,
                // "image": "https://www.w3adda.com/wp-content/uploads/2019/07/w3a-fb-dp.png",
                "handler": function (response){
                    $.ajax({
                        url: "{{url('buy-coin-by-razorpay')}}",
                        type: 'post',
                        headers: { 'X-CSRF-Token' : "{{csrf_token()}}" },
                        dataType: 'json',
                        data: {
                            type: 'razor-pay',
                            payment_id: payment_id,
                            amount : amount,
                            coin_id : coin_id
                        },
                        success: function (response) {

                        }
                    });

                    if (typeof response.razorpay_payment_id == 'undefined' ||  response.razorpay_payment_id < 1) {
                        var redirect_url = "{{Request::url()}}";
                    } else {
                        var redirect_url = "{{url('buy-coin-history')}}";
                    }
                    location.href = redirect_url;
                },
                "prefill": {
                    "contact": '',
                    "email":   '',
                },
                "theme": {
                    "color": "#528FF0"
                }
            }
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        }else{
            var data = 'Amount can\'t be empty!';
            $('#error_text').hide().html(data).fadeIn('slow').delay(3000).hide(1);
        }
    }
</script>
