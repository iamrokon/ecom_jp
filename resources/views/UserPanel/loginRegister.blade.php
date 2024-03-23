@include('UserPanel/inc/header')
@include('UserPanel/inc/menu')
@include('UserPanel/inc/mobile_header')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a id="home" href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">ログイン/新規登録</span> 
                </div>
            </div>
        </div>
        <section class="pt-100 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                
                    <!-- member cancellation messages -->
                    @if(Session::has('member_cancellation_msg'))
                    @php
                    $msgs = session()->get('member_cancellation_msg');
                    @endphp
                    <div class="alert alert-primary alert-dismissible">
                        <span>{{$msgs}}</span><br>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                        
                        <div class="row">
                            <div class="col-lg-5 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="mb-10">
                                    <h5>会員ログイン</h5>
                                    会員の方は、登録時に入力されたメールアドレスとパスワードでログインしてください。
                                </div>
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h4 class="mb-30">ログイン</h4>
                                        </div>
                                        <div id="login_error_data" style="margin-bottom: 10px;"></div>
                                        <form method="post" id="userLogin">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="login_email" required="" name="email" placeholder="メールアドレス">
                                                <span id="err_login_email" class="input-error-message"></span>
                                            </div>
                                            <div class="form-group" >
                                                <input required="" id="login_password" type="password" name="password" placeholder="パスワード">
                                                <span id="err_login_password" class="input-error-message"></span>
                                            </div>
                                            
                                            <!--<div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="#">Forgot password?</a>
                                            </div>-->
                                            
                                            <div class="form-group">
                                                <button type="button" onclick="userLogin()" class="btn btn-fill-out btn-block hover-up" name="login">ログイン</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="text-right" style="padding-top: 5px;text-align:right;">
                                    <a href="{{route('resetPassword')}}" style="text-decoration: underline;">パスワードを忘れた方はこちら</a>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                @if(Session::has('success_msg'))
                                <div class="alert alert-primary alert-dismissible success-message">
                                  <i class="bi bi-check2-circle"></i><span>{{session()->get('success_msg')}}</span>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                <div class="mb-10">
                                    <h5>新規会員登録</h5>
                                    会員登録をすると、毎回お届け先の住所などを入力する手間が省けます。<br>
                                    購入された商品の履歴を確認することができます。
                                </div>
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h4 class="mb-30">アカウントを作成</h4>
                                        </div>
                                        <div id="error_data" style="margin-bottom: 10px;"></div>
                                        <!--<p class="mb-50 font-sm">
                                            Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy
                                        </p>-->
                                        <form method="post" id='userRegister'>
                                            @csrf
                                            <div class="form-group" >
                                                <input type="text" id="reg_username" required="" name="username" placeholder="名前">
                                                <span id="err_username" class="input-error-message"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="reg_email" required="" name="email" placeholder="メールアドレス">
                                                <span id="err_email" class="input-error-message"></span>
                                            </div>
                                            <div class="form-group">
                                                <input required="" id="reg_password" type="password" name="password" placeholder="パスワード">
                                                <span id="err_password" class="input-error-message"></span>
                                            </div>
                                            <div class="form-group">
                                                <input required="" id="reg_con_password" type="password" name="confirm_password" placeholder="もう一度パスワードを入力してください">
                                                <span id="err_con_password" class="input-error-message"></span>
                                            </div>
                                            <!--<div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>-->
                                            <div class="form-group">
                                                <button type="button" onclick="userRegister()" class="btn btn-fill-out btn-block hover-up" name="login">作成する</button>
                                            </div>
                                        </form>
                                        
                                        <!--<div class="divider-text-center mt-15 mb-15">
                                            <span> or</span>
                                        </div>
                                        <ul class="btn-login list_none text-center mb-15">
                                            <li><a href="#" class="btn btn-facebook hover-up mb-lg-0 mb-sm-4">Login With Facebook</a></li>
                                            <li><a href="#" class="btn btn-google hover-up">Login With Google</a></li>
                                        </ul>
                                        <div class="text-muted text-center">Already have an account? <a href="#">Sign in now</a></div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    ﻿@include('UserPanel/inc/footer')