<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointService {
    public static function getUserPoints($user_id = null){
        if ($user_id == null){
            $user_id = Auth::user()->id;
        }
        $balance_point = DB::table('user_points')->where('user_id', $user_id)->pluck('point')->toArray();
        return !empty($balance_point) ? $balance_point[0] : 0;
    }

}
