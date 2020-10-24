{{Form::open(['route'=>'buyCoinByPayU', 'id'=> 'payu-form'])}}
    <div class="coin-select">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <label>{{__('Coin Amount')}} <span class="text-danger">*</span></label>
                <input type="number" placeholder="10 Test Coin" name="amount" id="">
                <input type="hidden" name="coin_price" id="coin_price" value="{{$coin->price}}" >
                <input type="hidden" value="{{$coin->id}}" name="coin_id" id="">
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

{{Form::close()}}
