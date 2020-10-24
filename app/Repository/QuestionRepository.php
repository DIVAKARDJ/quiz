<?php
namespace App\Repository;
use App\Model\Category;
use App\Model\CategoryUnlock;
use App\Model\Question;
use App\Model\QuestionOption;
use App\Model\QuestionTime;
use App\Model\UserAnswer;
use App\Model\UserCoin;
use App\Services\CommonService;
use App\Services\PointService;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class QuestionRepository
{
    //unlock category
    public function unlockCategory($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong.',];
        try {
            $category = Category::where('id', $request->category_id)->first();
            if (isset($category)) {
                if ($category->coin > 0) {
                    $alreadyUnlock = CategoryUnlock::where(['user_id'=> Auth::user()->id, 'category_id' => $request->category_id, 'status' => 0])->first();
                    if (isset($alreadyUnlock)) {
                        $data = [
                            'success' => false,
                            'message' => __('This category already unlock'),
                        ];
                    } else {
                        $userCoin = UserCoin::where('user_id', Auth::user()->id)->first();
                        if (isset($userCoin)) {
                            if ($userCoin->coin < $category->coin) {
                                $data['success'] = false;
                                $data['message'] = __("You don't have sufficient coin");
                            } else {
                                $unlock = CategoryUnlock::create(['user_id'=> Auth::user()->id, 'category_id' => $request->category_id, 'status' => 0]);
                                if ($unlock) {
                                    $data = [
                                        'coin' => $category->coin,
                                        'success' => true,
                                        'message' => __('Category unlock successfully'),
                                    ];
                                } else {
                                    $data = [
                                        'success' => false,
                                        'message' => __('Category unlock failed'),
                                    ];
                                }
                            }
                        } else {
                            $data['success'] = false;
                            $data['message'] = __('User coin account not found');
                        }
                    }
                } else {
                    $data = [
                        'success' => false,
                        'message' => __('There is a no coin in this category for unlock'),
                    ];
                }
            } else {
                $data = [
                    'success' => false,
                    'message' => __('Category not found'),
                ];
            }

        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => 'Something went wrong. Please try again!',
            ];
            return $data;
        }

        return $data;
    }

    // avalable question list for user
    public function availableQuestions($id, $type, $limit)
    {
        $data = ['success' => false, 'message' => __('Invalid request')];
        try {
            $availableQuestions = [];
            if($type == 1) {
                $availableQuestions = Question::with('question_option')
                    ->where(['questions.category_id' => $id,'questions.status'=> STATUS_ACTIVE])
//                    ->whereNotIn('questions.id', UserAnswer::select('question_id')->where(['user_id' => Auth::id()]))
                    ->select('questions.*')
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get();
            } else {
                $availableQuestions = Question::with('question_option')
                    ->where(['questions.sub_category_id' => $id,'questions.status'=> STATUS_ACTIVE])
//                    ->whereNotIn('questions.id', UserAnswer::select('question_id')->where(['user_id' => Auth::id()]))
                    ->select('questions.*')
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get();
            }

            if (isset($availableQuestions[0])) {
                $totalQuestion = 0;
                $totalCoin = 0;
                $totalPoint = 0;
                $lists = [];
                foreach ($availableQuestions as $question) {
                    $lists[] = [
                        'id' => encrypt($question->id),
                    ];

                    $totalQuestion ++;
                    $totalPoint = $totalPoint + $question->point;
                    $totalCoin = $totalCoin + $question->coin;
                }
                    $data['success'] = true;
                    $data['totalQuestion'] = $totalQuestion;
                    $data['totalPoint'] = $totalPoint;
                    $data['totalCoin'] = $totalCoin;
                    $data['availableQuestionList'] = $lists;
                    $data['message'] = __('Available Question List');

            } else {
                $data = [
                    'success' => false,
                    'message' => __('No question found.')
                ];
            }
        } catch(\Exception $e) {
            $data = ['success' => false, 'message' => $e->getMessage()];
            return $data;
        }

        return $data;
    }

    // single question data

    public function questionData($id)
    {
        $response = ['success' => false, 'mesaage' => __('Invalid request')];
        try {
            $question = Question::where(['id' => $id])->first();
            if (isset($question)) {
                $qusetion_data = [
                    'category' => $question->qsCategory->name,
                    'sub_category' => isset($question->qsSubCategory->name) ? $question->qsSubCategory->name : '',
                    'category_id' => $question->qsCategory->id,
                    'sub_category_id' => isset($question->qsSubCategory->id) ? $question->qsSubCategory->id : '',
                    'id' => $question->id,
                    'question_id' => encrypt($question->id),
                    'title' => $question->title,
                    'has_video' => !empty($question->video_link) ? 1 : 0,
                    'video_link' => $question->video_link,
                    'has_image' => !empty($question->image) ? 1 : 0,
                    'image' => !empty($question->image) ? asset(path_question_image() . $question->image) : "",
                    'point' => $question->point,
                    'coin' => $question->coin,
                    'time_limit' => isset($question->time_limit) ? $question->time_limit : Session::get('time_limit'),
                    'status' => $question->status,
                    'hints' => $question->hints,
                    'skip_coin' => $question->skip_coin,
                    'option_type' => $question->type,
                    'options' => $this->getQuestionOption($question),
                ];

                $response = [
                  'success' => true,
                  'qusetion_data' => $qusetion_data,
                  'message' => __('Data get successfully')
                ];
            } else {
                $response = ['success' => false, 'mesaage' => __('Question not found')];
            }

        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        return $response;
    }

    // get question option data

    public function getQuestionOption($question)
    {
        $itemImage = [];
        if(isset($question->question_option[0])) {
            $itemImage [] = [
                'id' => isset($question->question_option[0]) ? $question->question_option[0]->id : '',
                'question_option' => isset($question->question_option[0]) && (!empty($question->question_option[0]->option_image)) ?  asset(path_question_option1_image() . $question->question_option[0]->option_image) : $question->question_option[0]->option_title,
                'type' => isset($question->question_option[0]) && (!empty($question->question_option[0]->option_image)) ? 1 : 0
            ];
        }
        if(isset($question->question_option[1])) {
            $itemImage [] = [
                'id' => isset($question->question_option[1]) ? $question->question_option[1]->id : '',
                'question_option' => isset($question->question_option[1]) && (!empty($question->question_option[1]->option_image)) ?  asset(path_question_option2_image() . $question->question_option[1]->option_image) : $question->question_option[1]->option_title,
                'type' => isset($question->question_option[1]) && (!empty($question->question_option[1]->option_image)) ? 1 : 0
            ];
        }


        if(isset($question->question_option[2])) {
            $itemImage [] = [
                'id' => isset($question->question_option[2]) ? $question->question_option[2]->id : '',
                'question_option' => isset($question->question_option[2]) && (!empty($question->question_option[2]->option_image)) ? asset(path_question_option3_image() . $question->question_option[2]->option_image) : $question->question_option[2]->option_title,
                'type' => isset($question->question_option[2]) && (!empty($question->question_option[2]->option_image)) ? 1 : 0
            ];
        }
        if(isset($question->question_option[3])) {
            $itemImage [] = [
                'id' => isset($question->question_option[3])  ? $question->question_option[3]->id : '',
                'question_option' => isset($question->question_option[3]) && (!empty($question->question_option[3]->option_image)) ? asset(path_question_option4_image() . $question->question_option[3]->option_image) : $question->question_option[3]->option_title,
                'type' => isset($question->question_option[3]) && (!empty($question->question_option[3]->option_image)) ? 1 : 0
            ];
        }
        if(isset($question->question_option[4])) {
            $itemImage [] = [
                'id' => isset($question->question_option[4]) ? $question->question_option[4]->id : '',
                'question_option' => isset($question->question_option[4]) && (!empty($question->question_option[4]->option_image)) ? asset(path_question_option5_image() . $question->question_option[4]->option_image) : $question->question_option[4]->option_title,
                'type' => isset($question->question_option[4]) && (!empty($question->question_option[4]->option_image)) ? 1 : 0
            ];
        }

        return $itemImage;
    }

    // submit answer

    public function answerSubmit($request)
    {
        DB::beginTransaction();
        try {
            $rightAnswer = "";
            $userCoins = UserCoin::where('user_id', Auth::user()->id)->first();
            $userPoints = DB::table('user_points')->where('user_id', Auth::user()->id)->first();
            if(empty($userCoins)) {
                $data = [
                    'success' => false,
                    'message' => 'User coin account not found.',
                ];
                return $data;
            }
            $correctAnswer = QuestionOption::where(['question_id'=> $request->id, 'is_answer' => ANSWER_TRUE])->first();
            if(isset($correctAnswer)) {
                $rightAnswer = $correctAnswer->id;
            }
            $question = Question::where(['id' => $request->id])->first();
            $option = QuestionOption::where(['id'=> $request->answer, 'question_id'=> $request->id])->first();
//            $userAnswer = UserAnswer::where(['question_id' => $request->id, 'user_id' => Auth::user()->id])->first();

            $input =[
                'user_id' => Auth::user()->id,
                'category_id' => $question->qsCategory->id,
                'question_id' => $question->id,
                'type' => $question->type,
                'quiz_id' => session()->has('quizTestId') ? Session::get('quizTestId') : null
            ];

            if ($option) {
                $qsExpireTime = QuestionTime::where(['user_id' => Auth::user()->id,
                    'question_id' => $request->id, ])->first();
                if (isset($qsExpireTime)) {
                    $current_date_time = Carbon::now()->toDateTimeString();
                    if ($current_date_time < $qsExpireTime->expire_time) {
                        if ($option->is_answer == ANSWER_TRUE) {
                            $input['is_correct'] = ANSWER_TRUE;

                            $input['coin'] = $question->coin;
                            $updatePoint = $userCoins->increment('coin', $question->coin);
                            $input['point'] = $question->point;
                            $new_points = $userPoints->point + $question->point ;
                            $updatePoint = DB::table('user_points')->where('user_id',Auth::user()->id)->update(['point'=>$new_points]);

                            $data = [
                                'success' => true,
                                'right_answer' => $rightAnswer,
                                'message' => __('Right Answer'),
                            ];
                            if(session()->has('totalCoin')) {
                                $session_data = Session::get('totalCoin');
                                Session::put('totalCoin', ($session_data + $question->coin));
                            }
                            ;
                        } else {
                            $data = [
                                'success' => false,
                                'message' => __('Wrong Answer'),
                                'right_answer' => $rightAnswer
                            ];
                        }
                    } else {
                        $data = [
                            'success' => false,
                            'time_out' => 'Time Out',
                            'right_answer' => $rightAnswer,
                            'message' => __('Sorry time up')
                        ];
                    }

                    $qsExpireTime->delete();
                } else {
                    $data = [
                        'success' => false,
                        'time_out' => 'Time Out',
                        'message' => __('Sorry time up'),
                        'right_answer' => $rightAnswer
                    ];
                }

            } else {
                $data = [
                    'success' => false,
                    'message' => __('Wrong Answer'),
                    'right_answer' => $rightAnswer
                ];
            }
            $insert = UserAnswer::create($input);

            $data['total_point'] = PointService::getUserPoints( Auth::user()->id);
            $data['total_coin'] = User::where('id',Auth::user()->id)->first()->userCoin->coin;
            $data['total_coin_response'] = Session::get('totalCoin');
            $data['given_answer'] = $request->answer;

        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'success' => false,
                'message' => $e->getMessage(),
//                'message' => 'Something went wrong. Please try again!',
            ];
            return $data;
        }

        DB::commit();
        return $data;
    }


    // skip question
    public function skipQuestion($id)
    {
        try {
            $question = Question::where('id', $id)->first();
            if (isset($question)) {
                if ($question->skip_coin > 0) {
                    $userCoin = UserCoin::where('user_id', Auth::user()->id)->first();
                    if (isset($userCoin)) {
                        if ($userCoin->coin < $question->skip_coin) {
                            $data['success'] = false;
                            $data['message'] = __("You don't have sufficient coin");
                        } else {
                            $deduct = app(CommonService::class)->addOrDeductCoin($question->skip_coin, DEDUCT_COIN);
                            $data =[
                                'success' => $deduct['status'],
                                'message' => __('Question skipped successfully')
                            ];
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = __('User coin account not found');
                    }
                } else {
                    $data['success'] = true;
                    $data['message'] = __('Question skipped successfully');
                }
            } else {
                $data = [
                    'success' => false,
                    'message' => __('Question not found.')
                ];
            }
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => $e->getMessage(),
//                'message' => 'Something went wrong. Please try again!',
            ];
            return $data;
        }

        return $data;
    }


    // show the question hints

    public function showHints($id)
    {
        try {
            $adm_setting = allsetting();

            $question = Question::where('id', $id)->first();
            if (isset($question)) {
                $hints = $question->hints;

                if (isset($adm_setting['hints_coin']) && ($adm_setting['hints_coin'] > 0)) {
                    $userCoin = UserCoin::where('user_id', Auth::user()->id)->first();
                    if (isset($userCoin)) {
                        if ($userCoin->coin < $adm_setting['hints_coin']) {
                            $data['success'] = false;
                            $data['message'] = __("You don't have sufficient coin");
                        } else {
                            $deduct = app(CommonService::class)->addOrDeductCoin($adm_setting['hints_coin'], DEDUCT_COIN);
                            $data =[
                                'success' => $deduct['status'],
                                'message' => __('Show hints successfully'),
                                'hints' => $hints
                            ];
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = __('User coin account not found');
                    }
                } else {
                    $data['success'] = true;
                    $data['message'] = __('Show hints successfully');
                    $data['hints'] = $hints;
                }
            } else {
                $data = [
                    'success' => false,
                    'message' => __('Question not found.')
                ];
            }
            $data['total_coin'] = User::where('id',Auth::user()->id)->first()->userCoin->coin;
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => $e->getMessage(),
//                'message' => 'Something went wrong. Please try again!',
            ];
            return $data;
        }

        return $data;
    }

    // 50 50 quiestion option

    public function fiftyFiftyOption($id)
    {
        try {
            $adm_setting = allsetting();

            $question = Question::where('id', $id)->first();
            if (isset($question)) {
                $options = $this->fiftyOptionList($id);
                $optionsData = '';
                $optionsData .= View::make('user.question.fifty-fifty-option',['options'=>$options]);

                if (isset($adm_setting['fifty_fifty_answer']) && ($adm_setting['fifty_fifty_answer'] > 0)) {
                    $userCoin = UserCoin::where('user_id', Auth::user()->id)->first();
                    if (isset($userCoin)) {
                        if ($userCoin->coin < $adm_setting['fifty_fifty_answer']) {
                            $data['success'] = false;
                            $data['message'] = __("You don't have sufficient coin");
                        } else {
                            $deduct = app(CommonService::class)->addOrDeductCoin($adm_setting['fifty_fifty_answer'], DEDUCT_COIN);
                            $data =[
                                'success' => $deduct['status'],
                                'message' => __('Show 50/50 option successfully'),
                                'options' => $optionsData
                            ];
                        }
                    } else {
                        $data['success'] = false;
                        $data['message'] = __('User coin account not found');
                    }
                } else {
                    $data['success'] = true;
                    $data['message'] = __('Show 50/50 option successfully');
                    $data['options'] = $optionsData;
                }
            } else {
                $data = [
                    'success' => false,
                    'message' => __('Question not found.')
                ];
            }
            $data['total_coin'] = User::where('id',Auth::user()->id)->first()->userCoin->coin;
        } catch (\Exception $e) {
            $data = [
                'success' => false,
                'message' => $e->getMessage(),
//                'message' => 'Something went wrong. Please try again!',
            ];
            return $data;
        }

        return $data;
    }

    // fifty fifty available option list

    public function fiftyOptionList($id)
    {
        $optionList = [];
        $options = QuestionOption::where(['question_id'=> $id])->get();

        if (isset($options[0])) {
            $list = [];
            foreach ($options as $opt) {
                $list[] = $opt->id;
            }
            $rightAnswer = QuestionOption::where(['question_id'=> $id, 'is_answer' => STATUS_ACTIVE])->first();
            $key = array_search($rightAnswer->id, $list);
            $key = $key + 1;
            if ($key == 1) {
                $path = path_question_option1_image();
            } elseif ($key == 2) {
                $path = path_question_option2_image();
            } elseif ($key == 3) {
                $path = path_question_option3_image();
            } elseif ($key == 4) {
                $path = path_question_option4_image();
            } else {
                $path = path_question_option5_image();
            }
            $right = [
                'id' => $rightAnswer->id,
                'question_option' => !empty($rightAnswer->option_image) ? asset($path . $rightAnswer->option_image) : $rightAnswer->option_title,
                'type' => !empty($rightAnswer->option_image) ? 1 : 0
            ];
            $optionList[] = [
                'id' => $options[0]->is_answer == STATUS_INACTIVE ? $options[0]->id : $options[1]->id,
                'question_option' => $options[0]->is_answer == STATUS_INACTIVE ? (!empty($options[0]->option_image) ? asset(path_question_option1_image() . $options[0]->option_image) :
                    $options[0]->option_title) : (!empty($options[1]->option_image) ? asset(path_question_option2_image() . $options[1]->option_image) : $options[1]->option_title),
                'type' => $options[0]->is_answer == STATUS_INACTIVE ? !empty($options[0]->option_image) ? 1 : 0 :
                    !empty($options[1]->option_image) ? 1 : 0

            ];
            array_push($optionList,$right);
        }

        return $optionList;
    }

}
