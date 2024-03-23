@include('UserPanel/inc/header')
@include('UserPanel/inc/menu')
@include('UserPanel/inc/mobile_header')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ </a>
                    <span class="active">パスワード再設定</span> 
                </div>
            </div>
        </div>
        <section class="pt-100 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <!-- Success Message -->
                        @if(Session::has('success_msg'))
                        <div class="alert alert-primary alert-dismissible">
                          <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                          <strong>{{session()->get('success_msg')}}</strong>
                        </div>
                        @endif
                
                        <div class="row">
                            <div class="col-lg-5 mx-auto">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">パスワード送信フォーム</h3>
                                        </div>
                                        <div id="resetpass_error_data" style="margin-bottom: 10px;"></div>
                                        <form method="post" id="resetPass">
                                            @csrf
                                            <div class="form-group">
                                                <label for="">メールアドレス</label>
                                                <input type="text" required="" name="email" id="email" placeholder="">
                                            </div>
                                            <!-- <div class="form-group" id="login_password">
                                                <input required="" type="password" name="password" placeholder="パスワード">
                                            </div> -->
                                            <div class="form-group">
                                                <button type="button" onclick="resetPassword()" class="btn btn-fill-out btn-block hover-up" name="">送信</button>
                                            </div>
                                        </form>
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