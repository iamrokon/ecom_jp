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
        <section class="mt-50 mb-50 my-xs-n0">
            <div class="container">
                <div class="row">
                    <div class="col-12 mb-20">
						@if(count(Cart::content()) < 1)
							<p style="color: red;padding-bottom: 20px;">商品がありません。</p>
						@endif
                        <h2 class=" mb-10"><strong>カート</strong></h2>
                        <a href="{{route('productList')}}" class="btn btn-fill-out btn-block" style="white-space: nowrap;margin-right:10px;">買い物を続ける</a>
                    </div>
					
                    <!-- stock out messages -->
                    <div class="col-12" 
                        @if(Session::has('stock_out_msg'))
                        @php
                        $stock_msgs = session()->get('stock_out_msg');
                        @endphp
                        <div>
                           @foreach($stock_msgs as $key=>$val)
                            <div class="alert alert-warning alert-dismissible warning-message"
                                <i class="bi bi-exclamation-triangle"></i><span>{{$val}}</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endforeach
                          
                        </div>
                        @endif
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
                                            <td class="image product-thumbnail" style="text-align: left;">
                                                <div class="d-flex align-items-center">
                                                    <div style="margin-right:15px;"><img src="{{$file_name}}" alt="#"></div>
                                                    <div>
                                                       <p><a href="{{url("productDetails/".$row->id."/".$row->name)}}">{{$row->name}}</a></p>
                                                        <div style="max-height: 19px;"><span>@if($row->options->size != ""){{$row->options->size}} / @endif </span><span>@if($row->options->color != ""){{$row->options->color}}@endif</span></div>
                                                        <div style="margin-top: 7px;"><a href="{{url('removeCartItem/'.$row->rowId)}}" class="btn" style="width:130px;"><i class="fi-rs-trash"></i> 削除 </a></div>
                                                    </div>

                                                </div>
                                            </td>
                                            <td data-title="価格">
                                                ¥{{number_format($row->price)}}
                                                <input type="hidden" name="price" class="item_price" value="{{$row->price}}"/>
                                            </td>
                                            <td data-title="数量">{{$row->qty}}</td>
                                            <td data-title="小計" style="text-align: right;">¥<span class="item_subtotal">{{number_format($row->price*$row->qty)}}</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="cartTotal" style="text-alight:right;">
                                    <div class="total-price" style="text-align: right;">
                                        <span class="total" style="padding-right:155px;">合計</span>
                                        <span class="subtotal">¥<span id="grand_subtotal">{{number_format($subtotal)}}</span></span>
                                    </div>
                                    <div class="text" style="text-align: right;margin-top: 25px;">

                                        <p><span style="font-weight:700;">{{ number_format(\DB::table('kokyaku1')->where('bango',env('store'))->first()->souryougenkai) }}円以上のお買い上げで</span><span style="color: #ff0000;">送料無料！</span></p>

                                    </div>
                                    <div class="text" style="text-align: right;margin-top: 15px;">
                                        <p>送料／消費税は、購入手続き時に計算されます。</p>
                                    </div>
                                </div>
                                {{-- <table style="margin-bottom: 0px !important;">
                                        <tr>
                                            <td colspan="8" class="text-end" style="border:none;padding-right:0px!important;">
                                                <a href="{{url('clearCart')}}" class="text-muted" @if(Cart::content()->count()<1){{'style=pointer-events:none;opacity:.4'}}@endif> <i class="fi-rs-cross-small"></i> クリアカート</a>
                                            </td>
                                        </tr>
                                </table> --}}
                            </div>
                            <div class="cart-action text-end">
                                <a href="{{route('updateCartList')}}" class="btn btn-fill-out btn-block btn-proceed ml-10 mt-2" @if(Cart::content()->count()<1){{'style=pointer-events:none;opacity:.4;margin-right:10px'}}@else{{'style=margin:0px'}}@endif>
                                    <!-- カートを更新する -->
                                    数量を変更する
                                </a>
                                <a href="{{route('checkout')}}" @if(Cart::content()->count()<1){{'style=pointer-events:none;opacity:.4'}}@endif class="btn btn-proceed mt-2"><i class="fi-rs-shopping-bag mr-10"></i> ご購入手続きへ </a>
                               
                                
                            </div>
                            <div class="divider center_icon mt-50 mb-50 my-xs-n0"></div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    ﻿@include('UserPanel/inc/footer')