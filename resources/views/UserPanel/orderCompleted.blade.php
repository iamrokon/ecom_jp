@include('UserPanel/inc/header')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">ご注文完了</span> 
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="single-header style-2">
                            <h3>ご注文完了</h3>
                        </div>
                        <div class="single-content-inner mb-50">
                            <h4 class="mb-10">オーダー番号：{{$bango}}</h4>
                            <ul>
                                <li>ご注文ありがとうございます。</li>
                                <!-- <li>以下の内容にて、確認メールをお送りさせていただきました。</li> -->
                                <li>ただいま、ご注文の確認メールをお送りさせていただきました。</li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <a href="{{route('homepage')}}" type="button" class="btn btn-fill-out btn-block" style="white-space: nowrap;">TOPページに戻る</a>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-10">
                        
                    </div>
                </div> -->
            </div>
        </section>
    </main>
    ﻿@include('UserPanel/inc/footer')
