@extends('user.master')
@section('title') @if (isset($pageTitle)) {{ $pageTitle }} @endif @endsection

@section('main-body')
    <div class="account-area">
        <div class="row">
            <div class="col-md-1 offset-10">
                <div class="cmt-button pull-right back-button">
                    <a href="{{route('userDashboardView')}}">{{__('Back')}}</a>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="pr-head">{{__('Withdrawal System')}}</h2>
            <div class="profile-wrap leader-wrap">
                <div class="coin-top">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="coin-header">
                                <ul>
                                    <li><span>{{$all_settings['point_amount_per_unit'] ?? 0}}</span> {{__('Point')}}</li>
                                    <li>=</li>
                                    <li><span>1</span> USD</li>
                                </ul>
                            </div>
                            <h4 class="text-center text-success mt-4"><b>{{__('Availabe Points : ')}} {{$balance_point ?? 0}}
                                    ( {{ isset($all_settings['point_amount_per_unit']) && isset($balance_point)  ? $balance_point/$all_settings['point_amount_per_unit']: 0}} USD)</b></h4>
                        </div>
                    </div>
                </div>
                <div class="coin-bottom">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="coin-sub">
                                <br/>
                                <h4>{{__('Withdrawal Request')}}</h4>
                                <h5>{{__('Minimum withdrawal required: ')}} {{$all_settings['minimum_point_to_withdrawal'] ?? 0}} {{__('Point')}}
                                    ( {{ isset($all_settings['point_amount_per_unit']) && isset($all_settings['minimum_point_to_withdrawal'])  ? $all_settings['minimum_point_to_withdrawal']/$all_settings['point_amount_per_unit']: 0}} USD)</h5>
                                @if(isset($all_settings['minimum_point_to_withdrawal']) && isset($balance_point) )
                                    @if($balance_point >=$all_settings['minimum_point_to_withdrawal'] )
                                    <form method="POST" action="{{route('withdrawalProcess')}}">
                                        {{csrf_field()}}
                                        <div class="coin-select mt-3">

                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <label> {{__('Point')}} {{__('Amount')}} <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="e.g. 1000 {{__('Point')}}" name="amount">
                                                    @if($errors->first('amount'))
                                                        <span class="text-danger">{{$errors->first('amount')}}</span>
                                                    @endif

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <label>{{__('Withdrawal Method') }} <span class="text-danger">*</span></label>
                                                    <select name="withdrawal_by" class="form-control" id="withdraw_process">
                                                        <option value="Admin Request" selected>{{__('Admin Request')}}</option>
                                                        <option value="Bank">{{__('Bank')}}</option>
                                                        <option value="Paypal">{{__('Paypal')}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6 for_paypal">
                                                    <label>{{__('Paypal Account ID')}}</label>
                                                    <input type="text" placeholder="Enter paypal email here" name="paypal_account_id">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6 for_bank">
                                                    <label>{{__('Bank Name')}}</label>
                                                    <input type="text" placeholder="" name="bank_name">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6 for_bank">
                                                    <label>{{__('Account Number')}}</label>
                                                    <input type="text" placeholder="" name="bank_account_number">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6 for_bank">
                                                    <label>{{__('Account Name')}}</label>
                                                    <input type="text" placeholder="" name="bank_account_name">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6 for_bank">
                                                    <label>{{__('Route Number')}}</label>
                                                    <input type="text" placeholder="" name="bank_account_route">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="coin-select coin-select-2">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="submit-btn-area">
                                                        <button type="submit">{{__('Put Request')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @else
                                        <p class="text-danger">{{__('Minimum withdrawal point is less than ')}} {{ $all_settings['minimum_point_to_withdrawal'] ?? 0}}</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <hr/>
                <h4 class="my-4">Withdrawal History</h4>
                <div class="leader-simple">
                    <div class="row">
                        <div class="col-12">
                            <table id="dtBasicExample" class="table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="th-sm">{{__('SL.')}}</th>
                                    <th class="th-sm">{{__('Point')}}</th>
                                    <th class="th-sm">{{__('Withdrawal Method')}}</th>
                                    <th class="th-sm">{{__('Status')}}</th>
                                    <th class="th-sm">{{__('Requested Date')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($items))
                                    @php ($sl = 1)
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $item->point }}</td>
                                            <td>{{ $item->withdrawal_by }}</td>
                                            @if($item->status == 'Requested')
                                                <td><span class="badge badge-warning">{{ $item->status }}</span></td>
                                            @elseif($item->status == 'Declined')
                                                <td><span class="badge badge-danger">{{ $item->status }}</span></td>
                                            @else
                                                <td><span class="badge badge-success">{{ $item->status }}</span></td>
                                            @endif
                                            <td>{{ date('d M y', strtotime($item->created_at)) }}</td>

                                        </tr>
                                    @endforeach
                                @else
                                    <p>{{__('No data availabe')}}</p>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
    });
    $(document).ready(function () {
        withdrawalProcess();
    });
    $('#withdraw_process').on('change', function () {
        withdrawalProcess();
    });
    function withdrawalProcess() {
        var target = $('#withdraw_process option:selected').val();
        if(target == "Admin Request"){
            $('.for_bank').hide();
            $('.for_paypal').hide();
        }else if (target == 'Paypal'){
            $('.for_bank').hide();
            $('.for_paypal').show();
        }else if (target == 'Bank'){
            $('.for_bank').show();
            $('.for_paypal').hide();
        }else{
            $('.for_bank').hide();
            $('.for_paypal').hide();
        }

    }

</script>
@endsection