<?php


namespace App\Services;


use App\Model\AdminSetting;
use App\Model\UserAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RewardDistributionService {
   public static function dailyLoginRewards($user_id){
      self::insertData('daily_login_reward_amount',$user_id);
   }
   
   public static function dailyPerformanceReward(){
      
      $daily_top_user = UserAnswer::select(DB::raw('SUM(point) as score, user_id'))
                                  ->groupBy('user_id')
                                  ->whereDate('created_at', Carbon::today())
                                  ->orderBy('score', 'DESC')
                                  ->first();
      
      self::insertData('daily_topper_reward_amount',$daily_top_user->user_id);
   }
   public static function weeklyPerformanceReward(){
      
      $weekly_top_user = UserAnswer::select(DB::raw('SUM(point) as score, user_id'))
                                   ->groupBy('user_id')
                                   ->where('created_at', '>=', Carbon::now()->subDays(7))
                                   ->orderBy('score', 'DESC')
                                   ->first();
      
      self::insertData('weekly_topper_reward_amount',$weekly_top_user->user_id);
   }
   
   public static function monthlyPerformanceReward(){
      
      $monthly_top_user = UserAnswer::select(DB::raw('SUM(point) as score, user_id'))
                                    ->groupBy('user_id')
                                    ->where('created_at', '>=', Carbon::now()->subDays(30))
                                    ->orderBy('score', 'DESC')
                                    ->first();
      
      self::insertData('monthly_topper_reward_amount',$monthly_top_user->user_id);
   }
   
   private static function insertData($admin_slug,$user_id){
      $insert_data = [
         'admin_setting_slug' => $admin_slug,
         'user_id' => $user_id,
         'operation_type' => 'Add',
         'point' => allsetting($admin_slug),
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now()
      ];
      DB::beginTransaction();
      try {
         $user = DB::table('user_points')->where('user_id',$user_id)->first();
         
         $new_points = $user->point + allsetting($admin_slug);
         $updated = DB::table('user_points')->where('user_id',$user_id)->update(['point'=>$new_points]);
         
         DB::table('user_point_distribution_log')->insert($insert_data);
         
         DB::commit();
      }catch (\Exception $exception){
         DB::rollback();
      }
   }
}