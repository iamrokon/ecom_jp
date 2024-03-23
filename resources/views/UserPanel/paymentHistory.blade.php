@include('UserPanel/inc/header')
@include('UserPanel/inc/menu') 

<style>
  @media (max-width: 991px){
    .res-btn{
        padding: 10px !important;
    }
  }
  .payment-confirmation table td, 
  .payment-confirmation table th{
      color: black;
  }
</style>
<main class="main">
    
    <!--  goto payment method page -->
    <form action="{{route('orderComplete')}}" method="POST" id="orderComplete" >
        @csrf
        <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
        <input type="hidden" name="send_address" value="{{$input['send_address']}}">
        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
        <input type="hidden" name="shipping_method" value="{{$input['shipping_method']}}">
        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
        <input type="hidden" name="delivery_charge" value="{{$input['delivery_charge']}}">
        <input type="hidden" name="settlement_charge" value="{{$input['settlement_charge']}}">
        <input type="hidden" name="name" value="{{$input['name']}}">
        <input type="hidden" name="furigana" value="{{$input['furigana']}}">
        <input type="hidden" name="email" value="{{$input['email']}}">
        <input type="hidden" name="zipcode1" value="{{$input['zipcode1']}}">
        <input type="hidden" name="zipcode2" value="{{$input['zipcode2']}}">
        <input type="hidden" name="prefecture" value="{{$input['prefecture']}}">
        <input type="hidden" name="address1" value="{{$input['address1']}}">
        <input type="hidden" name="address2" value="{{$input['address2']}}">
        <input type="hidden" name="biladd" value="{{$input['biladd']}}">
        
        
        <input type="hidden" name="phone" value="{{$input['phone']}}">
        <input type="hidden" name="payment_method" value="{{$input['payment_method']}}">
        <input type="hidden" name="price_display" value="{{$input['price_display']}}">
        <input type="hidden" name="inquiry" value="{{$input['inquiry']}}">
        <input type="hidden" name="total_amount" value="{{$input['total_amount']}}">
        <input type="hidden" name="webcollectToken" id="webcollectToken" value="{{$input['webcollectToken']}}">

        @if(isset($input['address_option']) && $input['address_option']=='2')
        <input name="address_option" type="hidden" value="{{$input['address_option']}}"/>
        
        <input name="diff2_name" type="hidden" value="{{$input['diff2_name']}}"/>
        <input name="diff2_furigana" type="hidden" value="{{$input['diff2_furigana']}}"/>
       
        <input name="diff2_zipcode1" type="hidden" value="{{$input['diff2_zipcode1']}}"/>
        <input name="diff2_zipcode2" type="hidden" value="{{$input['diff2_zipcode2']}}"/>
        <input name="diff2_prefecture" type="hidden" value="{{$input['diff2_prefecture']}}"/>
        <input name="diff2_address1" type="hidden" value="{{$input['diff2_address1']}}"/>
        <input name="diff2_address2" type="hidden" value="{{$input['diff2_address2']}}"/>
        <input name="diff2_biladd" type="hidden" value="{{$input['diff2_biladd']}}"/>
        <input name="diff2_phone" type="hidden" value="{{$input['diff2_phone']}}"/>
        @endif
    </form>
    <form action="{{route('paymentMethod')}}" method="POST" id="goToPaymentMethod" >
        @csrf
        <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
        <input type="hidden" name="send_address" value="{{$input['send_address']}}">
        <input type="hidden" name="order_address" value="{{$input['order_address']}}">
        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
        <input type="hidden" name="shipping_method" value="{{$input['shipping_method']}}">
        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
        <input type="hidden" name="delivery_charge" value="{{$input['delivery_charge']}}">
        <input type="hidden" name="settlement_charge" value="{{$input['settlement_charge']}}">
        <input type="hidden" name="name" value="{{$input['name']}}">
        <input type="hidden" name="furigana" value="{{$input['furigana']}}">
        <input type="hidden" name="email" value="{{$input['email']}}">
        <input type="hidden" name="zipcode1" value="{{$input['zipcode1']}}">
        <input type="hidden" name="zipcode2" value="{{$input['zipcode2']}}">
        <input type="hidden" name="prefecture" value="{{$input['prefecture']}}">
        <input type="hidden" name="address1" value="{{$input['address1']}}">
        <input type="hidden" name="address2" value="{{$input['address2']}}">
        <input type="hidden" name="biladd" value="{{$input['biladd']}}">
        
        
        <input type="hidden" name="phone" value="{{$input['phone']}}">
        <input type="hidden" name="payment_method" value="{{$input['payment_method']}}">
        <input type="hidden" name="price_display" value="{{$input['price_display']}}">
        <input type="hidden" name="inquiry" value="{{$input['inquiry']}}">
        <input type="hidden" name="total_amount" value="{{$input['total_amount']}}">
        <input type="hidden" name="webcollectToken" id="webcollectToken" value="{{$input['webcollectToken']}}">

        @if(isset($input['address_option']) && $input['address_option']=='2')
        <input name="address_option" type="hidden" value="{{$input['address_option']}}"/>
        
        <input name="diff2_name" type="hidden" value="{{$input['diff2_name']}}"/>
        <input name="diff2_furigana" type="hidden" value="{{$input['diff2_furigana']}}"/>
        
        <input name="diff2_zipcode1" type="hidden" value="{{$input['diff2_zipcode1']}}"/>
        <input name="diff2_zipcode2" type="hidden" value="{{$input['diff2_zipcode2']}}"/>
        <input name="diff2_prefecture" type="hidden" value="{{$input['diff2_prefecture']}}"/>
        <input name="diff2_address1" type="hidden" value="{{$input['diff2_address1']}}"/>
        <input name="diff2_address2" type="hidden" value="{{$input['diff2_address2']}}"/>
        <input name="diff2_biladd" type="hidden" value="{{$input['diff2_biladd']}}"/>
        <input name="diff2_phone" type="hidden" value="{{$input['diff2_phone']}}"/>
        @endif
    </form>
    <form action="{{route('checkout_final_page')}}" method="get" id="checkout_final_page" >
        @csrf
        <input name="order_id" type="hidden" id="order_id" value=""/>
    </form>    
  
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('homepage')}}" id="checkout_home" rel="nofollow">トップ</a>
                <span class="active">注文内容確認</span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50 ">
        <div class="container">
            <form action="{{route('paymentMethod')}}" method="POST" id="goToPaymentMethod" >
                <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
                <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
                @csrf
                <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
        <input type="hidden" name="send_address" value="{{$input['send_address']}}">
        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
        <input type="hidden" name="shipping_method" value="{{$input['shipping_method']}}">
        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
        <input type="hidden" name="delivery_charge" value="{{$input['delivery_charge']}}">
        <input type="hidden" name="settlement_charge" value="{{$input['settlement_charge']}}">
        <input type="hidden" name="name" value="{{$input['name']}}">
        <input type="hidden" name="furigana" value="{{$input['furigana']}}">
        <input type="hidden" name="email" value="{{$input['email']}}">
        <input type="hidden" name="zipcode1" value="{{$input['zipcode1']}}">
        <input type="hidden" name="zipcode2" value="{{$input['zipcode2']}}">
        <input type="hidden" name="prefecture" value="{{$input['prefecture']}}">
        <input type="hidden" name="address1" value="{{$input['address1']}}">
        <input type="hidden" name="address2" value="{{$input['address2']}}">
        <input type="hidden" name="biladd" value="{{$input['biladd']}}">
        
        
        <input type="hidden" name="phone" value="{{$input['phone']}}">
        <input type="hidden" name="payment_method" value="{{$input['payment_method']}}">
        <input type="hidden" name="price_display" value="{{$input['price_display']}}">
        <input type="hidden" name="inquiry" value="{{$input['inquiry']}}">
        <input type="hidden" name="total_amount" value="{{$input['total_amount']}}">
        <input type="hidden" name="webcollectToken" id="webcollectToken" value="{{$input['webcollectToken']}}">

        @if(isset($input['address_option']) && $input['address_option']=='2')
        <input name="address_option" type="hidden" value="{{$input['address_option']}}"/>
        
        <input name="diff2_name" type="hidden" value="{{$input['diff2_name']}}"/>
        <input name="diff2_furigana" type="hidden" value="{{$input['diff2_furigana']}}"/>
        
        <input name="diff2_zipcode1" type="hidden" value="{{$input['diff2_zipcode1']}}"/>
        <input name="diff2_zipcode2" type="hidden" value="{{$input['diff2_zipcode2']}}"/>
        <input name="diff2_prefecture" type="hidden" value="{{$input['diff2_prefecture']}}"/>
        <input name="diff2_address1" type="hidden" value="{{$input['diff2_address1']}}"/>
        <input name="diff2_address2" type="hidden" value="{{$input['diff2_address2']}}"/>
        <input name="diff2_biladd" type="hidden" value="{{$input['diff2_biladd']}}"/>
        <input name="diff2_phone" type="hidden" value="{{$input['diff2_phone']}}"/>
        @endif
                <div class="row">
                    <div class="col-md-5 payment-confirmation">
                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4>ご注文者情報</h4>
                            </div>
                        </div>
                        <div class="">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;">氏名</td>

                                        <td style="width: 50%;">@if(isset($ordererInfo)){{$ordererInfo['name']}}@else{{$input['name']}}@endif</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> フリガナ</td>

                                        <td style="width: 50%;">@if(isset($ordererInfo)){{$ordererInfo['kaka']}}@else{{$input['furigana']}}@endif</td>
                                    </tr> 
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> メールアドレス</td>

                                        <td style="width: 50%;">@if(isset($ordererInfo)){{$ordererInfo['mail']}}@else{{$input['email']}}@endif</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 郵便番号</td>

                                        <td style="width: 50%;">@if(isset($ordererInfo)){{substr($ordererInfo['yubinbango'],0,3)}}-{{substr($ordererInfo['yubinbango'],3,4)}}@else{{$input['zipcode1']}}-{{$input['zipcode2']}}@endif</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 住所</td>

                                        <td style="width: 50%;">{{$input['prefecture']." ".$input['address1']." ".$input['address2']." ".$input['biladd']}}</td>
                                    </tr>  
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 電話番号</td>

                                        <td style="width: 50%;">@if(isset($ordererInfo)){{$ordererInfo['tel']}}@else{{$input['phone']}}@endif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4> 配送先情報</h4>
                            </div>
                        </div>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;">氏名</td>
                                        <input type="hidden" name="orderer_name" value="{{$input['name']}}">
                                        <td style="width: 50%;">{{isset($input['diff2_name'])?$input['diff2_name']:$input['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> フリガナ</td>

                                        <td style="width: 50%;">{{isset($input['diff2_furigana'])?$input['diff2_furigana']:$input['furigana']}}</td>
                                    </tr> 
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 郵便番号</td>

                                        <td style="width: 50%;">{{isset($input['diff2_zipcode1'])?$input['diff2_zipcode1']:$input['zipcode1']}}-{{isset($input['diff2_zipcode2'])?$input['diff2_zipcode2']:$input['zipcode2']}}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 住所</td>
                                        @if(isset($input['diff2_prefecture']))
                                        <td style="width: 50%;">{{$input['diff2_prefecture']." ".$input['diff2_address1']." ".$input['diff2_address2']." ".$input['diff2_biladd']}}</td>
                                        @else
                                        <td style="width: 50%;">{{$input['prefecture']." ".$input['address1']." ".$input['address2']." ".$input['biladd']}}</td>
                                        @endif
                                    </tr>  
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 電話番号</td>

                                        <td style="width: 50%;">{{isset($input['diff2_phone'])?$input['diff2_phone']:$input['phone']}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4> 配送方法</h4>
                            </div>
                        </div>
                        <div>
                            <table>
                                <tbody>
                                    
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> お届け日指定</td>
                                        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
                                        <td style="width: 50%;">{{$input['delivery_date']=='null'?"":$input['delivery_date']}}</td>
                                    </tr> 
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> お届け時間帯指定</td>
                                        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
                                        <input type="hidden" name="inquiry" value="{{$input['inquiry']}}">
                                        <td style="width: 50%;">
                                            @if($input['delivery_time']=='null')
                                            
                                            @elseif($input['delivery_time']=='01')
                                            午前中
                                            @else
                                            {{$input['delivery_time']}}
                                            @endif
                                       </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4> 支払方法</h4>
                            </div>
                        </div>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;">支払方法</td>
                                        <input type="hidden" name="payment_method" value="{{$input['payment_method']}}">
                                        <td style="width: 50%;">{{$input['payment_method']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="image product-thumbnail" style="width: 50%;padding-right: 0px !important;"> 納品書への表示</td>
                                        <input type="hidden" name="price_display" value="{{$input['price_display']}}">
                                        <td style="width: 50%;">@if($input['price_display'] == 0){{'表示する'}}@else{{'表示しない'}}@endif</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4> その他お問い合わせ</h4>
                            </div>
                        </div>
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                       
                                        <input type="hidden" name="inquiry" value="{{$input['inquiry']}}">
                                        <td style="width: 50%;">{{$input['inquiry']}}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div style="margin-bottom: 25px;">
                            <a   onclick="back_payment()" class="btn btn-fill-out btn-block btn-proceed mb-20" style="white-space: nowrap;margin-right:10px;">お支払いへ戻る</a>
                            <a id="submit_order"  onclick="submit_order()" class="btn btn-fill-out btn-block btn-proceed mb-20" style="white-space: nowrap;margin-right:10px;">注文を確定する</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review" style="margin-top:45px;">
                            <div class="mb-20">
                                <h4>注文詳細</h4>
                            </div>
                            @php
                            $total_amount = (double) str_replace(",","",Cart::total()) + $input['delivery_charge'] + $input['settlement_charge'];
                            $sub_total = (int) str_replace(",","",Cart::subtotal(0));
                            //$tax = ($sub_total * $percentage) / 100;
                            //$tax = round($total_amount*($percentage/100)/(($percentage + 100)/100));
                            @endphp
                            <div class="table-responsive order_table text-center table-xs-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">商品</th>
                                            <th>数量</th>
                                            <th>小計</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $row)
                                        <tr>
                                            @php
                                            $file_name = url('storage/product/images'.'/'.$row->options->file_name);
                                            @endphp
                                            <td class="image product-thumbnail"><img src="{{$file_name}}" alt="#"></td>
                                            <td>
                                                <p class="text-brand" style="text-align:left;">{{$row->name}}</p>
                                                <div style="text-align:left;">{{$row->options->size}}/{{$row->options->color}}</div>
                                                {{-- <i class="ti-check-box font-small text-muted mr-10"></i>
                                                <h5><a href="#">{{$row->name}}</a></h5> <span class="product-qty">x {{$row->qty}}</span> --}}
                                            </td>
                                            <td>{{$row->qty}}</td>
                                            <td>￥{{number_format($row->price*$row->qty)}}</td>
                                        </tr>
                                        @endforeach
                                        <!-- <tr>
                                            <th colspan="3">
                                                <div style="display: flex;">
                                                    <input class="ml-5" type="text" id="checkout_reduction_code"
                                                        name="checkout_reduction_code" placeholder="クーポンコード">
                                                    <a href="#" class="btn btn-fill-out btn-block ml-10"
                                                        style="white-space: nowrap;">適用する</a>
                                                </div>
                                            </th>
                                        </tr> -->

                                        <tr>
                                            <th>
                                                <div>小計</div>
                                                <!--<div>（消費税額）</div>-->
                                                <!-- <div style="position: relative;">
                                                    <span>配送料
                                                        <a href="#" id="openShippingPolicyModal">
                                                            <span style="font-size: .9em; font-weight: 500; line-height: 1.75em; white-space: nowrap; text-align: center; border-radius: 50%; background-color: rgba(114,114,114,.9); color: #fff;-webkit-box-sizing: border-box; box-sizing: border-box; min-width: 1.75em; height: 1.75em; padding: 0 0.4em; z-index: 3;">?</span>
                                                        </a>
                                                    </span>
                                                </div> -->
                                            </th>
                                            <td class="product-subtotal text-end" colspan="3">
                                                <div class="">￥{{number_format((int)str_replace(',','',$total_amount)-(int)$input['delivery_charge']-(int)$input['settlement_charge'])}}</div>
                                                <!--<div>￥{{--number_format($tax)--}}</div>-->
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>配送料</th>
                                            <input type="hidden" name="delivery_charge" value="{{$input['delivery_charge']}}">
                                            <td colspan="3" class="product-subtotal text-end"><span>￥{{number_format($input['settlement_charge'])}}</span></td>
                                        </tr>
                                        <tr>
                                            <th>手数料</th>
                                            <input type="hidden" name="settlement_charge" value="{{$input['settlement_charge']}}">
                                            <td colspan="3" class="product-subtotal text-end"><span>￥{{number_format($input['delivery_charge'])}}</span></td>
                                        </tr>
                                        <tr>
                                            <th>合計(税込)<br><span>内税 ￥{{number_format($tax)}}</span></th>
                                            <input type="hidden" name="total_amount" value="{{$input['total_amount']}}">
                                            <td colspan="3" class="product-subtotal text-end"><span>￥{{number_format($total_amount)}}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
@include('UserPanel/inc/footer')