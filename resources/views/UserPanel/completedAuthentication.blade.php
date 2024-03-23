@include('UserPanel/inc/header')
@include('UserPanel/inc/menu')
@include('UserPanel/inc/mobile_header')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">ログイン/新規登録</span> 
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="single-header style-2">
                            <h3>新規会員登録</h3>
                        </div>
                        <div class="single-content-inner mb-50">
                            <ul>
                                <li>ご登録ありがとうございました</li>
                                <li>引き続き、お買い物をお楽しみください。</li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <a href="{{route('homepage')}}" type="button" class="btn btn-fill-out btn-block" style="white-space: nowrap;">TOPページに戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    ﻿@include('UserPanel/inc/footer')
