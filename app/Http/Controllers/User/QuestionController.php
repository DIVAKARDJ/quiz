<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\AnswerRequest;
use App\Model\QuestionTime;
use App\Model\UserAnswer;
use App\Repository\QuestionRepository;
use App\Services\CommonService;
use App\Services\PointService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    //single question details

    public function singleQuestion($index,$id)
    {
        $id = app(CommonService::class)->checkValidId($id);
        if (is_array($id)) {
            return redirect()->back()->with(['dismiss' => __('Question not found.')]);
        }
        $data['pageTitle'] = __('Question');
        $data['adm_setting'] = allsetting();
        $data['user_available_coin'] = 0;
        $data['user_available_point'] = PointService::getUserPoints(Auth::user()->id);
        if (isset(Auth::user()->userCoin->coin)) {
            $data['user_available_coin'] = Auth::user()->userCoin->coin;
        }
        $data['question_no'] = $index + 1;
        $qs = Session::get('question_list');

        $data['total_count'] = count($qs);
        $response = app(QuestionRepository::class)->questionData($id);
        if ($response['success'] == true) {
            $data['question'] = $response['qusetion_data'];
            $data['totalPoint'] = (session()->has('totalPoint')) ? Session::get('totalPoint') : 0;
            $data['totalCoin'] = (session()->has('totalCoin')) ? Session::get('totalCoin') : 0;

            $alreadyAddedExpireTime = QuestionTime::where(['user_id' => Auth::user()->id,
                'question_id' => $data['question']['id'], ])->first();
            if(session()->has('quizTestId')) {
                $data['alreadyPlayed'] = UserAnswer::where(['user_id' => Auth::user()->id, 'question_id' => $id, 'quiz_id' => Session::get('quizTestId')])->first();
            }
//            dd($data['alreadyPlayed'],Session::get('quizTestId'));
            if (empty($alreadyAddedExpireTime)) {
                $timeData = [
                    'user_id' => Auth::user()->id,
                    'question_id' => $data['question']['id'],
                    'expire_time' => Carbon::now()->addMinute($data['question']['time_limit'])
                ];
                $addExpireTime = QuestionTime::create($timeData);
                $data['expire_time'] = ($addExpireTime->expire_time)->toDateTimeString();
            } else {
                $data['expire_time'] = $alreadyAddedExpireTime->expire_time;
            }
            $data['current_date_time'] = Carbon::now()->toDateTimeString();

            return view('user.question.single-question', $data);
        } else {
            return redirect()->back()->with('dismiss', __('Question not found'));
        }
    }


    // submit answer
    public function submitAnswer(AnswerRequest $request)
    {
        $response = app(QuestionRepository::class)->answerSubmit($request);

        return response()->json($response);
    }


    // skip coin
    public function skipCoin($index,$id)
    {
        $qId = app(CommonService::class)->checkValidId($id);
        if (is_array($qId)) {
            return redirect()->back()->with(['dismiss' => __('Question not found.')]);
        }
        $response = app(QuestionRepository::class)->skipQuestion($qId);
        if ($response['success'] == true) {

            return redirect()->route('singleQuestion',[$index,$id])->with('message', $response['message']);
        } else {
            return redirect()->back()->with('dismiss', $response['message']);
        }
    }

    /**
     * see hints
     *
     *
     */

    public function seeHints(Request $request)
    {
        if (isset($request->qId)) {
            $qId = app(CommonService::class)->checkValidId($request->qId);
            if (is_array($qId)) {
                $data = ['success' => false, 'message' => __('Question not found.')];
                return response()->json($data);
            }
            $response = app(QuestionRepository::class)->showHints($qId);

            return response()->json($response);
        } else {
            $data = ['success' => false, 'message' => __('Question id is required')];
            return response()->json($data);
        }
    }
    /**
     * show fifty fifty option
     *
     *
     */

    public function fiftyOption(Request $request)
    {
        if (isset($request->qId)) {
            $qId = app(CommonService::class)->checkValidId($request->qId);
            if (is_array($qId)) {
                $data = ['success' => false, 'message' => __('Question not found.')];
                return response()->json($data);
            }
            $response = app(QuestionRepository::class)->fiftyFiftyOption($qId);

            return response()->json($response);
        } else {
            $data = ['success' => false, 'message' => __('Question id is required')];
            return response()->json($data);
        }
    }

}
