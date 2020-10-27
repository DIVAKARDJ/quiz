<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UnlockRequest;
use App\Model\Category;
use App\Repositories\QuestionRepository;
use App\Services\CommonService;
use App\Services\PointService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /*
     *
     * single category data
     *
     *
     *
     *
     * */
    public function categoryData($id)
    {
        $data['pageTitle'] = __('Category');
        $id = app(CommonService::class)->checkValidId($id);
        if (is_array($id)) {
            return redirect()->back()->with(['dismiss' => __('Category not found.')]);
        }
        $data['categories'] = Category::where(['status'=> STATUS_ACTIVE, 'parent_id' => null])->orderBy('serial','ASC')->get();

        $data['category'] = Category::where(['status'=> STATUS_ACTIVE, 'id'=> $id])->first();
        if (isset($data['category'])) {
            $data['pageTitle'] = $data['category']->name;
            if (($data['category']->count_sub_category->count()) > 0) {
                $data ['subCategories'] = Category::where('status', STATUS_ACTIVE)->orderBy('serial', 'ASC')->where(['parent_id'=>$id])->get();

                return view('user.category.category', $data);
            } else {
                return redirect()->route('categoryInfo', encrypt($id));
            }
        } else {
            return redirect()->back()->with(['dismiss' => __('Category not found.')]);
        }
    }

    /**
     * unlock category
     *
     *
     */

    public function categoryUnlock(UnlockRequest $request)
    {
        $response = app(QuestionRepository::class)->unlockCategory($request);
        if ($response['success'] == false) {
            return redirect()->back()->withInput()->with('dismiss', $response['message']);
        } else {
            app(CommonService::class)->addOrDeductCoin($response['coin'], DEDUCT_COIN);

            return redirect()->route('categoryData', encrypt($request->category_id))->with('success', $response['message']);
        }
    }

    /**
     *
     * category info
     *
     */

    public function categoryInfo($id)
    {
        $data['pageTitle'] = __('Category');
        $id = app(CommonService::class)->checkValidId($id);
        if (is_array($id)) {
            return redirect()->back()->with(['dismiss' => __('Category not found.')]);
        }
        $data['category'] = Category::where(['status'=> STATUS_ACTIVE, 'id'=> $id])->first();
        $totalPoint = PointService::getUserPoints(Auth::user()->id);
        $totalCoin = 0;
        if (isset($data['category'])) {
            $data['pageTitle'] = $data['category']->name;
            $limit = $data['category']->qs_limit;
            $time_limit = $data['category']->time_limit;
            if (isset($data['category']->parent_id)) {
                $type = SUB_CATEGORY;
            } else {
                $type = CATEGORY;
            }
            $response  = app(QuestionRepository::class)->availableQuestions($id,$type,$limit);
            if(isset($response) && $response['success'] == true) {
                $data['question_list'] = $response['availableQuestionList'];
                $data['total_question'] = $response['totalQuestion'];
                $data['total_point'] = $response['totalPoint'];
                $data['total_coin'] = $response['totalCoin'];
                $quiz_id = uniqid().date("YmdHisu").substr(microtime(true), 2, 3).Auth::user()->id.$data['category']->id;
//                dd($data['question_list']);
                Session::put('question_list', $data['question_list']);
                Session::put('time_limit', $time_limit);
                Session::put('totalPoint', $totalPoint);
                Session::put('totalCoin', $totalCoin);
                Session::put('quizTestId', $quiz_id);
            } else {
                if(session()->has('question_list')) {
                    Session::forget('question_list');
                }
                if(session()->has('totalPoint')) {
                    Session::forget('totalPoint');
                }
                if(session()->has('totalCoin')) {
                    Session::forget('totalCoin');
                }
                if(session()->has('quizTestId')) {
                    Session::forget('quizTestId');
                }
            }

            return view('user.category.category-info', $data);
        } else {
            return redirect()->back()->with(['dismiss' => __('Category not found.')]);
        }
    }
}
