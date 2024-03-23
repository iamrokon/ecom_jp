﻿@include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
    <style>
        #scrollUp {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .custom_button {
            background-color: #fff;
            color: #046963;
        }
        .custom_button:hover {
            background-color: #046963;
            color: #fff;
        }
        .fi-rs-trash:before {
     
            font-size: 12px;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">カート</span> 
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-20">
                        <h2 class=" mb-10"><strong>カート</strong></h2>
                        <a href="{{route('productList')}}" class="btn btn-fill-out btn-block" style="white-space: nowrap;margin-right:10px;">買い物を続ける</a>
                    </div>
                    <form method="post" action="{{route('updateCartData')}}">
                        @csrf
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table shopping-summery text-center clean" style="margin-bottom: 0px;">
                                    <thead>
                                        <tr class="main-heading">
                                            <th scope="col"></th>
                                            <th style="width: 100px;" scope="col">価格</th>
                                            <th style="width: 100px;" scope="col">数量</th>
                                            <th style="width: 100px;text-align:right" scope="col">小計</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $subtotal = 0;
                                        @endphp
                                        @foreach(Cart::content() as $row)
                                        @php
                                        $subtotal = $subtotal + ($row->price*$row->qty);
                                        @endphp
                                        <tr style="border-bottom: 1px solid #e2e9e1;">
                                            @php
                                            $file_name = url('../storage/product/images'.'/'.$row->options->file_name);
                                            @endphp
                                            <input type="hidden" name="rowId[]" value="{{$row->rowId}}"/>
                                            <input type="hidden" value="{{$row->id}}" class="product_id"/>
                                            <td class="image product-thumbnail" style="text-align: left;">
                                                <div class="d-flex">
                                                    <div style="margin-right:20px;"><img src="{{$file_name}}" alt="#"></div>
                                                    <div>
                                                       <p>{{$row->name}}</p>
                                                        <div><span>{{$row->options->size}} / </span><span>{{$row->options->color}}</span></div>
                                                        <div><a href="{{url('removeCartItem/'.$row->rowId)}}" class="btn"><i class="fi-rs-trash"></i> 削除 </a></div>
                                                    </div>

                                                </div>
                                            </td>
                                            <td>
                                                ¥{{number_format($row->price)}}
                                                <input type="hidden" name="price" class="item_price" value="{{$row->price}}"/>
                                            </td>
                                            <td><input type="number" name="qty[]" class="item_qty" onchange="calCartResult($(this))" onkeyup="calCartResult($(this))" min="1" value="{{$row->qty}}"></td>
                                            <td style="text-align: right;">¥<span class="item_subtotal">{{number_format($row->price*$row->qty)}}</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="cartTotal" style="text-alight:right;">
                                    <div class="total-price" style="text-align: right;">
                                        <span style="padding-right:185px;">合計</span>
                                        <span >¥<span id="grand_subtotal">{{number_format($subtotal)}}</span></span>
                                    </div>
                                    <div class="text" style="text-align: right;margin-top: 15px;margin-bottom:15px;">
                                        <p>送料／消費税は、購入手続き時に計算されます。</p>
                                    </div>
                                </div>
                                {{-- <table style="margin-bottom: 0px !important;">
                                        <tr>
                                            <td colspan="8" class="text-end" style="border:none;padding-right:0px!important;">
                                                <a href="{{url('clearCart')}}" class="text-muted" @if(Cart::content()->count()<1){{'style=pointer-events:none;opacity:.4'}}@endif> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                            </td>
                                        </tr>
                                </table> --}}
                            </div>
                            <div class="cart-action text-end">
                                <button type="submit" class="btn btn-fill-out btn-block custom_button" @if(Cart::content()->count()<1){{'style=pointer-events:none;opacity:.4;margin-right:10px'}}@else{{'style=margin-right:10px'}}@endif>
                                    <!-- カートを更新する -->
                                    数量変更を確定する
                                </button>
                                {{-- <a href="{{route('checkout')}}" @if(Cart::content()->count()<1){{'style=pointer-events:none;opacity:.4'}}@endif class="btn "><i class="fi-rs-shopping-bag mr-10"></i> ご購入手続きへ </a> --}}
                            </div>
                            <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    ﻿@include('UserPanel/inc/footer')