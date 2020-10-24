<?php

namespace App\Http\Controllers\Api;

use App\Services\ReferralService;
use App\Services\RewardDistributionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function referralList(){
       $referral_service = new  ReferralService();
       $response = $referral_service->referralList();
       return response()->json($response, 200);
    }
    public function referralBonusList(){
       $referral_service = new  ReferralService();
       $response = $referral_service->referralBonusList();
       return response()->json($response, 200);
    }
    
    public function rewardList(){
       $referral_service = new  ReferralService();
       $response = $referral_service->rewardList();
       return response()->json($response, 200);
    }
    
    public function rewardPointList(){
       $referral_service = new  ReferralService();
       $response = $referral_service->rewardPointList();
       return response()->json($response, 200);
    }
    
    public function referralLink(){
       $referral_service = new  ReferralService();
       $response = $referral_service->referralLink();
       return response()->json($response, 200);
    }
    
    public function coinPrice(){
    
    }
    
    
}
