@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection
@if(session()->has('question_list.'.$question_no))
    @php $qId = session('question_list.'.$question_no.'.id'); @endphp
@endif
@section('main-body')
    <!-- Chemistry area start-->
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
    <div class="chemistry">
        <div class="container">
            <div class="chemistry-wrap">
                <div class="question-header">
                    <ul>
                        <li><img src="{{asset('assets/user/images/que/img-1.png')}}" alt="">
                            <span id="total_coin">{{isset($user_available_coin) ? $user_available_coin : 0}}</span>
                        </li>
                        <li><img src="{{asset('assets/user/images/que/img-2.png')}}" alt="">
                            <span id="total_point">{{isset($user_available_point) ? $user_available_point : 0}}</span>
                        </li>
                        <li><img src="{{asset('assets/user/images/que/img-3.png')}}" alt="">
                            {{$question_no}}/{{$total_count}}
                        </li>
                        <li><img src="{{asset('assets/user/images/que/img-4.png')}}" alt="">
                            <span id="safeTimer">
                                <span id="safeTimerDisplay"></span>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="row" id="row-disable">
                    <div class="col-lg-8 offset-lg-2">
                        @if(isset($alreadyPlayed))
                            <div class="unlock-btn question-btn mt-5">
                                @if(isset($qId))
                                    <a href="{{route('singleQuestion',[$question_no,$qId])}}">
                                        <button id="next2"  type="button" class="btn-qu">{{__('Next')}}</button>
                                    </a>
                                @else
                                    <a href="{{route('userDashboardView')}}">
                                        <button id="next2"  type="button" class="btn-qu">{{__('Back')}}</button>
                                    </a>
                                @endif
                            </div>
                        @else
                            <div class="question-item">
                                <div class="que-img">
                                    @if(!empty($question['video_link']))
                                        <div class="video">
                                            <iframe width="100%" height="365px" src="{{$question['video_link']}}"></iframe>
                                        </div>
                                    @elseif(!empty($question['image']))
                                        <img class="secound-img" src="{{$question['image']}}" alt="">
                                    @endif
                                </div>
                                <h4>Q{{$question_no}} : {{$question['title']}} </h4>
                                {{--<form action="">--}}
                                <div class="row options-fifty-fifty" id="q-options">
                                    @if(isset($question['options'][0]) && (!empty($question['options'][0]['question_option'])))
                                        <div class="col-md-6" id="opt0">
                                            <div class="que-btn que-btn-new" id="ans{{$question['options'][0]['id']}}">
                                                <a href='javascript:;' onclick='processForm("{{$question['options'][0]['id']}}");'>
                                                    @if($question['options'][0]['type'] == 1)
                                                        <img src="{{$question['options'][0]['question_option']}}" alt="">
                                                    @else
                                                        {{$question['options'][0]['question_option']}}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($question['options'][1]) && (!empty($question['options'][1]['question_option'])))
                                        <div class="col-md-6" id="opt1">
                                            <div class="que-btn que-btn-new" id="ans{{$question['options'][1]['id']}}">
                                                <a href='javascript:;' onclick='processForm("{{$question['options'][1]['id']}}");'>
                                                    @if($question['options'][1]['type'] == 1)
                                                        <img src="{{$question['options'][1]['question_option']}}" alt="">
                                                    @else
                                                        {{$question['options'][1]['question_option']}}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($question['options'][2]) && (!empty($question['options'][2]['question_option'])))
                                        <div class="col-md-6" id="opt2">
                                            <div class="que-btn que-btn-new" id="ans{{$question['options'][2]['id']}}">
                                                <a href='javascript:;' onclick='processForm("{{$question['options'][2]['id']}}");'>
                                                    @if($question['options'][2]['type'] == 1)
                                                        <img src="{{$question['options'][2]['question_option']}}" alt="">
                                                    @else
                                                        {{$question['options'][2]['question_option']}}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($question['options'][3]) && (!empty($question['options'][3]['question_option'])))
                                        <div class="col-md-6" id="opt3">
                                            <div class="que-btn que-btn-new" id="ans{{$question['options'][3]['id']}}">
                                                <a href='javascript:;' onclick='processForm("{{$question['options'][3]['id']}}");'>
                                                    @if($question['options'][3]['type'] == 1)
                                                        <img src="{{$question['options'][3]['question_option']}}" alt="">
                                                    @else
                                                        {{$question['options'][3]['question_option']}}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($question['options'][4]) && (!empty($question['options'][4]['question_option'])))
                                        <div class="col-md-6" id="opt4">
                                            <div class="que-btn que-btn-new" id="ans{{$question['options'][4]['id']}}">
                                                <a href='javascript:;' onclick='processForm("{{$question['options'][4]['id']}}");'>
                                                    @if($question['options'][4]['type'] == 1)
                                                        <img src="{{$question['options'][4]['question_option']}}" alt="">
                                                    @else
                                                        {{$question['options'][4]['question_option']}}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                {{--</form>--}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <p style="margin-bottom: 0"><a id="fiftyOption" href='javascript:;' onclick='fiftyFiftyOption("{{$question['question_id']}}");'>{{__('50/50 Answer')}}</a></p>
                                        <span id="fifty-option" class=""><small>{{__('If you need to see 50/50 option. You need ')}}{{isset($adm_setting['fifty_fifty_answer']) ? $adm_setting['fifty_fifty_answer'] : 0}}{{__(' coin')}}</small></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if(!empty($question['hints']))
                                        <div class="mb-3">
                                            <p style="margin-bottom: 0"><a id="seeHints" href='javascript:;' onclick='showHints("{{$question['question_id']}}");'>{{__('See Hints')}}</a> <span id="showHints"></span></p>
                                            <span id="hint-text" class=""><small>{{__('If you need to see this question hints. You need ')}}{{isset($adm_setting['hints_coin']) ? $adm_setting['hints_coin'] : 0}}{{__(' coin')}}</small></span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="unlock-btn question-btn">
                                @if(isset($qId))
                                    <a id="skipQuestion" data-toggle="modal" data-target="#skipQs" href="javascript:void(0);">
                                        <button type="button" >{{__('Skip')}}</button>
                                        @if($question['skip_coin'] > 0)
                                            <span class="d-block"><small>{{__('If you need to skip this question. You need ')}}{{$question['skip_coin']}}{{__(' coin')}}</small></span>
                                        @endif
                                    </a>

                                    <a href="{{route('singleQuestion',[$question_no,$qId])}}">
                                        <button id="next" disabled type="button" class="btn-qu">{{__('Next')}}</button>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chemistry area end-->
    <!-- Modal -->
    <div class="modal fade show" id="myModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog point-moadal">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="point-modal-area">
                        <h2>{{__('Congratulations')}}</h2>
                        <div class="point-m">
                            <div class="point-b">
                                <div class="earn-poin-s earn-poin-p">
                                    <span>{{__('Earned Point : ')}}</span>
                                    <span id="earned_point">5678</span>
                                </div>
                                <div class="earn-poin-s">
                                    <span>{{__('Earned Coin : ')}}</span>
                                    <span id="earned_coin">6783.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="unlock-btn question-btn">
                            <a href="{{route('userDashboardView')}}">
                                <button type="button" class=" btn-qu">{{__('Start New Game')}}</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal area start -->
    <div class="modal fade show" id="skipQs" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-question">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="unlock-area">
                        <h2>{{__('Skip Question')}}</h2>
                        <div class="unlock-box">
                            <div class="unlock-body">
                                <p>{{__('if you need to skip this question. You need coin')}}</p>
                                <span><img src="{{asset('assets/user/images/category/img-12.png')}}" alt=""> {{$question['skip_coin']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="unlock-btn">
                    <a href="{{route('skipCoin',[$question_no,$question['question_id']])}}">
                        <button type="button">{{__('Skip Question')}}</button>
                    </a>
                    <button type="button" class="close btn-cl" data-dismiss="modal" aria-label="Close">{{__('Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal area start -->
@endsection

@section('script')
    <script>
        var earnPoint = "{{$totalPoint}}";
        var earnCoin = "{{$totalCoin}}";

        function processForm(answer) {
            var right = new Audio('/assets/graceful.mp3');
            var wrong = new Audio('/assets/relentless.mp3');
            var timeups = new Audio('/assets/chin-up.mp3');
            $.ajax({
                type: "POST",
                url: "{{ route('submitAnswer') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': "{{$question['id']}}",
                    'time_limit': "{{$question['time_limit']}}",
                    'answer': answer
                },
                success: function (data) {
                    // $("#opt0").find("*").prop('disabled', true);
                    // $('#q-options *').prop('disabled',true);

                    console.log(data);
                    $("#total_coin").text(data.total_coin);
                    $("#total_point").text(data.total_point);

                    if(data.success == false) {
                        document.getElementById("ans"+data.right_answer).className += " que-btn-2";
                        if(data.time_out == undefined) {
                            wrong.play();
                            if(data.given_answer != undefined) {
                                document.getElementById("ans"+data.given_answer).className += " que-btn-3";
                            }
                        } else {
                            timeups.play();
                        }
                    } else {
                        right.play();
                        document.getElementById("ans"+data.right_answer).className += " que-btn-2";
                    }
                    if (data.success == true) {
                        tostMessage(data.message,'quiz-true')
                    } else {
                        tostMessage(data.message,'quiz-false')
                    }
                
                    if('{{$total_count}}' == '{{$question_no}}') {
                        $('#myModal').modal('show');
                        $('#earned_point').text((data.total_point) - earnPoint);
                        $('#earned_coin').text(data.total_coin_response);
                    }
                    document.getElementById("next").disabled = false;
                    document.getElementById("skipQuestion").disabled = true;
                    $("#skipQuestion").hide();
                    $("#seeHints").hide();
                    $("#hint-text").hide();
                    $("#fiftyOption").hide();
                    $("#fifty-option").hide();
                    // $("#row-disable *").prop('disabled',true);
                    $('.que-btn-new a').addClass('disabled');
                }
            });
        }
    </script>

    <script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                    // timer = duration; // uncomment this line to reset timer automatically after reaching 0
                }
            }, 1000);
        }

        window.onload = function () {
            var expTime = 0;
            if ("{{$current_date_time}}" < "{{$expire_time}}") {
                expTime = "{{$question['time_limit']}}" *60;
            }
            var time = expTime, // your time in seconds here
                display = document.querySelector('#safeTimerDisplay');
            startTimer(time, display);
        };
    </script>

    <script>
        function showHints(Qid) {
            $.ajax({
                type: "POST",
                url: "{{ route('seeHints') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'qId': Qid,
                },

                success: function (data) {

                    $("#opt0").find("*").prop('disabled', true);
                    $('#opt0 *').prop('disabled',true);

                    $("#total_coin").text(data.total_coin);

                    if(data.success == true) {
                        $("#seeHints").hide();
                        $("#hint-text").hide();
                        if(data.hints != undefined) {
                                $("#showHints").text(data.hints);
                            }
                        }
                    if (data.success == true) {
                        tostMessage(data.message,'quiz-true')
                    } else {
                        tostMessage(data.message,'quiz-false')
                    }
                }
            });
        }
    </script>

    <script>
        function fiftyFiftyOption(Qid) {
            $.ajax({
                type: "POST",
                url: "{{ route('fiftyOption') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'qId': Qid,
                },

                success: function (data) {
                    console.log(data);
                    $("#opt0").find("*").prop('disabled', true);
                    $('#opt0 *').prop('disabled',true);
                    $("#total_coin").text(data.total_coin);

                    if(data.success == true) {
                        $("#fiftyOption").hide();
                        $("#fifty-option").hide();
                        if(data.options != undefined) {
                            $('div.options-fifty-fifty').html(data.options)
                            }
                        }
                    if (data.success == true) {
                        tostMessage(data.message,'quiz-true')
                    } else {
                        tostMessage(data.message,'quiz-false')
                    }
                }
            });
        }
    </script>

    <script type="text/javascript">
        function tostMessage(sms,type) {
            if ( !$(this).hasClass('generate-toast') ) {
                var code = $(this).siblings('pre').find('code').text();
                code.replace("<span class='hidden'>", '');
                code.replace("</span");

                eval( code );

                $.toast({
                heading: 'Quiz',
                text: sms,
                icon: 'info',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600'  // To change the background
            })
            };
        };
    </script>
@endsection
