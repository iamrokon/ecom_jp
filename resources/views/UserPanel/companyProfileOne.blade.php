

﻿@include('UserPanel/inc/header')
@include('UserPanel/inc/menu')
@include('UserPanel/inc/mobile_header')
    
    <main class="main single-page">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">配送・送料について</span> 
                </div>
            </div>
        </div>
        <section class="compay-profile mt-50 mb-100">
            <div class="container">
                <div class="row">
                    <div class="col">
                    <div class="single-header style-2">
                            <h3>配送・送料について</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                       <div class="text-content">
                       <p>宅急便：全国一律648円（税込）　/　都道府県別送料　（別紙参照）</p>
                        <p>ネコポス：全国一律216円（税込）　発送サイズにより、ご利用が限られます。</p>
                        <p>※1回のお支払金額（商品代金合計）が8,000円以上（税込）で送料無料。</p>
                       </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('UserPanel/inc/footer')