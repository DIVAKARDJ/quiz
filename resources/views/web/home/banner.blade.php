<div class="home_slider_container">
    <!-- Home Slider -->
    <div class="owl-carousel owl-theme home_slider">
        @forelse($homeSliders as $homeSlider)
            <div class="owl-item">
                <div class="home_slider_background"
                     style="background-image:url({{ asset(path_common_image() . $homeSlider->image) }})"></div>
                <div class="home_slider_content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <div class="home_slider_title">The Premium System Education</div>
                                <div class="home_slider_subtitle">Future Of Education Technology</div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="counter_form position-static p-5">
                                    <div class="row fill_height">
                                        <div class="col fill_height">
                                            <form class="counter_form_content d-flex flex-column align-items-center justify-content-center"
                                                  action="{{ route('loginProcess') }}" method="POST">
                                                @csrf
                                                <div class="counter_form_title">Login</div>

                                                <input type="email" name="email" class="counter_input"
                                                       placeholder="Enter email">

                                                <input type="password" name="password" class="counter_input"
                                                       placeholder="Password">


                                                <button type="button" class="counter_form_button"
                                                        data-toggle="model"
                                                        data-target="#signupModal">
                                                    Login
                                                </button>
                                                <button type="button" class="counter_form_button" id="btnSingup"
                                                        data-toggle="modal" data-target="#myModal">Sign Up
                                                </button>


                                                <div class="qz-user-footer mt-5">
                                                            
                                                            <span class="text-left">
                                                                @include('layout.message')
                                                            </span>

                                                    <div class="mt-3"><a
                                                                href="http://quiz.test/forget-password">forgot
                                                            password ?</a></div>
                                                    <div><a href="http://quiz.test/privacy-and-policy">privacy
                                                            policy</a> and <a
                                                                href="http://quiz.test/terms-and-conditions">terms
                                                            &amp; conditions</a></div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="owl-item">
                <div class="home_slider_background"
                     style="background-image:url({{ asset('web_assets/images/home_slider_1.jpg') }})"></div>
                <div class="home_slider_content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <div class="home_slider_title">The Premium System Education</div>
                                <div class="home_slider_subtitle">Future Of Education Technology</div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="counter_form position-static p-5">
                                    <div class="row fill_height">
                                        <div class="col fill_height">
                                            <form class="counter_form_content d-flex flex-column align-items-center justify-content-center"
                                                  action="{{ route('loginProcess') }}" method="POST">
                                                @csrf
                                                <div class="counter_form_title">Login</div>

                                                <input type="email" name="email" class="counter_input"
                                                       placeholder="Enter email">

                                                <input type="password" name="password" class="counter_input"
                                                       placeholder="Password">


                                                <button type="button" class="counter_form_button"
                                                        data-toggle="model"
                                                        data-target="#signupModal">
                                                    Login
                                                </button>
                                                <button type="button" class="counter_form_button" id="btnSingup"
                                                        data-toggle="modal" data-target="#myModal">Sign Up
                                                </button>


                                                <div class="qz-user-footer mt-5">
                                                            
                                                            <span class="text-left">
                                                                @include('layout.message')
                                                            </span>

                                                    <div class="mt-3"><a
                                                                href="http://quiz.test/forget-password">forgot
                                                            password ?</a></div>
                                                    <div><a href="http://quiz.test/privacy-and-policy">privacy
                                                            policy</a> and <a
                                                                href="http://quiz.test/terms-and-conditions">terms
                                                            &amp; conditions</a></div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
    <div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>

</div>
