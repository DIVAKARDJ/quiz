<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\CoinBuyRequest;
use App\Model\Coin;
use App\Model\PaymentMethods;
use App\Model\Sell;
use App\Model\UserCoin;
use App\Services\CoinService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Softon\Indipay\Facades\Indipay;

class CoinController extends Controller
{
    //buy coin page
    public function buyCoin()
    {
        $data['pageTitle'] = __('Buy Coin');
        $data['coin'] = Coin::where(['status'=> STATUS_ACTIVE, 'is_active' => STATUS_ACTIVE])->first();
        $data['items'] = PaymentMethods::where(['status'=> STATUS_ACTIVE])->get();
        $data['all_settings'] = allsetting();

        return view('user.coin.buy-coin', $data);
    }

    // buy coin process

    public function buyCoinProcess(CoinBuyRequest $request)
    {
        $response = app(CoinService::class)->buyCoinProcess($request);
        if ($response['success'] == true) {
            return redirect()->route('buyCoinHistory')->with('success', $response['message']);
        } else {
            return redirect()->back()->with('dismiss', $response['message']);
        }
    }
    
    public function buyCoinByRazorPay(Request $request)
    {
        $response = app(CoinService::class)->buyCoinProcess($request);
        if ($response['success'] == true) {
            return response()->json($response);
        } else {
           return response()->json($response);
        }
    }

    // buy coin history

    public function buyCoinHistory()
    {
        $data['pageTitle'] = __('Buy Coin History');
        $data['items'] = Sell::where(['user_id'=> Auth::user()->id])->orderBy('created_at','desc')->get();

        return view('user.coin.buy-coin-history', $data);
    }
   
   //PayUmoney Payment
   public function buyCoinByPayU(Request $request){
       
      $userDetails = Auth::user();
      $price = $request->amount*$request->coin_price*convertCurrency(1,'USD', 'INR');
      config('indipay.payumoney.merchantKey',allsetting('payu_merchant_key'));
      config('indipay.payumoney.salt',allsetting('payu_salt'));
      if(!empty($request->amount)){
         $parameters = [
            'amount' => $price,
            'firstname' => $userDetails->id,
            'email' => $userDetails->email,
            'phone' => $userDetails->phone ?? '09876543210',
            'productinfo' => 'Buy Coin',
            'curl' => url('indipay/response'),
         ];
         // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
         $order = Indipay::gateway('PayUMoney')->prepare($parameters);
         return Indipay::process($order);
      }else{
         return redirect()->back()->with('dismiss', 'Ops something is wrong!');
      }
   }
   public function payuMoneyResponse(Request $request)
   {
      // For default Gateway
      $response = Indipay::response($request);
      // For Otherthan Default Gateway
      $coinPrice = Coin::where(['status'=> STATUS_ACTIVE, 'is_active' => STATUS_ACTIVE])->first();
      $response = Indipay::gateway('PayUMoney')->response($request);
      $CurentCoinPrice = $coinPrice->price;
      $TotalCoin = ($response['amount']/$CurentCoinPrice/convertCurrency(1,'USD', 'INR'));
      if($response['status'] == "success"){
         $data = [
            'user_id' => $response['firstname'],
            'coin' => $TotalCoin,
            'status' => 1,
         ];
         $getCoin = UserCoin::where(['user_id' => $response['firstname']])->get();
         $UserCoin = ($getCoin[0]->coin + $TotalCoin);
         $UserId = $getCoin[0]->user_id;
         if (!empty($UserId)) {
            UserCoin::where(['user_id' => $UserId])->update(['coin' => $UserCoin]);
         } else {
            UserCoin::create($data);
         }
         $data2 = [
            'coin_id' => $coinPrice->id,
            'user_id' => $response['firstname'],
            'payment_id' => 4,
            'amount' => $TotalCoin,
            'price' => $CurentCoinPrice,
            'status' => 1,
         ];
         Sell::create($data2);
         return redirect()->route('buyCoinHistory')->with('success', 'Added Successfully!');
      }
      return redirect()->back()->with('error', 'Invalid Request');
   }
    
}
