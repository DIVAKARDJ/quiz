<div class="card">
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{__('Name')}}: {{$withdrawal_details->name ?? ''}}</li>
        <li class="list-group-item">{{__('Points')}}: {{$withdrawal_details->point ?? ''}}</li>
        <li class="list-group-item">{{__('Equivalent Currency')}}: {{$withdrawal_details->equivalent_currency ?? ''}}</li>
        <li class="list-group-item">{{__('Status')}}: {{$withdrawal_details->status ?? ''}}</li>
        <li class="list-group-item">{{__('Withdrawal Method')}}: {{$withdrawal_details->withdrawal_by ?? ''}}</li>
        @if($withdrawal_details->withdrawal_by == 'Bank')
             <li class="list-group-item">{{__('Bank Name')}}: {{$withdrawal_details->bank_name ?? ''}}</li>
             <li class="list-group-item">{{__('Bank Account Number')}}: {{$withdrawal_details->bank_account_number ?? ''}}</li>
             <li class="list-group-item">{{__('Bank Account Name')}}: {{$withdrawal_details->bank_account_name ?? ''}}</li>
             <li class="list-group-item">{{__('Bank Account Route')}}: {{$withdrawal_details->bank_account_route ?? ''}}</li>
        @elseif($withdrawal_details->withdrawal_by == 'Paypal')
            <li class="list-group-item"><p>{{__('Paypal Account ID')}}: {{$withdrawal_details->paypal_account_id ?? ''}}</li>
        @endif
    </ul>
</div>
