@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('main-body')
    <div class="account-area">
        <div class="row">
            <div class="col-md-1 offset-10">
                <div class="cmt-button pull-right back-button">
                    <a href="{{route('userDashboardView')}}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
        @if(isset($coin))
            <div class="container">
            <h2 class="pr-head">{{__('Buy Coin')}}</h2>
            <div class="coin-wrap">
                <div class="coin-top">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="coin-header">
                                <ul>
                                    <li><span>1</span> {{$coin->name}}</li>
                                    <li>=</li>
                                    <li><span>{{$coin->price}}</span> USD</li>
                                </ul>
                            </div>
                            <h4 class="text-center text-success"><b>{{__('Availabe Coin : ')}} {{$coin->amount - $coin->sold_amount}}</b></h4>
                        </div>
                    </div>
                </div>
                <div class="coin-bottom">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="coin-sub">
                                <h2>{{__('Buy Our Coin From Here')}}</h2>
                                <div class="payment-select mb-3">
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
                                <div class="brain_tree">
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

                                    <div class="payment-name"  id="open3" style="display: none">
                                        <div class="row">
                                            <div class="col-md-8 offset-2" id="brain">
                                                <section>
                                                    <div class="bt-drop-in-wrapper">
                                                        <div id="bt-dropin"></div>
                                                    </div>
                                                </section>

                                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                                <input type="hidden" name="pay_method_id" id="methodIdFormBrain">
                                                <input type="hidden" name="payment_id" id="payment_id">
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
                                </div>
                                <div class="razor_pay" style="display: none">
                                    @include('user.coin.buy_coin_by_razor_pay')
                                </div>
                                <div class="payu_pay" style="display: none">
                                    @include('user.coin.buy_coin_by_payu')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center text-danger">{{__('No coin found')}}</p>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
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

    </script>
    <script>
        function show1(){
            document.getElementById('open3').style.display ='none';
        }
        function show2(){
            document.getElementById('open3').style.display = 'block';
        }
        $(".payment-radio").click(function(){

            show2();
            var val = $("input[name='payment_id']:checked").val();

            if (val == 2) {
                $('.brain_tree').show();
                $('.razor_pay').hide();
                $('#payment_id').val(val);

                $("#brain").show();
                $("[data-braintree-id='choose-a-way-to-pay']").hide();
                $("[data-braintree-id='toggle']").hide();
                $("[class='braintree-option braintree-option__card']").trigger("click");
                $("[data-braintree-id='toggle']").click(function() {
                    $("[name='back']").trigger("click");
                });

            } else if (val == 1) {
                $('.brain_tree').show();
                $('.razor_pay').hide();
                $('.payu_pay').hide();
                $('#payment_id').val(val);
                $("#brain").show();
                $("[data-braintree-id='choose-a-way-to-pay']").hide();
                $("[class='braintree-option braintree-option__paypal']").trigger("click");
                $("[data-braintree-id='toggle']").click(function() {
                    $("[name='back']").trigger("click");
                });
            } else if (val ==3){
                $('.brain_tree').hide();
                $('.payu_pay').hide();
                $('.razor_pay').show();
            }else if (val ==4){
                $('.brain_tree').hide();
                $('.razor_pay').hide();
                $('.payu_pay').show();
            }else {
                $("#open3").hide();
            }

        });
    </script>
@endsection