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
                                <form action="https://www.example.com/payment/success/" method="POST">
                                    <input type="hidden" custom="Hidden Element" name="hidden">
                                </form>
                            </div>
                            <button id="rzp-button1">Pay</button>

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
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var totalAmount = 5000;
        var product_id =  1;
        var key = "{{allsetting('razorpay_api_key')}}";
        var name = "{{allsetting('razorpay_api_app_name')}}";
        var description = "{{allsetting('razorpay_api_app_description')}}";
        var options = {
            "key": key,
            "amount": (totalAmount*100),
            "name": name,
            "description": description,
            // "image": "https://www.w3adda.com/wp-content/uploads/2019/07/w3a-fb-dp.png",
            "handler": function (response){
                $.ajax({
                    url: "{{url('pay-success')}}",
                    type: 'post',
                    headers: { 'X-CSRF-Token' : "{{csrf_token()}}" },
                    dataType: 'json',
                    data: {
                        razorpay_payment_id: response.razorpay_payment_id ,
                        totalAmount : totalAmount,product_id:product_id
                    },
                    success: function (msg) {
                        console.log(msg);
                    }
                });

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
        document.getElementById('rzp-button1').onclick = function(e) {
            rzp1.open();
            e.preventDefault();
        }
    </script>

@endsection