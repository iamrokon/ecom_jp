@include('UserPanel/inc/header')
{{--  @include('UserPanel/inc/menu') --}}
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">Home</a>
                    <span></span> Pages
                    <span class="active">Reset</span> 
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
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
                                            <h3 class="mb-30">パスワード再発行</h3>
                                        </div>
                                        <div id="reset_error_data" style="margin-bottom: 10px;"></div>
                                        <form method="post" id="reset">
                                            @csrf
                                            <input type="hidden" name="email" value="{{$email}}" />
                                            <div class="form-group" id="login_email">
                                                <label for="">新しいパスワード</label>
                                                <input type="password" required="" name="password" id="password" placeholder="">
                                            </div>
                                            <div class="form-group" id="login_password">
                                                <label for="">もう一度パスワードを入力してください</label>
                                                <input required="" type="password" name="con_password" id="con_password" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <!-- <button type="button" onclick="userLogin()" class="btn btn-fill-out btn-block hover-up" name="login">ログイン</button> -->
                                                <button type="button" onclick="resetPass()" class="btn btn-fill-out btn-block hover-up" name="">保存</button>
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