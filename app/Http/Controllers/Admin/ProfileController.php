<?php

namespace App\Http\Controllers\Admin;

use App\Model\UserAnswer;
use App\Repository\UserRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /*
     * userProfile
     *
     * User profile
     *
     *
     *
     *
     */

    public function userProfile()
    {
        $data['pageTitle'] = __('Profile');
        $data['menu'] = 'profile';
        $data['user'] = User::where('id', Auth::user()->id)->first();
        $participated_questions = 0;
        $userQuestions = UserAnswer::where('user_id', Auth::user()->id)->count();
        if($userQuestions) {
            $participated_questions = $userQuestions;
        }
        $data['participated_questions'] = $participated_questions;
        $monthlyScores = UserAnswer::select(DB::raw('SUM(user_answers.point) as totalScore'), DB::raw('MONTH(user_answers.created_at) as months'))
            ->where('user_answers.user_id', Auth::user()->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('months')
            ->get();

        $allMonths = all_month();
        if (isset($monthlyScores[0])) {
            foreach ($monthlyScores as $score) {
                $data['score'][$score->months] = $score->totalScore;
            }
        }
        $allScores= [];
        foreach ($allMonths as $month) {
            $allScores[] =  isset($data['score'][$month]) ? (int)$data['score'][$month] : 0;
        }
        $data['monthly_score'] = $allScores;
//        dd($data['monthly_score']);

        if (Auth::user()->role == USER_ROLE_ADMIN) {
            return view('admin.profile', $data);
        } elseif (Auth::user()->role == USER_ROLE_USER) {
            return view('user.profile.profile', $data);
        } else {
            return redirect()->back();
        }

    }
/*
     * editProfile
     *
     * Edit User profile
     *
     *
     *
     *
     */

    public function editProfile()
    {
        $data['pageTitle'] = __('Profile');
        $data['menu'] = 'profile';
        $data['user'] = User::where('id', Auth::user()->id)->first();

        return view('user.profile.edit-profile', $data);
    }

    /*
     * passwordChange
     *
     * password change page
     *
     *
     *
     *
     */

    public function passwordChange()
    {
        $data['pageTitle'] = __('Change Password');
        $data['menu'] = 'profile';
        $data['user'] = User::where('id', Auth::user()->id)->first();
        if (Auth::user()->role == USER_ROLE_ADMIN) {
            return view('admin.change-password', $data);
        } elseif (Auth::user()->role == USER_ROLE_USER) {
            return view('user.profile.change-password', $data);
        } else {
            return redirect()->back();
        }
    }

    /*
     * updateProfile
     *
     * Profile Update process
     *
     *
     *
     *
     */

    public function updateProfile(Request $request)
    {
        $rules=[
            'name' => 'required',
        ];
        $messages = [
            'name.required' => __('The name field can not empty'),
        ];
        if (!empty($request->photo)) {
            $rules['photo'] = 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:20000';
        }
        $this->validate($request, $rules,$messages);
        $userRepository = app(UserRepository::class);
        $response = $userRepository->profileUpdate($request->all(),Auth::user()->id);
        if ($response['status'] == false) {
            return redirect()->back()->withInput()->with('dismiss', $response['message']);
        } else {
            return redirect()->back()->withInput()->with('success', $response['message']);
        }
    }

    /*
     * changePassword
     *
     * Password change process
     *
     *
     *
     *
     */

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ];
        $messages = [
            'password_confirmation.confirmed' => 'The password confirmation does not match.'
        ];
        $this->validate($request, $rules, $messages);
        $userRepository = app(UserRepository::class);
        $response = $userRepository->passwordChange($request->all(), Auth::user()->id);

        if ($response['status'] == false) {
            return redirect()->back()->withInput()->with('dismiss', $response['message']);
        } else {
            return redirect()->back()->withInput()->with('success', $response['message']);
        }
    }
}
