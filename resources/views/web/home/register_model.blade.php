<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center">Sign Up</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>

            </div>
            <div class="modal-body">
                <form class="counter_form_content d-flex flex-column align-items-center justify-content-center"
                      action="{{ route('userSave') }}" method="POST">

                    @csrf
                    <input type="text" name="name" class="counter_input" placeholder="Username">

                    <input type="hidden" name="referral_code" value="{{$referral_code ?? ''}}">

                    <input type="email" name="email" class="counter_input" placeholder="Enter email">

                    <input type="password" name="password" class="counter_input" placeholder="Password">

                    <input type="password" class="counter_input" name="password_confirmation"
                           placeholder="Confirm Password">

                    <input type="text" name="phone" class="counter_input" placeholder="Phone">

                    <button type="submit" class="counter_form_button">{{__('Sign Up')}}</button>

                </form>
            </div>
        </div>

    </div>
</div>
