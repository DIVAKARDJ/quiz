<?php

namespace App\Services;

use App\Model\Coin;
use App\Model\Sell;
use App\Model\UserCoin;
use App\User;
use Braintree_Configuration;
use Braintree_Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CoinService
{
    protected $logger;

    public function __construct()
    {
        $this->logger = app(Logger::class);
    }

    //save coin

    public function coinSave($request)
    {
        try {
            $response['success'] = false;
            $response['message'] = __('Invalid Request');
            $data = [
                'name' => $request->name,
                'amount' => $request->amount,
                'price' => $request->price,
            ];
            if ($data) {
                if (!empty($request->edit_id)) {
                    $coin = Coin::where('id', $request->edit_id)->first();
                    if($coin) {
                        $update = $coin->update($data);
                        if ($update) {
                            $response = [
                                'success' => true,
                                'message' => __('Coin updated successfully')
                            ];
                        }
                    }
                } else {
                    Coin::create($data);
                    $response = [
                        'success' => true,
                        'message' => __('New coin created successfully')
                    ];
                }
            } else {
                $response['success'] = false;
                $response['message'] = __('Operation failed');
            }
        } catch(\Exception $e) {
            $response['success'] = false;
            $response['message'] = __('Something went wrong');

        }

        return $response;
    }

    // coin buy process
    public function buyCoinProcess($request)
    {
        $response = ['success' => false,'message' => __('Invalid Request')];
        DB::beginTransaction();
        try {
           if (isset($request->coin_id) && !empty($request->coin_id)){
              $coin = Coin::where(['id'=> $request->coin_id, 'status'=> STATUS_ACTIVE, 'is_active'=> STATUS_ACTIVE])->first();
              
           }else{
              $coin = Coin::where(['status'=> STATUS_ACTIVE, 'is_active' => STATUS_ACTIVE])->first();
           }
           if (isset($coin)) {
              if ($coin->amount >= ($coin->sold_amount + $request->amount)) {
                 if (isset($request->type) && $request->type == 'razor-pay'){
                    $sellReport = $this->razorPayPayuSellReport($request,$coin);
                 }if (isset($request->type) && $request->type == 'payu'){
                    $sellReport = $this->razorPayPayuSellReport($request,$coin);
                 }else{
                    $sellReport = $this->addSellReport($request,$coin);
                 }
         
                 if ($sellReport) {
                    $response['success'] = $sellReport['success'];
                    $response['message'] = $sellReport['message'];
                 }
              } else {
                 $response['success'] = false;
                 $response['message'] = __('Insufficient coin amount.');
              }
      
           } else {
              $response['success'] = false;
              $response['message'] = __('Coin not found.');
           }
           DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $response['success'] = false;
            $response['message'] = $e->getMessage();

            return $response;
        }
        
        return $response;
    }

    // create payment charge
    public function createPaymentCharge($request, $coin)
    {
        $response = ['success' => false, 'message' => __('Something went wrong !')];
        try {
            if (isset($request->payment_method_nonce) && isset($coin)) {
                $nonce = $request->payment_method_nonce;

                $allSetting = allsetting();
                Braintree_Configuration::environment(isset($allSetting['braintree_mode']) ? $allSetting['braintree_mode'] : env('BRAINTREE_ENV'));
                Braintree_Configuration::merchantId(isset($allSetting['braintree_marchant_id']) ? $allSetting['braintree_marchant_id'] : env('BRAINTREE_MERCHANT_ID'));
                Braintree_Configuration::publicKey(isset($allSetting['braintree_public_key']) ? $allSetting['braintree_public_key'] : env('BRAINTREE_PUBLIC_KEY'));
                Braintree_Configuration::privateKey(isset($allSetting['braintree_private_key']) ? $allSetting['braintree_private_key'] : env('BRAINTREE_PRIVATE_KEY'));

                $status = Braintree_Transaction::sale([
                    'amount' => $coin->price * $request->amount,
                    'paymentMethodNonce' => $nonce,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);
//                $response = ['success' => true, 'message' => __('Payment successful.')];
                if (isset($status) && $status->success == true) {
                    $response = ['success' => true, 'message' => __('Buy coin successfully.')];
                } else {
                    $response = ['success' => false, 'message' => __('Payment failed.')];
                }
            } else {
                $response = ['success' => false, 'message' => __('Invalid request!')];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            return $response;
        }

        return $response;
    }

    // create sell report

    public function addSellReport($request, $coin)
    {
        $response = ['success' => false, 'message' => __('Something went wrong !')];
        DB::beginTransaction();
        try {
            if (isset($request) && isset($coin)) {
                $userCoinWallet = UserCoin::where(['user_id' => Auth::user()->id])->first();
                if(isset($userCoinWallet)) {
                    $coin->increment('sold_amount', $request->amount);
                    $userCoinWallet->increment('coin', $request->amount);

                    $sellReport = Sell::create(['coin_id'=> $coin->id, 'user_id'=>Auth::user()->id,
                        'payment_id'=> $request->payment_id, 'amount'=>$request->amount, 'price'=> $coin->price]);
                    
                    $payment = $this->createPaymentCharge($request, $coin);

                    if (isset($payment) && $payment['success'] == true) {
                        $response = ['success' => true, 'message' => $payment['message']];
                    } else {
                        DB::rollBack();
                        $response = ['success' => false, 'message' => $payment['message']];
                    }
                } else {
                    $response = ['success' => false, 'message' => __('User coin wallet not found.')];
                }

            } else {
                $response = ['success' => false, 'message' => __('Invalid request!')];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
            return $response;
        }

        DB::commit();
        return $response;
    }
    
    public function razorPayPayuSellReport($request, $coin)
    {
        $response = ['success' => false, 'message' => __('Something went wrong !')];
        DB::beginTransaction();
        try {
           if (isset($request) && isset($coin)) {
              $userCoinWallet = UserCoin::where(['user_id' => Auth::user()->id])->first();
              if(isset($userCoinWallet)) {
                 $coin->increment('sold_amount', $request->amount);
                 $userCoinWallet->increment('coin', $request->amount);
         
                 $sellReport = Sell::create(['coin_id'=> $coin->id, 'user_id'=>Auth::user()->id,
                                             'payment_id'=> $request->payment_id, 'amount'=>$request->amount, 'price'=> $coin->price]);
         
                 if ($sellReport) {
                    $response = ['success' => true, 'message' => __('Payment successful.')];
                 } else {
                    $response = ['success' => false, 'message' => __('Payment Failed!')];
                 }
              } else {
                 $response = ['success' => false, 'message' => __('User coin wallet not found.')];
              }
              
           } else {
              $response = ['success' => false, 'message' => __('Invalid request!')];
           }
           DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    // user buy coin history

    public function userBuyCoinHistory()
    {
        $response = ['success' => false, 'message'=> __('Something went wrong.')];
        $items = Sell::where(['user_id'=> Auth::user()->id])->get();
        $datas = [];
        if (isset($items[0])) {
            $datas = [];
            foreach ($items as $item) {
                $datas[] = [
                    'user_name' => $item->user->name,
                    'coin_name' => $item->coin->name,
                    'payment_method' => $item->payment->name,
                    'amount' => $item->amount,
                    'price_rate' => $item->price,
                    'date' => date('d M y', strtotime($item->created_at)),
                ];
            }
            $response = [
                'success' => true,
                'buy_history' => $datas,
                'message'=> __('Data get successfully.')];
        } else {
            $response = ['success' => false,'buy_history' => [], 'message'=> __('No data found.')];
        }

        return $response;
    }
    
    public function coinPrice(){
       $coin = Coin::where(['status'=> STATUS_ACTIVE, 'is_active' => STATUS_ACTIVE])->first();
       $data['coin_price'] = $coin->price;
       $response['success'] = TRUE;
       $response['data'] = $data;
       $response['message'] = __('Coin price get successfully.');
       
       return $response;
    }
    
    public function pointPrice(){
       $data['point_amount_per_usd'] = allsetting('point_amount_per_unit') ?? 0;
       $data['available_points'] =  PointService::getUserPoints();
       $response['success'] = TRUE;
       $response['data'] = $data;
       $response['message'] = __('Point price get successfully.');
       
       return $response;
    }
    public function payuHashGenerate(Request $request){
       $key = $request->key ?? '';
       $txnid = $request->txnid ?? '';
       $amount = $request->amount ?? '';
       $productinfo = $request->productinfo ?? '';
       $firstname = $request->firstname ?? '';
       $email = $request->email ?? '';
       $salt = allsetting('payu_salt') ?? '';
       $hashSeq = $key.'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.$salt;
       $hash = hash("sha512", $hashSeq);
       $data['payu_hash'] = $hash;
       $response['success'] = TRUE;
       $response['data'] = $data;
       $response['message'] = __('Hash get successfully.');
       return $response;
    }
    
    public function getPaymentCredential(){
       $data['razorpay_api_key'] = allsetting('razorpay_api_key') ?? '';
       $data['payu_merchant_id'] = allsetting('payu_merchant_id') ?? '';
       $data['payu_merchant_key'] = allsetting('payu_merchant_key') ?? '';
       $data['payu_salt'] = allsetting('payu_salt') ?? '';
       
       $response['success'] = TRUE;
       $response['data'] = $data;
       $response['message'] = __('Payment credential get successfully.');
       return $response;
       
    }
    
    public function coinConversionUsdToRupee(){
       $data['rupee_price_per_usd'] = convertCurrency(1,'USD', 'INR');
       $response['success'] = TRUE;
       $response['data'] = $data;
       return $response;
    }
}
