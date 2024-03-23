

﻿@include('UserPanel/inc/header')
@include('UserPanel/inc/menu')
@include('UserPanel/inc/mobile_header')
    
    <main class="main single-page">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">会社概要</span> 
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col">
                    <div class="single-header style-2">
                            <h3>会社概要</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-8 order-md-12">
                <!-- <div class="shipping_para text-left" style="padding-top:50px;">
                    <h5>会社概要</h5>
                </div> -->
                <div class="delivery_table_1 mt-4">
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>会社名</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">株式会社ＡＢＣオンラインショップ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>代表者</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">代表取締役社長　千葉　一郎</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>本社所在地</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">
                                        〒261-0023<br>
                                        千葉県千葉市美浜区中瀬1-7-1<br>
                                        住友ケミカルエンジニアリングセンタービル16F
                                          </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>連絡先</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">043-309-4741</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>設立年月日</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">	2021年3月</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>定休日</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">
                                        土日祝日及び当社指定日                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table_row">
                        <div class="row ml-0 mr-0">
                            <div class="col-md-3 table_head">
                                <div class="table_head2">
                                    <p>業種内容</p>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="table_body">
                                    <div class="row">
                                        <p class="text-left">衣料品販売
                                           
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </section>
    </main>
    @include('UserPanel/inc/footer')