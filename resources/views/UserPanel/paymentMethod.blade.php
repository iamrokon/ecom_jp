@include('UserPanel/inc/header')
@include('UserPanel/inc/menu') 
@include('UserPanel/inc/mobile_header')
<style>
  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    /* z-index: 1; Sit on top */
    padding-top: 150px; /* Location of the box */
    left: 0;
    /* top: 0; */
    width: 100%; /* Full width */
    height: 100vh; /* Full height */
    overflow: hidden !important; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }
  
  /* Modal Content */
  .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    border-radius: 10px;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
  }
  
  /* Add Animation */
  @-webkit-keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }
  
  @keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
  }
  
  /* The Close Button */
  .close {
    color: gray;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  
  .modal-header {
    padding: 20px 26px;
    /* background-color: #5cb85c; */
    border-radius: 10px 10px 0px 0px;
    color: white;
  }
  
  .modal-body {
    padding: 20px 26px;
  }
  
  .modal-footer {
    padding: 20px 26px;
    /* background-color: #5cb85c; */
    border-radius: 0px 0px 10px 10px;
    color: white;
  }


  /* Select2 Design Update */
  .custom_select .select2-container {
    max-width: 100%;
  }

  /* Custom Button */
  .custom_button {
    background-color: #fff;
    color: #046963;
  }
  
  .custom_button:hover {
    background-color: #046963;
    color: #fff;
  }
  @media (max-width: 991px){
    .res-btn{
        padding: 10px !important;
    }
  }

  .payment-met{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  @media (max-width: 575px){
        .payment-met{
            display: block;
          }
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('kessai/css/style.css')}}" />
<script type="text/javascript" src="{{asset('kessai/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('kessai/js/jquery.tile.js')}}"></script>
<script type="text/javascript" src="{{asset('kessai/js/jquery.bxSlider.js')}}"></script>
<script type="text/javascript" src="{{asset('kessai/js/smoothScroll.js')}}"></script>
<script type="text/javascript" src="{{asset('kessai/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('kessai/js/yubin.js')}}"></script>
<script type="text/javascript">
        /*カード情報入力後確定ボタン有効化*/
        function after() {
            with (document.getElementById("create-token-launch")) {
                // カード情報入力済み
                // innerHTML = "カード情報入力済み";
                innerHTML.val = "カード情報入力済み";
            }

            if (document.getElementById('registered_card').children.length < 5) {
                document.getElementById('save_card_info').style.display = "block";
            }
            document.getElementById('save_card_info').style.display = 'none';
        }

    </script>
<main class="main">
    <!--  goto payment page -->
    <form action="{{route('payment')}}" method="POST" id="goToPayment" >
      @csrf
      <input type="hidden" id="userId" name="user_id" value="{{$input['user_id']}}">
      
      <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
      <input type="hidden" id="shippingMethod" name="shipping_method" value="{{$input['shipping_option']}}">
      <input type="hidden" id="deliveryDate" name="delivery_date" value="{{$input['delivery_date']}}">
      <input type="hidden" id="deliveryTime" name="delivery_time" value="{{$input['delivery_time']}}">
      <input type="hidden" name="name" value="{{$input['name']}}">
      <input type="hidden" name="zipcode1" value="{{$input['zipcode1']}}">
      <input type="hidden" name="zipcode2" value="{{$input['zipcode2']}}">
      <input type="hidden" name="prefecture" value="{{$input['prefecture']}}">
      <input type="hidden" name="address1" value="{{$input['address1']}}">
      <input type="hidden" name="address2" value="{{$input['address2']}}">
      
      <input type="hidden" name="furigana" value="{{$input['furigana']}}">
      <input type="hidden" name="biladd" value="{{$input['biladd']}}">
      
      <input type="hidden" name="email" value="{{$input['email']}}">
      <input type="hidden" name="phone" value="{{$input['phone']}}">
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
    
    <!--  goto payment method page -->
    <form action="{{route('paymentMethod')}}" method="POST" id="goToPaymentMethod" >
        @csrf
        <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
       
        <input type="hidden" name="send_address" value="{{$input['send_address']}}">
        <input type="hidden" name="order_address" value="{{$input['order_address']}}">
        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
        <input type="hidden" name="shipping_option" value="{{$input['shipping_option']}}">
        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
        <input type="hidden" name="delivery_charge" value="{{$delivery_charge}}">
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
        <input type="hidden" name="is_transaction" value="no">
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
    <form action="{{route('orderkakunin')}}" method="POST" id="goToOrderKakunin" >
        @csrf
        <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
       
        <input type="hidden" name="send_address" value="{{$input['send_address']}}">
        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
        <input type="hidden" name="order_address" value="{{$input['order_address']}}">
        <input type="hidden" name="shipping_option" value="{{$input['shipping_option']}}">
        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
        <input type="hidden" name="delivery_charge" value="{{$delivery_charge}}">
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
        <input type="hidden" name="is_transaction" value="no">
        <input type="hidden" name="settlement_charge" id="settlement_charge" @if(isset($input['settlement_charge'])){{$input['settlement_charge']}}@endif>
        <input type="hidden" name="payment_method" id="payment_method" value="">
        <input type="hidden" name="delivery_charge" id="delivery_charge" value="{{$delivery_charge}}">
        <input type="hidden" name="price_display" id="price_display" value="">
        <input type="hidden" name="inquiry" id="inquiry" value="">
        <input type="hidden" name="total_amount" id="total_amount" @if(isset($input['total_amount'])) value="{{$input['total_amount']}}" @else value='{{number_format(str_replace(",","",Cart::total(0)) + $delivery_charge)}}'@endif>
        <input type="hidden" name="webcollectToken" id="webcollectToken" value="">
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
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('homepage')}}" id="checkout_home" rel="nofollow">トップ</a>
                <span class="active">お支払い方法</span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <!--<div class="row">
                <div class="col-md-12">
                    <div class="mb-25">
                        <h4>支払方法</h4>
                    </div>
                </div>
            </div>-->
            <div class="row">
                 <!-- transaction err messages -->
                @if(Session::has('transaction_err_msg'))
                @php
                $transaction_err_msg = session()->get('transaction_err_msg');
                @endphp
                <div class="col-lg-12">
                <div class="alert alert-warning alert-dismissible warning-message">
                    <span>{{$transaction_err_msg}}</span><br>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                </div>
                @endif
                    
                <div class="col-lg-6">
                    <form method="post" action="{{ route('paymentHistory')}}" id="paymentHistory">
                        <input type="hidden" id="" name="user_id" value="{{$input['user_id']}}">
                        
                        
                        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
                        <input type="hidden" name="shipping_method" value="{{$input['shipping_option']}}">
                        <input type="hidden" name="delivery_date" value="{{$input['delivery_date']}}">
                        <input type="hidden" name="delivery_time" value="{{$input['delivery_time']}}">
                        <input type="hidden" name="shipping_destination" value="{{$input['shipping_destination']}}">
                        <input type="hidden" name="name" value="{{$input['name']}}">
                        <input type="hidden" name="furigana" value="{{$input['furigana']}}">
                        <input type="hidden" name="email" value="{{$input['email']}}">
                        <input type="hidden" name="phone" value="{{$input['phone']}}">
                        <input type="hidden" name="delivery_charge" value="{{$delivery_charge}}">
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
                        <input type="hidden" name="total_amount" id="total_amount1" @if(isset($input['total_amount'])) value="{{$input['total_amount']}}" @else value='{{number_format(str_replace(",","",Cart::total(0)) + $delivery_charge)}}' @endif>
                        <input name="diff2_phone" type="hidden" value="{{$input['diff2_phone']}}"/>
                        @endif
                        <input type="hidden" id="settlement-charge2" name="settlement_charge" value="@if(isset($input['settlement_charge'])){{$input['settlement_charge']}}@endif">
                        @csrf
                        <div class="product-text">
                            <table  class="tbl-shipping-address">
                                <tbody>
                                    <tr>
                                        <td class="image title-shipping" style="padding-bottom:0px;border:0;padding-right: 0px !important;width: 20%;vertical-align:top;">注文者</td>
                                        <td style="padding-bottom:0px;border:0;padding-right: 0px;width: 60%;">
                                                
                                                <span>{{$input['name']}}</span><br/>
                                                <span>{{$input['zipcode1'].$input['zipcode2']}} </span><br/>
                                                <span>{{$input['prefecture']." ".$input['address1']." ".$input['address2']." ".$input['biladd']}}</span><br/>
                                                <span>{{$input['phone']}}</span><br/>
                                            </td>
                                        {{--<td style="border:0;width: 20%;"><a href="{{route('checkout')}}" class="btn btn-fill-out btn-block" style="white-space: nowrap;">変更</a></td>--}}
                                    </tr>
                                    <tr>
                                        <td class="image title-shipping" style="padding-bottom:0px;border:0;padding-right: 0px !important;width: 20%;vertical-align:top;">配送先</td>
                                        @if(isset($input['address_option']) && $input['address_option']=='2')
                                        <td style="padding-bottom:0px;border:0;padding-right: 0px;width: 60%;">
                                                
                                                <span>{{$input['diff2_name']}}</span><br/>
                                                <span>{{$input['diff2_zipcode1'].$input['diff2_zipcode2']}} </span><br/>
                                                <span>{{$input['diff2_prefecture']." ".$input['diff2_address1']." ".$input['diff2_address2']." ".$input['diff2_biladd']}}</span><br/>
                                                <span>{{$input['diff2_phone']}}</span><br/>
                                            </td>
                                        @else
                                            <td style="padding-bottom:0px;border:0;padding-right: 0px;width: 60%;">
                                                
                                                <span>{{$input['name']}}</span><br/>
                                                <span>{{$input['zipcode1'].$input['zipcode2']}} </span><br/>
                                                <span>{{$input['prefecture']." ".$input['address1']." ".$input['address2']." ".$input['biladd']}}</span><br/>
                                                <span>{{$input['phone']}}</span><br/>
                                            </td>
                                        @endif    
                                        
                                    </tr>
                                    <tr>
                                        <td style="padding:0px;border:None;"></td>
                                        <td style="border:0;width: 20%;text-align:right"><a href="{{route('checkout')}}" class="btn btn-fill-out btn-block" style="white-space: nowrap;">変更</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                         
                            <div class="mb-25">
                                <h4> 支払方法</h4>
                                <input type="hidden" id="shipping_addr" name="send_address" value="{{$input['send_address']}}">
                               
                                <input type="hidden" id="prefecture" name="prefecture" value="{{$input['prefecture']}}">
                                <input type="hidden" id="diff2_prefecture" name="diff2_prefecture" value="{{isset($input['diff2_prefecture'])?$input['diff2_prefecture']:$input['prefecture']}}">
                                <input type="hidden" name="zipcode1" value="{{$input['zipcode1']}}">
                                <input type="hidden" name="zipcode2" value="{{$input['zipcode2']}}">
                                <input type="hidden" name="address1" value="{{$input['address1']}}">
                                <input type="hidden" name="address2" value="{{$input['address2']}}">
                                <input type="hidden" name="biladd" value="{{$input['biladd']}}">
                     
                               
                                
                                
                                <input type="hidden" id="temp-total-amount" name="total_amount" @if(isset($input['total_amount'])) value="{{$input['total_amount']}}" @else value='{{number_format(str_replace(",","",Cart::total(0)) + $delivery_charge)}}' @endif>
                            </div>
                        </div>
                        <div>
                            
                            <div id="validation_err" style="color: red;"></div>
                            <div id="exceed_err_msg" style="color: red;padding-bottom: 10px;"></div>
                            
                            <table class="radio-circle">
                                <tbody id="payment-method-tbody">
                                    @php
                                    $kokyaku1 = \App\Model\Kokyaku1::select('black1','black2','point3')->where('bango',5)->first();
                                    @endphp
                                    @if(isset($kokyaku1) && $kokyaku1->black1 == 1)
                                    <tr>
                                        <td class="image product-thumbnail">
                                            <div class="payment-met">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <div class="">
                                                    <div class="custome-radio">
                                                        <input class="form-check-input" required="" type="radio" name="payment_method" value="クレジットカード" id="shipToCurrentAddress" @if($prev_payment_method == 'クレジットカード'){{'checked'}}@endif>
                                                        <label class="form-check-label" for="shipToCurrentAddress" data-bs-toggle="collapse" data-target="#shipToCurrentAddress" aria-controls="shipToCurrentAddress"><span class="radio-text">クレジットカード</span></label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <select id="registered_card" name="registered_card" style="vertical-align: middle; font-family: &quot;ヒラギノ角ゴ Pro W3&quot;, &quot;Hiragino Kaku Gothic Pro&quot;, メイリオ, Meiryo, Osaka, &quot;ＭＳ Ｐゴシック&quot;, &quot;MS P Gothic&quot;, sans-serif; color: rgb(51, 51, 51); position: relative; padding: 4px 6px; font-size: 16px; background: rgb(248, 249, 249); border: 1px solid rgb(233, 226, 209); margin: 0px 0px 5px;max-width: 200px;min-width: 170px; display: none;">
                                                        <option value="new_card">新規カード</option>
                                                    </select>
                                                    <label id="save_card_info"
                                                    style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; background: transparent; font-weight: normal; font-style: normal; display: none;"><input
                                                        name="save_card_info" style="vertical-align: middle;" type="checkbox" value="01" />カード情報を登録する</label>

                                                </div>
                                                <div>
                                                    <span id="card_info_btn" class="btn"
                                                        style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 12px; vertical-align: baseline; background: transparent; font-weight: normal; font-style: normal; text-align: center; position: relative; display: inline-block; top: -1px;">
                                                        <input class="btn btn-fill-out btn-block btn-proceed" type="button" name="card_input" value="カード情報入力" id="create-token-launch"/>
                                                        <script type="text/javascript" class="webcollect-token-api"
                                                            src="https://ptwebcollect.jp/test_gateway/token/js/tokenlib.js" data-trader-cd="283703401"
                                                            data-auth-div="2" data-opt-serv-div="00"
                                                            data-check-sum="d7a758fb53aa076f4c56e51ef789368943b60b44f66dbe853d554775f56a8096"
                                                            data-callback="after" data-pay-way-div="1"></script>

                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    @endif
                                    @if(isset($kokyaku1) && $kokyaku1->point3 == 1)
                                    <tr>
                                        <td class="image product-thumbnail">
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <div class="">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="payment_method" value="代金引換" id="shipToCurrentAddress2" @if($prev_payment_method == '代金引換'){{'checked'}}@endif>
                                                    <label class="form-check-label paycircle" for="shipToCurrentAddress2" data-bs-toggle="collapse" data-target="#shipToCurrentAddress2" aria-controls="shipToCurrentAddress2"><span class="radio-text">代金引換</span></label>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset($kokyaku1) && $kokyaku1->black2 == 1)
                                    <tr>
                                        <td class="image product-thumbnail">
                                            <div class="form-group payment-met" style="margin-bottom: 0px;">
                                                <div class="">
                                                    <div class="custome-radio">
                                                        <input class="form-check-input" required="" type="radio" name="payment_method" value="クロネコ後払い" id="shipToCurrentAddress3" @if($prev_payment_method == 'クロネコ後払い'){{'checked'}}@endif>
                                                        <label class="form-check-label" for="shipToCurrentAddress3" data-bs-toggle="collapse" data-target="#shipToCurrentAddress3" aria-controls="shipToCurrentAddress3"><span class="radio-text">クロネコ後払い</span></label>
                                                    </div>
                                                </div>
                                                <!-- <button class="btn btn-fill-out btn-block btn-proceed">クロネコ後払い入力</button> -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4> 納品書への価格表示</h4>
                            </div>
                        </div>

                        <div>
                            <table class="radio-circle">
                                <tbody>
                                    <tr>
                                        <td class="image product-thumbnail" style="border-right:1px solid transparent;width:190px;">
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <div class="">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="price_display" value="0" id="exampleRadios3" checked="">
                                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#exampleRadios3" aria-controls="exampleRadios3"><span class="radio-text">表示する</span></label>

                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="image product-thumbnail" style="width:190px;">
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <div class="">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="price_display" value="1" id="exampleRadios4" @if($prev_price_display == 1){{'checked'}}@endif>
                                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#exampleRadios4" aria-controls="exampleRadios4" id="do_not_show"><span class="radio-text">表示しない</span></label>

                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-25">
                                <h4>その他お問い合わせ</h4>
                            </div>
                        </div>
                        <div class="mb-30">
                            <input type="text" name="inquiry" value="{{$prev_inquiry}}" maxlength="50" placeholder="50文字まで入力可能です。">
                        </div>
                        <div style="margin-bottom: 25px;">
                            <a href="#" onclick="gotoPaymentPage()" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;">配送日時指定へ戻る</a>
                            <button type="submit" id="order_con_btn" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;margin-right:10px;font-weight: 700;">注文確認へ進む</button>
                            
                            <!-- <a href="https://netshop.colgisbdwork.com/checkout" class="btn btn-fill-out btn-block custom_button" style="white-space: nowrap;">配送方法へ戻る</a> -->
                        </div>
                    </form>
                </div>
                <input type="hidden" name="product_total" id="product_total" value="{{Cart::subtotal(0)}}"/>
                
            </div>
        </div>
    </section>
</main>
@include('UserPanel/inc/footer')