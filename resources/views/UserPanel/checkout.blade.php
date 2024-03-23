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
    width: 100% !important;
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

  .check-log-reg a{
    font-size: 16px;
    font-weight: 600;
  }

  #loginform,
  #registrationForm{
    display: none;
  }
</style>
<main class="main">
    <!--  goto payment page -->
    <form action="{{route('payment')}}" method="POST" id="goToPayment" >
      @csrf
      <input type="hidden" id="userId" name="user_id" value="">
      <!--<input type="hidden" id="haisouBango" name="haisou_bango">-->
    </form>
    
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('homepage')}}" id="checkout_home" rel="nofollow">トップ</a>
                <span class="active">配送先情報</span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50 my-xs-mt30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-sm-15 my-xs-mb0">
                    {{-- @if(!isset($userInfo->mail))
                    <div class="toggle_info">
                        <span>
                          <i class="fi-rs-user mr-10" style="color: #000;"></i><span style="color: #000;">すでにこちらにアカウントをお持ちですか？</span>
                            <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">ログイン</a>
                        </span>
                    </div>
                    @endif --}}
                    @if(!isset($userInfo->mail))
                    <div class="check-log-reg">
                        <!-- <a href="#loginform" data-bs-toggle="collapse" class="collapsed log-collapsed" aria-expanded="false">会員の方はこちらからログイン</a> -->
                        <a class="log-collapsed mr-30">会員の方はこちらからログイン</a>
                        <a class="reg-collapsed">新規会員登録される方はこちら</a>
                    </div>

                    <div class="panel-collapse collapse login_form" id="loginform">
                        <div class="mt-30">
                            <p>
                                会員ログイン<br>
                                会員の方は、登録時に入力されたメールアドレスとパスワードでログインしてください。
                            </p>
                        </div>
                        <div class="panel-body mt-15">
                            <div id="login_error_data" style="margin-bottom: 10px;"></div>
                            <!-- <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p> -->
                            <form method="post" id="userLogin">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" id="login_email" placeholder="メールアドレス">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="login_password" placeholder="パスワード">
                                </div>
                                <!-- <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                                <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                            </div>
                                        </div>
                                        <a href="#">Forgot password?</a>
                                    </div> -->
                                <div class="form-group">
                                    <button type="button" onclick="userLogin('checkout')" class="btn btn-md"
                                        name="login">ログイン</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-right" style="padding-top: 5px;text-align:right;">
                            <a href="{{route('resetPassword')}}" style="text-decoration: underline;">パスワードを忘れた方はこちら</a>
                        </div>
                    </div>
                    <div class="panel-collapse collapse login_form" id="registrationForm">
                        <div class="mt-30">
                            <p>新規会員登録</p>
                        </div>
                        <div class="panel-body mt-15">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3 class="mb-30">アカウントを作成</h3>
                                </div>
                                <div id="error_data" style="margin-bottom: 10px;"></div>
                                <!--<p class="mb-50 font-sm">
                                    Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy
                                </p>-->
                                <form method="post" id='userRegister'>
                                    @csrf
                                    <div class="form-group" >
                                        <input type="text" id="reg_username" required="" name="username" placeholder="名前">
                                        <span id="err_username" class="input-error-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="reg_email" required="" name="email" placeholder="メールアドレス">
                                        <span id="err_email" class="input-error-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <input required="" id="reg_password" type="password" name="password" placeholder="パスワード">
                                        <span id="err_password" class="input-error-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <input required="" id="reg_con_password" type="password" name="confirm_password" placeholder="もう一度パスワードを入力してください">
                                        <span id="err_con_password" class="input-error-message"></span>
                                    </div>
                                    <!--<div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                            </div>
                                        </div>
                                        <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                    </div>-->
                                    <div class="form-group">
                                        <button type="button" onclick="userRegister()" class="btn btn-fill-out btn-block hover-up" name="login">作成する</button>
                                    </div>
                                </form>
                                
                                <!--<div class="divider-text-center mt-15 mb-15">
                                    <span> or</span>
                                </div>
                                <ul class="btn-login list_none text-center mb-15">
                                    <li><a href="#" class="btn btn-facebook hover-up mb-lg-0 mb-sm-4">Login With Facebook</a></li>
                                    <li><a href="#" class="btn btn-google hover-up">Login With Google</a></li>
                                </ul>
                                <div class="text-muted text-center">Already have an account? <a href="#">Sign in now</a></div>
                                -->
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @if(!isset($userInfo->mail))
            <div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50 my-xs-mt-15 my-xs-mb20"></div>
                </div>
            </div>
            @endif
       
            <form method="post" id="placeOrder">
                @csrf
                <div class="row">
                    <div id="placeorder_error_data" style="margin-bottom: 10px;margin-left: -8px;"></div>
                        <div class="col-md-6">
                            <!-- <div class="form-group">
                                <label style="font-weight: bold;"><span>国/地域</span></label>
                                <div class="col-md-12">
                                    <div class="custom_select">
                                        <select name="country" class="form-control select-active">
                                        <option value="">Choose an option...</option> 
                                        <option value="日本">日本</option>
                                        </select>
                                    </div>
                                    <span class="input-error-message"></span>
                                </div>
                            </div>
                            <div class="mb-25">
                                <h4 class="mb-10">ご注文者様・配送先情報の入力</h4>
                                <h4>ご注文者様情報</h4>
                            </div> -->
                            <!--<form method="post">-->

                            <!-- @if(isset($userInfo->mail))
                            <div class="form-group round-radio-check">
                                <div class="col-md-12 d-flex">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="shipping_destination" value="same" id="shipToCurrentAddress" @if(isset($userInfo->mail)){{'checked'}}@endif>
                                        <label class="form-check-label inner-circle" for="shipToCurrentAddress" data-bs-toggle="collapse" data-target="#shipToCurrentAddress" aria-controls="shipToCurrentAddress"><span class="radio-text">現在の住所に発送</span></label>
                                    </div>
                                    <div class="custome-radio ml-20">
                                        <input class="form-check-input" required="" type="radio" name="shipping_destination" value="different" id="addNewAddress">
                                        <label class="form-check-label inner-circle" for="addNewAddress" data-bs-toggle="collapse" data-target="#addNewAddress" aria-controls="addNewAddress"><span class="radio-text">新しい届け先住所を追加</span></label>
                                    </div>
                                </div>
                            </div>
                            @endif -->
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>氏名</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="name" id="name" value="@if(isset($shippingInfo['name'])){{$shippingInfo['name']}}@elseif(isset($userInfo->name)){{$userInfo->name}}@endif" placeholder="氏名">
                                    <input type="hidden" id="temp_name" value="@if(isset($userInfo['name'])){{$userInfo->name}}@endif">
                                    <span id="err_name" class="input-error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>フリガナ</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="furigana" id="furigana" value="@if(isset($shippingInfo['furigana'])){{$shippingInfo['furigana']}}@elseif(isset($userInfo->name)){{$userInfo->kaka}}@endif" placeholder="フリガナ">
                                    <input type="hidden" id="temp_furigana" value="@if(isset($userInfo['kaka'])){{$userInfo->kaka}}@endif">
                                    <span id="err_furigana" class="input-error-message"></span>
                                </div>
                            </div>
                            
                            <div id="email_grp" class="form-group" >
                                <label style="font-weight: bold;"><span>メールアドレス</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="email" id="email" value="@if(isset($shippingInfo['email'])){{$shippingInfo['email']}}@elseif(isset($userInfo->mail)){{$userInfo->mail}}@endif" placeholder="メールアドレス">
                                    <span id="err_email" class="input-error-message"></span>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>郵便番号</span></label>
                                <div class="col-md-12 d-flex">
                                    <input name="zipcode1" onkeyup="zipcodeSearch('zipcode_first_part','zipcode_second_part','prefecture','address1','address2')" 
                                        id="zipcode_first_part" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="3"
                                        type="text" value="@if(isset($shippingInfo['zipcode1'])){{$shippingInfo['zipcode1']}}@elseif(isset($userInfo->yubinbango)){{substr($userInfo->yubinbango,0,3)}}@endif"
                                        placeholder="000">
                                    <input type="hidden" id="temp_zipcode1" value="@if(isset($userInfo['yubinbango'])){{substr($userInfo->yubinbango,0,3)}}@endif">
                                    <span class="d-flex justify-content-center align-items-center"
                                        style="width: 50px">—</span>
                                    <input name="zipcode2" onkeyup="zipcodeSearch('zipcode_first_part','zipcode_second_part','prefecture','address1','address2')" 
                                        id="zipcode_second_part" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="4"
                                        type="text" value="@if(isset($shippingInfo['zipcode2'])){{$shippingInfo['zipcode2']}}@elseif(isset($userInfo->yubinbango)){{substr($userInfo->yubinbango,3,4)}}@endif" 
                                        placeholder="1111">
                                    <input type="hidden" id="temp_zipcode2" value="@if(isset($userInfo['yubinbango'])){{substr($userInfo->yubinbango,3,4)}}@endif">
                                </div>
                                <span id="err_zipcode1" class="input-error-message" style="display:block;"></span>
                                <span id="err_zipcode2" class="input-error-message"></span>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>都道府県</span></label>
                                <div class="col-md-12">
                                    <div class="custom_select" id="prefecture_grp">
                                        <select name="prefecture" id="prefecture" class="form-control select-active">
                                            <option value="">-</option>
                                            @foreach($ken_name as $key=>$val)
                                            <option label="{{$val}}" value="{{$val}}" @if(isset($shippingInfo['prefecture']) && $shippingInfo['prefecture']==$val) selected="selected" @elseif(isset($userInfo->kenadd) && $userInfo->kenadd==$val) selected="selected" @endif>{{$val}}</option>
                                            @endforeach
                                    </select>
                                        <input type="hidden" id="temp_prefecture" value="@if(isset($userInfo['kenadd'])){{$userInfo->kenadd}}@endif">
                                    </div>
                                    <span id="err_prefecture" class="input-error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>市区町村</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="address1" id="address1" value="@if(isset($shippingInfo['address1'])){{$shippingInfo['address1']}}@elseif(isset($userInfo->ciadd)){{$userInfo->ciadd}}@endif" placeholder="市区町村" maxlength="50">
                                    <input type="hidden" id="temp_address1" value="@if(isset($userInfo['ciadd'])){{$userInfo->ciadd}}@endif">
                                    <span id="err_address1" class="input-error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>町名番地</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="address2" id="address2" value="@if(isset($shippingInfo['address2'])){{$shippingInfo['address2']}}@elseif(isset($userInfo->cyouadd)){{$userInfo->cyouadd}}@endif" placeholder="町名番地" maxlength="50">
                                    <input type="hidden" id="temp_address2" value="@if(isset($userInfo['cyouadd'])){{$userInfo->cyouadd}}@endif">
                                    <span id="err_address2" class="input-error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>建物名・部屋番号</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="biladd" value="@if(isset($shippingInfo['biladd'])){{$shippingInfo['biladd']}}@elseif(isset($userInfo->biladd)){{$userInfo->biladd}}@endif" id="biladd" placeholder="建物名・部屋番号" maxlength="50">
                                    <span id="err_biladd" class="input-error-message"></span>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label style="font-weight: bold;"><span>会社名:（オプション）</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="company_name" id="company_name" value="@if(isset($shippingInfo['company_name'])){{$shippingInfo['company_name']}}@elseif(isset($userInfo->model)){{$userInfo->model}}@endif" placeholder="会社名:（オプション）" maxlength="50">
                                    <input type="hidden" id="temp_company_name" value="@if(isset($userInfo['model'])){{$userInfo->model}}@endif">
                                    <span id="err_company_name" class="input-error-message"></span>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label style="font-weight: bold;"><span>電話番号</span></label> 
                                <label style="color: #7367f0;float:right;"><span>ハイフン（-）なしで入力してください</span></label>
                                <div class="col-md-12">
                                <!-- <input type="number" maxlength="11" name="phone" id="phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/^[a-zA-Z1-9]/g, '').replace(/(\..*?)\..*/g, '$1')" value="@if(isset($shippingInfo['phone'])){{$shippingInfo['phone']}}@elseif(isset($userInfo->tel)){{$userInfo->tel}}@endif" placeholder="電話番号" class="square none-triangle"> -->
                                    <input type="text" maxlength="11" name="phone" id="phone" onkeyup="validate()" value="@if(isset($shippingInfo['phone'])){{$shippingInfo['phone']}}@elseif(isset($userInfo->tel)){{$userInfo->tel}}@endif" placeholder="電話番号" class="square none-triangle">
                                    <input type="hidden" id="temp_phone" value="@if(isset($userInfo['tel'])){{$userInfo->tel}}@endif">
                                    <span id="err_phone" class="input-error-message"></span>
                                </div>
                            </div>
                         
                            <div class="form-group mt-40">
                                <div class="col-md-12">
                                    <h4 class="mb-10">配送先情報</h4>
                                    <p>お届け先を選択してください。</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="payment_option radio-circle">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="custome-radio mb-0">
                                                            <input class="form-check-input diffRadion1" required="" type="radio" name="address_option" id="exampleRadios3" @if(isset($shippingInfo["address_option"]) && $shippingInfo["address_option"]=="1")checked="checked" @else checked="checked" @endif value="1">
                                                            <label class="form-check-label mb-0" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer"><span class="radio-text">ご注文者に発送</span></label>  
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="custome-radio mb-0">
                                                            <input class="form-check-input diffRadion2" required="" type="radio" name="address_option" @if(isset($shippingInfo['address_option']) && $shippingInfo['address_option']=='2')checked="checked" @endif  id="exampleRadios4" value="2">
                                                            <label class="form-check-label mb-0" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment"><span class="radio-text">別なお届け先に発送</span></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if(\Session::get('userlogin'))
                            <div class="different-info form-group @if(isset($shippingInfo['address_option']) && $shippingInfo['address_option']=='2') @else d-none @endif ">
                                <label style="font-weight: bold;"><span>新規登録／過去のお届け先</span></label>
                                <div class="col-md-12">
                                    <div class="custom_select" id="prefecture_grp">
                                        <select name="receiver" onchange="callTheAddress(this)" id="receiver" class="form-control select-active">
                                            <option value="new">新規登録</option>
                                            @foreach($haisous as $haisou)
                                            <option value="{{$haisou->bango}}" @if(isset($shippingInfo['receiver']) && $shippingInfo['receiver']==$haisou->bango) selected="selected" @endif>{{$haisou->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="different-info-detail @if(isset($shippingInfo['address_option']) && $shippingInfo['address_option']=='2') @else d-none @endif ">
                                
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>氏名</span></label>
                                    <div class="col-md-12">
                                        <input type="text" name="diff2_name" id="diff2_name" value="@if(isset($shippingInfo['diff2_name'])){{$shippingInfo['diff2_name']}}@endif" placeholder="氏名">
                                        <!-- <input type="hidden" id="temp_name" value="@if(isset($userInfo['name'])){{$userInfo->name}}@endif"> -->
                                        <span id="err_diff2_name" class="input-error-message"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>フリガナ</span></label>
                                    <div class="col-md-12">
                                        <input type="text" name="diff2_furigana" id="diff2_furigana" value="@if(isset($shippingInfo['diff2_furigana'])){{$shippingInfo['diff2_furigana']}}@endif" placeholder="フリガナ">
                                 
                                        <span id="err_diff2_furigana" class="input-error-message"></span> 
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                <div id="email_grp" class="form-group" >
                                <label style="font-weight: bold;"><span>メールアドレス</span></label>
                                <div class="col-md-12">
                                    <input type="text" name="diff2_email" id="diff2_email" value="@if(isset($shippingInfo['diff2_email'])){{$shippingInfo['diff2_email']}}@endif" placeholder="メールアドレス">
                                    <span id="err_email" class="input-error-message"></span>
                                </div>
                                </div>
                                </div> -->
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>郵便番号</span></label>
                                    <div class="col-md-12 d-flex">
                                        <input name="diff2_zipcode1" onkeyup="zipcodeSearch('diff2_zipcode_first_part','diff2_zipcode_second_part','diff2_prefecture','diff2_address1','diff2_address2')" id="diff2_zipcode_first_part" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" placeholder="000" maxlength="3" type="text" value="@if(isset($shippingInfo['diff2_zipcode1'])){{$shippingInfo['diff2_zipcode1']}}@endif">
                                        <span class="d-flex justify-content-center align-items-center" style="width: 50px">—</span>
                                        <input id="diff2_zipcode_second_part" name="diff2_zipcode2" onkeyup="zipcodeSearch('diff2_zipcode_first_part','diff2_zipcode_second_part','diff2_prefecture','diff2_address1','diff2_address2')" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="4" type="text" value="@if(isset($shippingInfo['diff2_zipcode2'])){{$shippingInfo['diff2_zipcode2']}}@endif" placeholder="1111">
                                    </div>
                                    
                                    <span id="err_diff2_zipcode1" class="input-error-message" style="display:block;"></span>
                                    <span id="err_diff2_zipcode2" class="input-error-message"></span> 
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>都道府県</span></label>
                                    <div class="col-md-12">
                                        <div class="custom_select" id="diff2_prefecture_grp">
                                            <select name="diff2_prefecture" id="diff2_prefecture" class="form-control select-active">
                                                <option value="">-</option>
                                                @foreach($ken_name as $key=>$val)
                                            <option label="{{$val}}" value="{{$val}}" @if(isset($shippingInfo['diff2_prefecture']) && $shippingInfo['diff2_prefecture']==$val) selected="selected" @endif>{{$val}}</option>
                                            @endforeach
                                            </select>
                                           <!--  <input type="hidden" id="temp_diff2_prefecture" value="@if(isset($userInfo['kenadd'])){{$userInfo->kenadd}}@endif"> -->
                                            
                                        </div>
                                        <!-- s -->
                                        <span id="err_diff2_prefecture" class="input-error-message"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>市区町村</span></label>
                                    <div class="col-md-12">
                                        <input type="text" name="diff2_address1" id="diff2_address1" value="@if(isset($shippingInfo['diff2_address1'])){{$shippingInfo['diff2_address1']}}@endif" placeholder="市区町村" maxlength="50">
                                       
                                  
                                        <span id="err_diff2_address1" class="input-error-message"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>町名番地</span></label>
                                    <div class="col-md-12">
                                        <input type="text" name="diff2_address2" id="diff2_address2" value="@if(isset($shippingInfo['diff2_address2'])){{$shippingInfo['diff2_address2']}}@endif" placeholder="町名番地" maxlength="50">
                                        
                          
                                        <span id="err_diff2_address2" class="input-error-message"></span> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>建物名・部屋番号</span></label>
                                    <div class="col-md-12">
                                        <input type="text" name="diff2_biladd" value="@if(isset($shippingInfo['diff2_biladd'])){{$shippingInfo['diff2_biladd']}}@endif" id="diff2_biladd" placeholder="建物名・部屋番号" maxlength="50">
                                       
                                      
                                        <span id="err_diff2_biladd" class="input-error-message"></span>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label style="font-weight: bold;"><span>会社名:（オプション）</span></label>
                                    <div class="col-md-12">
                                        <input type="text" name="diff2_company_name" id="diff2_company_name" value="@if(isset($shippingInfo['diff2_company_name'])){{$shippingInfo['diff2_company_name']}}@elseif(isset($userInfo->model)){{$userInfo->model}}@endif" placeholder="会社名:（オプション）" maxlength="50">
                                       

                                        <span id="err_diff2_company_name" class="input-error-message"></span> 
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label style="font-weight: bold;"><span>電話番号</span></label>
                                    <label style="color: #7367f0;float:right;"><span>ハイフン（-）なしで入力してください</span></label>
                                    <div class="col-md-12">
                              
                                        <input type="text" maxlength="11" name="diff2_phone" id="diff2_phone" onkeyup="validate2()" value="@if(isset($shippingInfo['diff2_phone'])){{$shippingInfo['diff2_phone']}}@endif" placeholder="電話番号" class="square none-triangle">
                                      

                                        <span id="err_diff2_phone" class="input-error-message"></span> 
                                    </div>
                                </div>
                            </div>
                           

                            <div class="form-group">
                                <div class="col-md-12">
                                    <a href="{{route('cartItemList')}}" class="btn btn-fill-out btn-block btn-proceed mb-2" style="white-space: nowrap;">カートに戻る</a>
                                    <a href="#" onclick="placeOrder('{{route('placeOrder')}}')"class="btn btn-fill-out btn-block btn-proceed mr-10 mb-2" style="white-space: nowrap;">配送日時指定へ進む</a>
                                    {{-- <span><a href="#" class="ml-10" style="white-space: nowrap;">カートに戻る</a></span> --}}
                                </div>
                            </div>

                            {{-- <div class="form-group" id="reg_email">
                                        <input @if(isset($userInfo->mail)){{'readonly'}}@endif type="text" name="email"
                            value="@if(isset($userInfo->mail)){{$userInfo->mail}}@endif" placeholder="Email address *">
                        </div> --}}
                    </div>
                    <div class="col-md-6">
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
                                            <p style="text-align:left;color: #7367f0;">{{$row->name}}</p>
                                            <div style="text-align:left;">{{$row->options->size}}/{{$row->options->color}}</div>
                                        </td>
                                        <td><span class="product-qty">{{$row->qty}}</span></td>
                                        <td>￥{{number_format($row->price*$row->qty)}}</td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                                <td class="image product-thumbnail"><img src="assets/imgs/shop/product-2-1.jpg" alt="#"></td>
                                                <td>
                                                    <h5><a href="shop-product-full.html">LDB MOON Women Summe</a></h5> <span class="product-qty">x 1</span>
                                                </td>
                                                <td>￥65.00</td>
                                            </tr>
                                            <tr>
                                                <td class="image product-thumbnail"><img src="assets/imgs/shop/product-3-1.jpg" alt="#"></td>
                                                <td><i class="ti-check-box font-small text-muted mr-10"></i>
                                                    <h5><a href="shop-product-full.html">Women's Short Sleeve Loose</a></h5> <span class="product-qty">x 1</span>
                                                </td>
                                                <td>￥35.00</td>
                                            </tr> --}}

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
                                            {{-- <div style="position: relative;">
                                                <span>配送料
                                                    <a href="#" id="openShippingPolicyModal">
                                                        <span style="font-size: .9em; font-weight: 500; line-height: 1.75em; white-space: nowrap; text-align: center; border-radius: 50%; background-color: rgba(114,114,114,.9); color: #fff;-webkit-box-sizing: border-box; box-sizing: border-box; min-width: 1.75em; height: 1.75em; padding: 0 0.4em; z-index: 3;">?</span>
                                                    </a>
                                                </span>
                                            </div> --}}
                                        </th>
                                        <td class="product-subtotal" colspan="3">
                                            <div>￥{{Cart::subtotal(0)}}</div>
                                            {{-- <div>次のステップで計算されます</div> --}}
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                                <th>Shipping</th>
                                                <td colspan="2"><em>Free Shipping</em></td>
                                            </tr> --}}
                                    <tr>
                                        <th>合計(税込)</th>
                                        <td colspan="3" class="product-subtotal"><span
                                                class="font-xl text-brand fw-900">￥{{Cart::total(0)}}</span></td>
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

function validate(){
    var validNumber = document.getElementById("phone")
    var inputValue = validNumber.value.toString();
    regx = /^((?![1-9])[0-9]+)$/g;
    if (!regx.test(inputValue)) {
      validNumber.value = '';
    }
  }
  function validate2(){
    var validNumber = document.getElementById("diff2_phone")
    var inputValue = validNumber.value.toString();
    regx = /^((?![1-9])[0-9]+)$/g;
    if (!regx.test(inputValue)) {
      validNumber.value = '';
    }
  }
</script>
@include('UserPanel/inc/footer')

<script>
$('.log-collapsed').click(function(){
    $("#loginform").toggle();
    $(".reg-collapsed").show();
    $("#registrationForm").hide();
    $(".log-collapsed").hide();
});

$('.reg-collapsed').click(function(){
    $("#registrationForm").toggle();
    $(".log-collapsed").show();
    $("#loginform").hide();
    $(".reg-collapsed").hide();
});

// $('.reg-collapsed').click(function(){
//     $(".check-reg-log").remove();
// });
</script>