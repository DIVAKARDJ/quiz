<?php

namespace App\Http\Controllers\User;

use App\Services\ReferralService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
   public $service;
   public function __construct() {
      $this->service = new ReferralService();
   }
   
   public function referral()
    {
       $response = $this->service->referral();
        return view('user.referral.referral', $response['data']);
    }
}
