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
    width: 220px!important;
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
  .arrow-appearance .form-control{
    appearance: auto;
    -moz-appearance: auto;
    -webkit-appearance: auto;
  }
</style>
<main class="main">
    <!--  goto payment method page -->
    <form action="{{route('paymentMethod')}}" method="POST" id="goToPaymentMethod" >
      @csrf
    </form>
    
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('homepage')}}" id="checkout_home" rel="nofollow">トップ</a>
                <!-- <span></span> 配送方法・お届け日時指定 -->
                <span class="active">お届け日時指定</span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50 my-xs-n0">
        <div class="container">
            <!--<div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50"></div>
                </div>
            </div>-->
            <form method="post" action="{{ route('createOrder')}}" id="createOrder">
                <input type="hidden" name="user_id" value="{{$input['user_id']}}"/>
                <input type="hidden" name="shipping_destination" value="@if(isset($input['shipping_destination'])){{$input['shipping_destination']}}@endif"/>
                <!--<input type="hidden" name="haisou_bango" value="{{--$haisou_bango--}}"/>-->
                @csrf
                <div class="row">
                    <div id="placeorder_error_data" style="margin-bottom: 10px;margin-left: -8px;"></div>
                    <div class="col-md-6">
                        <div class="product-text">
                            <table class="tbl-shipping-address">
                                <tbody>
                                    <tr>
                                        <tr>
                                            <td class="image title-shipping" style="padding-bottom:0px;border:0;padding-right: 0px !important;width: 20%;vertical-align:top;">注文者</td>
                                            <td style="padding-bottom:0px;border:0;padding-right: 0px;width: 60%;">
                                                
                                                <span>{{$input['name']}}</span><br/>
                                                <span>{{$input['zipcode1'].$input['zipcode2']}} </span><br/>
                                                <span>{{$input['prefecture']." ".$input['address1']." ".$input['address2']." ".$input['biladd']}}</span><br/>
                                                <span>{{$input['phone']}}</span><br/>
                                            </td>
                                        
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
                                            <input name="shipping_addr" type="hidden" value="{{$input['name']}} {{$input['zipcode1'].$input['zipcode2']}} {{$input['prefecture']." ".$input['address1']." ".$input['address2']}}"/>
                                            
                                            <input name="order_address" type="hidden" value="{{$order_address}}"/>
                                            <input name="send_address" type="hidden" value="{{$send_address}}"/>
                                            <input name="name" type="hidden" value="{{$input['name']}}"/>
                                            <input name="furigana" type="hidden" value="{{$input['furigana']}}"/>
                                            <input name="zipcode1" type="hidden" value="{{$input['zipcode1']}}"/>
                                            <input name="zipcode2" type="hidden" value="{{$input['zipcode2']}}"/>
                                            <input name="prefecture" type="hidden" value="{{$input['prefecture']}}"/>
                                            <input name="address1" type="hidden" value="{{$input['address1']}}"/>
                                            <input name="address2" type="hidden" value="{{$input['address2']}}"/>
                                            <input name="biladd" type="hidden" value="{{$input['biladd']}}"/>
                                            
                                            <input name="email" type="hidden" value="{{$input['email']}}"/>
                                            <input name="phone" type="hidden" value="{{$input['phone']}}"/>
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
                                        
                                    </tr>
                                    <tr>
                                       
                                        <td style="padding:0px;border:None;"></td>
                                        <td style="width: 20%;border: 0;text-align:right;"><a href="{{ url()->previous() }}" class="btn btn-fill-out btn-block" style="white-space: nowrap;">変更</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="payment_err_data" style="margin-bottom: 10px;margin-left: -7px;"></div>
                        <!-- <div class="mb-25">
                            <h4>配送方法</h4>
                        </div>
                        <div>
                            <table>
                                <tbody>
                                    @foreach($shipping_method as $key=>$val)
                                    <tr>
                                        <td class="image product-thumbnail" style="border-right:1px solid transparent;width:220px;">
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <div class="">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="shipping_option" value="{{$val}}" id="shipToCurrentAddress{{$key}}" @if($prev_shipping_method == $val){{'checked'}}@endif>
                                                    <label class="form-check-label" for="shipToCurrentAddress{{$key}}" data-bs-toggle="collapse" data-target="#shipToCurrentAddress{{$key}}" aria-controls="shipToCurrentAddress{{$key}}">{{$val}}</label>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align:right"></td>
                                    </tr>
                                    @endforeach
                                   <tr>
                                        <td class="image product-thumbnail" style="border-right:1px solid transparent;width:190px;">
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <div class="">
                                                <div class="custome-radio">
                                                    <input class="form-check-input" required="" type="radio" name="shipping_option" value="2" id="addNewAddress" @if($prev_shipping_method == 2){{--'checked'--}}@endif>
                                                    <label class="form-check-label" for="addNewAddress" data-bs-toggle="collapse" data-target="#addNewAddress" aria-controls="addNewAddress">ネコポス</label>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align:right"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                        <div class="mb-20">
                            <h4>お届け日・お届け時間帯指定</h4>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <div class="arrow-appearance">
                                <div class="d-flex align-items-center resp-appearance" style="margin-bottom: 8px;">
                                    <div style="width: 108px;margin-right:27px;">
                                        お届け日指定
                                    </div>
                                    <div style="width: 300px!important;">
                                        <div class="custom_select" id="delivery_date_grp">
                                            <select name="delivery_date" id="delivery_date" class="form-control select-active-payment1" style="width: 200px;">
                                                @if(!empty($delivery_date))
                                                <option value="null">指定なし</option>
                                                @foreach($delivery_date as $d_date)
                                                <option value="{{$d_date}}" @if($prev_delivery_date == $d_date){{'selected'}}@endif>{{$d_date}}</option>
                                                @endforeach
                                                @else
                                                <option value="null">指定できません</option>
                                                @endif
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center resp-appearance">
                                        <div style="width: 135px;">お届け時間帯指定</div>
                                        <div>
                                            <div class="custom_select" id="delivery_time_grp">
                                                <select name="delivery_time" id="delivery_time" class="form-control select-active-payment1" style="width: 200px;">
                                                    @if(!empty($delivery_time))
                                                    <option value="null">指定なし</option>
                                                    @foreach($delivery_time as $d_time)
                                                    <option  value="{{$d_time}}"@if($prev_delivery_time == $d_time){{'selected'}}@endif>{{$d_time}}</option>
                                                    @endforeach
                                                @else
                                                <option value="null">指定できません</option>
                                                @endif 
                                            </select>
                                            </div>
                                            <!-- <textarea name="" style="height: 80px!important;width: 100%;" class="form-control" maxlength="1000"></textarea> -->
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-bottom: 25px;" class="d-none d-md-block">
                        <a href="{{route('checkout')}}" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;">配送先情報へ戻る</a>
                            <a href="#" onclick="createOrder('{{route("createOrder")}}'); event.preventDefault();" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;margin-right:10px;">お支払いへ進む</a>
                            
                        </div>

                    </div>
                <!-- <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>注文詳細</h4>
                        </div> 
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
                                        $file_name = url('../storage/product/images'.'/'.$row->options->file_name);
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
                                    {{-- <tr>
                                        <th colspan="4">
                                            <div style="display: flex;">
                                                <input class="ml-5" type="text" id="checkout_reduction_code"
                                                    name="checkout_reduction_code" placeholder="クーポンコード">
                                                <a href="#" class="btn btn-fill-out btn-block ml-10"
                                                    style="white-space: nowrap;">適用する</a>
                                            </div>
                                        </th>
                                    </tr> --}}

                                    <tr>
                                        <th>
                                            <div>小計</div>
                                            <div style="position: relative;">
                                               
                                            </div>
                                        </th>
                                        <td class="product-subtotal" colspan="3">
                                            <div>￥{{Cart::subtotal(0)}}</div>
                                            {{-- <div>次のステップで計算されます</div> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>合計(税込)</th>
                                        <td colspan="3" class="product-subtotal"><span class="font-xl text-brand fw-900">￥{{Cart::total(0)}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-block d-md-none">
                            <a href="#" onclick="createOrder('{{route("createOrder")}}'); event.preventDefault();" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;margin-right:10px;">お支払いへ進む</a>
                            <a href="{{route('checkout')}}" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;">配送先情報へ戻る</a>
                        </div>
                    </div>
                </div> -->
            </div>
            </form>
        </div>
    </section>
</main>

<!-- The Modal -->
{{-- <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <h3>配送ポリシー</h3>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
      <p>商品の引渡し時期：</p>
      <p>在庫品に関しては、原則として、年末年始・ゴールデンウィークなどの大型連休及び土日祝日を除く、注文受付後、5営業日以内に発送いたします。配送日時の指定は受けておりませんので、予めご了承ください</p>
      <p>お荷物のおまとめについて：</p>
      <p>注文完了後、2つ以上のご注文を1つにまとめて配送することはできません。</p>
    </div>
    <br>
    <br>
    <div class="modal-footer">
    </div>
  </div>
</div> --}}

<script>
// Get the body
var body = document.getElementsByTagName("body");

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("openShippingPolicyModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  document.body.style.overflowY = "hidden";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  document.body.style.overflowY = "auto";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
</script>
<script type="text/javascript">
    // #SI - modified date function starts here
    $(function () {
    // 納期
        $('#datepicker2_oen').datepicker({
            language: 'ja-JP',
            format: 'yyyy/mm/dd',
            autoHide: true,
            zIndex: 10,
            offset: 6,
        });

        $(document).on('change focus', '#datepicker2_oen', function () {
            if ($(this).is('[readonly]')) {
            $(this).datepicker('hide');
            $(this).css("pointer-events", "none");
            }
            else if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('#datepicker2_comShow').val($(this).val());
            let datevalue = $(this).siblings('#datepicker2_comShow').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '');
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
            }
        });

        $(document).on('click', '#datepicker2_oen', function () {
            $(this).datepicker('show');
        });

        $(document).on('keyup', '#datepicker2_oen', function (e) {
            let inputDateValue = $(this).val();  //getting date value from input
            if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('#datepicker2_comShow').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            }
        });
        // Update date value with slash on blur
        $(document).on('blur', '#datepicker2_oen', function () {
            if ($(this).val() != '') {
            $(this).val($(this).siblings('#datepicker2_comShow').val());
            } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('#datepicker2_comShow').val('');
            }
        });
        $("#datepicker2_oen").keydown(function (e) {
            if (e.keyCode == 13) {
            $(this).datepicker('hide');
            }
        });
    });
    </script>

@include('UserPanel/inc/footer')
<script>
    // $('.select-active-payment1').select2();  
// $('.select-active').select2({ minimumResultsForSearch: -1 });
$(".select-active-payment1").select2({
    minimumResultsForSearch: Infinity
});

</script>