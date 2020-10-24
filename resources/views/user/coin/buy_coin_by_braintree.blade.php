{{Form::open(['route'=>'buyCoinProcess', 'id'=> 'payment-form'])}}
<div class="coin-select">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <label>{{__('Coin Amount')}} <span class="text-danger">*</span></label>
            <input type="hidden" value="{{$coin->id}}" name="coin_id">
            <input type="text" placeholder="10 Test Coin" name="amount">
            <pre class="text-danger">{{$errors->first('amount')}}</pre>
        </div>
    </div>
</div>
<div class="payment-select">
    <h4>{{__('Payment Type')}}<span class="text-danger">*</span></h4>
    <ul>
        @if(isset($items[0]))
            @foreach($items as $p_method)
                <li>
                    <input class="payment-radio" type="radio" name="payment_id"  value="{{$p_method->id}}">
                    <label for="a">{{$p_method->name}}</label>
                </li>
            @endforeach
        @else
            <li><p>{{__('No method found')}}</p></li>
        @endif
    </ul>
    <p class="text-danger">{{$errors->first('payment_id')}}</p>
</div>
<div class="payment-name"  id="open3">
    <div class="row">
        <div class="col-md-8 offset-2" id="brain" hidden>
            <section>
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <input type="hidden" name="pay_method_id" id="methodIdFormBrain">
        </div>
    </div>
</div>
<pre class="text-danger">{{$errors->first('payment_method_nonce')}}</pre>
<div class="coin-select coin-select-2">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <div class="submit-btn-area">
                <button type="submit">{{__('Buy Coin')}}</button>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}

<script>
    function show1(){
        document.getElementById('open3').style.display ='none';
    }
    function show2(){
        document.getElementById('open3').style.display = 'block';
    }

    var form = document.querySelector('#payment-form');
    var client_token = "{{isset($all_settings['braintree_client_token']) ? $all_settings['braintree_client_token'] : ''}}";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        paypal: {
            flow: 'vault'
        }
    }, function (createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }
// Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });

    $(".payment-radio").click(function(){

        var val = $("input[name='payment_id']:checked").val();
        show2();
        if (val == 2) {

            $("#brain").removeAttr("hidden");
            $("#brain").show();
            $("[data-braintree-id='choose-a-way-to-pay']").hide();
            $("[data-braintree-id='toggle']").hide();
            $("[class='braintree-option braintree-option__card']").trigger("click");
            $("[data-braintree-id='toggle']").click(function() {
                $("[name='back']").trigger("click");
            });

        } else if (val == 1) {

            $("#brain").removeAttr("hidden");
            $("#brain").show();
            $("[data-braintree-id='choose-a-way-to-pay']").hide();
            $("[class='braintree-option braintree-option__paypal']").trigger("click");
            $("[data-braintree-id='toggle']").click(function() {
                $("[name='back']").trigger("click");
            });
        } else {
            $("#open3").hide();
        }

    });
</script>