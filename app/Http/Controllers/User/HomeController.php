<?php

namespace App\Http\Controllers\User;

use App\Model\Category;
use App\Model\UserAnswer;
use App\Model\WebFeature;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //landing page
    public function home()
    {
        $data['pageTitle'] = allsetting('app_title');
        $data['adm_setting'] = allsetting();
        $data['features'] = WebFeature::where('status', STATUS_ACTIVE)->get();

        return view('user.home', $data);
    }

    //user dashboard
    public function userDashboardView()
    {
        $data['pageTitle'] = __('User|Dashboard');
        $data['menu'] = 'dashboard';
        $data['categories'] = Category::where(['status'=> STATUS_ACTIVE])->whereNull('parent_id')->orderBy('serial','ASC')->get();

        return view('user.dashboard.dashboard', $data);
    }

    // leader board
    public function leaderBoard()
    {
        $data['pageTitle'] = __('Leader Board');
        $data['today_leaders'] = UserAnswer::select(
            DB::raw('SUM(point) as score, user_id'))
            ->groupBy('user_id')
            ->whereDate('created_at', Carbon::today())
            ->orderBy('score', 'DESC')
            ->paginate(10);

        $data['weekly_leaders'] = UserAnswer::select(
            DB::raw('SUM(point) as score, user_id'))
            ->groupBy('user_id')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('score', 'DESC')
            ->paginate(10);

//        $data['all_leaders'] = UserAnswer::select(
//            DB::raw('SUM(point) as score, user_id'))
//            ->groupBy('user_id')
//            ->orderBy('score', 'DESC')
//            ->paginate(10);
       $data['all_leaders'] = User::leftJoin('user_points','users.id','user_points.user_id')->select('users.id','users.name','users.photo','user_points.point')
                                  ->orderBy('user_points.point', 'DESC')
                                  ->paginate(10);

        return view('user.leaderboard.leaderboard', $data);

    }
}
