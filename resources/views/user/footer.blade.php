<!-- .footer-area start-->
<div class="footer-another" id="footer">
    <div class="container">
        <div class="footer-up">
            <ul>
                <li class="mr-2"><a href="{{route('termsCondition')}}">{{'Terms and Conditions'}}</a></li>
                <li class=""><a href="{{route('privacyPolicy')}}">{{'Privacy Policy'}}</a></li>
            </ul>
        </div>
        <div class="div">
            <ul>
                <li class="text-center">
                    <span>@if(!empty(allsetting('copyright_text'))) {{allsetting('copyright_text')}} @endif</span>
                </li>
            </ul>
        </div>

    </div>
</div>
<!-- .footer-end start-->