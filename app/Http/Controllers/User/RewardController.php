<?php

namespace App\Http\Controllers\User;

use App\Services\PointService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardController extends Controller
{
    public function reward()
    {
        $data['pageTitle'] = __('Reward System');
        $data['all_settings'] = allsetting();
       $data['balance_point'] = PointService::getUserPoints();
        $data['rewards'] = DB::table('user_point_distribution_log')->where('user_id',Auth::user()->id)
        ->whereIn('admin_setting_slug',['daily_login_reward','daily_login_reward_amount','on_registration_reward','on_purchase_reward',
           'daily_topper_reward_amount','weekly_topper_reward_amount','monthly_topper_reward_amount'])
           ->orderBy('created_at','desc')
        ->paginate(15);
        return view('user.reward.reward', $data);
    }
}
