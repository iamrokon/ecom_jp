@include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
<style>
    .sticky-bar.stick {
        z-index: 999;
    }
    .custom_select .select2-container {
        max-width: 100%;
    }
    .custom_select .select2-dropdown{
        border: 1px solid #e2e9e1 !important;
    } 
    .custom_select input{
        border: 1px solid #e2e9e1 !important;
    }
    .select2-results__option {
        padding: 12px 5px !important;
    }
   .select2-dropdown .select2-search--dropdown .select2-search__field{
        padding-left:5px !important;
    }
    .custom_select .select2-container--default .select2-selection--single{
        padidng-left:15px !important;
    }
</style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">マイページ</span> 
                </div>
            </div>
        </div>
        <section class="pt-100 pb-100 my-xs-pt30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="dashboard-menu my-xs-mb15">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link @if(request('page') == null) active @endif " id="info-tab" data-bs-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false"><i class="fi-rs-user mr-10"></i>会員情報確認</a>
                                        </li> 
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>パスワード送信フォーム</a>
                                        </li> -->
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="info-edit-tab" data-bs-toggle="tab" href="#info-edit" role="tab" aria-controls="info-edit" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>会員情報変更</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class='nav-link @if(request("page") != null) active @endif' id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>購入履歴</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#change-delivery" role="tab" aria-controls="change-delivery" aria-selected="false"><i class="fi-rs-edit-alt mr-10"></i>お届け先情報変更</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-file-delete mr-10"></i>会員登録解除</a>
                                        </li>

                                        <!-- <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('logoutUser')}}"><i class="fi-rs-sign-out mr-10"></i>ログアウト</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                @php
                                if(request('page') != null){
                                    $info_fade = '';
                                }else{
                                    $info_fade = 'show active';
                                }
                                @endphp
                                <div class="tab-pane fade {{$info_fade}}" id="info" role="tabpanel" aria-labelledby="info-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">会員情報確認</h5>
                                            </div>
                                            <div class="card-body">
                                                <!-- Success Message -->
                                                <div id="user_info" class="alert alert-primary alert-dismissible d-none">
                                                  <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                                                  <strong>登録に成功しました！</strong>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table res-user-table user-resp-table">
                                                        <!-- <tr>
                                                            <td style="width: 30%;">国/地域</td>
                                                            <td>{{$userInfo->address}}</td>
                                                        </tr> -->
                                                        <tr>
                                                            <td style="width: 30%;min-width: 140px;">氏名</td>
                                                            <td style="min-width: 200px;">{{$userInfo->name}}</td>
                                                        </tr> 
                                                        <tr>
                                                            <td>フリガナ</td>
                                                            <td>{{$userInfo->kaka}}</td>
                                                        </tr> 
                                                        <tr>
                                                            <td>メールアドレス</td>
                                                            <td>{{$userInfo->mail}}</td>
                                                        </tr> 
                                                        <tr>
                                                            <td>パスワード</td>
                                                            <td>******</td>
                                                        </tr>
                                                        <tr>
                                                            <td>郵便番号</td>
                                                            <td>@if($userInfo->yubinbango != null){{substr($userInfo->yubinbango,0,3)."-".substr($userInfo->yubinbango,3,4)}}@endif</td>
                                                        </tr> 
                                                        <tr>
                                                            <td>住所</td>
                                                            <td>{{$userInfo->address}}</td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td>会社名 </td>
                                                            <td>{{$userInfo->model}}</td>
                                                        </tr>  -->
                                                      
                                                        <tr>
                                                            <td>電話番号 </td>
                                                            <td>{{$userInfo->tel}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>性別</td>
                                                            <td>{{$userInfo->sex}}</td>
                                                        </tr> 
                                                         <tr>
                                                            <td>生年月日</td>
                                                            <td>{{explode(" ",$userInfo->birthday)[0]}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <a type="button" class="btn btn-fill-out" data-bs-toggle="modal" data-bs-target="#infoEditModal">変更</a>
                                                </div> 
                                               
                                            </div> 
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">パスワード送信フォーム </h5>
                                                <!-- <h5 class="mb-0">Hello {{$userInfo->name}}! </h5> -->
                                            </div>
                                            <form method="post" id='updatePassword'>
                                                @csrf
                                                <input type="hidden" name="temp_email" value="{{$userInfo->mail}}" />
                                                <div class="card-body">
                                                    <div id="error_update_password"></div><br>
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input  class="form-control square" name="password" id="password" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input  class="form-control square" name="npassword" id="npassword" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input  class="form-control square" name="cpassword" id="cpassword" type="password">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" onclick="updateUserPassword()" class="btn btn-fill-out submit" name="submit" value="Submit">保存</button>
                                                    </div>
                                                    <!-- <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div> --}}

                                    @php
                                    if(request('page') != null){
                                        $order_list_fade = 'show active';
                                    }else{
                                        $order_list_fade = '';
                                    }
                                    @endphp
                                    <div class="tab-pane fade {{$order_list_fade}}" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">購入履歴</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="pagination-area mb-15 mb-sm-5 mb-lg-0">
                                                    <nav aria-label="Page navigation example">
                                                        <span class="page-show-item">
                                                            全 {{$total_order}} 件 ({{$orderList->currentPage()}} / {{$orderList->lastPage()}})
                                                        </span>
                                                        <!--
                                                        <ul class="pagination justify-content-start float-end">
                                                            <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">02</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">03</a></li>
                                                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">16</a></li>
                                                            <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                                                        </ul>-->
                                                        {{-- $orderList->appends(request()->input())->links() --}}
                                                        @include('UserPanel//userPagination')
                                                    </nav>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table user-resp-table">
                                                        <thead>
                                                            <tr>
                                                                <th>ご注文日</th>
                                                                <th>ご注文番号</th>
                                                                <th>ステータス</th>
                                                                <th>お問い合せ伝票番号</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($orderList as $order)
                                                            <tr>
                                                                <td>{{substr($order->order_date,0,10)}}</td>
                                                                <td>{{$order->order_no}}</td>
                                                                <td>{{$order->status}}</td>
                                                                <td>{{$order->slip_number}}</td>
                                                                <!-- <td><a href="{{url('orderList/'.$order->order_no)}}" target="_blank" class="btn-small d-block">View</a></td> -->
                                                                <td>
                                                                    <button onclick="orderDetails('{{$order->order_no}}')" class="btn btn-fill-out btn-small" >詳細</button>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">会員登録解除</h5>
                                            </div>
                                            <form method="post" id="memberCancellation">
                                                @csrf
                                                <div class="card-body contact-from-area">
                                                <div id="cancel_member" class="alert alert-primary alert-dismissible d-none">
                                                  <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                                                  <strong>登録に成功しました！</strong>
                                                </div>
                                                    <p style="margin-bottom:15px;">会員登録を解除します。<br>会員情報を削除すると、元に戻すことはできませんので、ご注意ください。</p>
                                                    <div id="error_data" style="padding-bottom: 5px;"></div>
                                                    <div class="table-responsive">
                                                        <table class="table res-user-table user-resp-table">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 30%;min-width: 140px;">メールアドレス <span style="color: red;">※</span></td>
                                                                    <td style="width: 50%;min-width: 200px;"><input name="email" id="email" placeholder="" type="text" class="square"></td>
                                                                    <td style="width: 20%;min-width: 120px;">(半角英数字)</td>
                                                                </tr> 
                                                                <tr>
                                                                    <td>パスワード <span style="color: red;">※</span></td>
                                                                    <td colspan="2"><input name="password" id="password" placeholder="******" type="password" class="square"></td>
                                                                </tr> 
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a type="button" onclick="validateMemberCancellation()" class="btn btn-fill-out" >会員登録解除</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="change-delivery" role="tabpanel" aria-labelledby="change-delivery">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">お届け先情報変更</h5>
                                            </div>
                                            <div class="card-body contact-from-area">

                                                <div id="delivery_add" class="alert alert-primary alert-dismissible d-none">
                                                  <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                                                  <strong>登録に成功しました！</strong>
                                                </div>
                                               
                                                <div class="table-responsive">
                                                    <table class="table res-user-table user-resp-table">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 30%;min-width: 140px;">氏名</td>
                                                                <td style="min-width: 200px;">@if(isset($haisouInfo->name)){{$haisouInfo->name}}@endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>フリガナ</td>
                                                                <td>@if(isset($haisouInfo->furigana)){{$haisouInfo->furigana}}@endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>郵便番号</td>
                                                                <td>@if(isset($haisouInfo->zipcode)){{$haisouInfo->zipcode}}@endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>都道府県</td>
                                                                <td>@if(isset($haisouInfo->prefecture)){{$haisouInfo->prefecture}}@endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>住所</td>
                                                                <td>@if(isset($haisouInfo->address)){{$haisouInfo->address}}@endif</td>
                                                            </tr>
                                                            <tr>
                                                                <td>電話番号</td>
                                                                <td>@if(isset($haisouInfo->tel)){{$haisouInfo->tel}}@endif</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-12">
                                                    <a type="button" id='deliveryAddressOpen' class="btn btn-fill-out" data-bs-toggle="modal" data-bs-target="#deliveryEditModal">変更</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Orders tracking</h5>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id" placeholder="Found in your order confirmation email" type="text" class="square">
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email" placeholder="Email you used during checkout" type="email" class="square">
                                                            </div>
                                                            <button class="submit submit-auto-width" type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Billing Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>{{$userInfo->address}}<br> {{$userInfo->text2}}, <br>Phone: {{$userInfo->yubinbango}}</address>
                                                        <p>{{$userInfo->text3}}</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>{{$userInfo->address}}<br> {{$userInfo->text2}}, <br>Phone: {{$userInfo->yubinbango}}</address>
                                                        <p>{{$userInfo->text3}}</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="error_update_user"></div><br>
                                                <p>Already have an account? <a href="page-login-register.html">Log in instead!</a></p>
                                                <form method="post" id='updateUser'>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>First Name <span class="required">*</span></label>
                                                            <input required="" class="form-control square" name="name" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Last Name <span class="required">*</span></label>
                                                            <input required="" class="form-control square" name="phone">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>User Name <span class="required">*</span></label>
                                                            <input value="{{$userInfo->name}}" id="edit_username" class="form-control square" name="username" type="text">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Email Address <span class="required">*</span></label>
                                                            <input value="{{$userInfo->mail}}" id="edit_email" style="pointer-events: none;" class="form-control square" name="email" type="email">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Current Password <span class="required">*</span></label>
                                                            <input id="edit_cpass" class="form-control square" name="password" type="password">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>New Password <span class="required">*</span></label>
                                                            <input id="edit_npass" class="form-control square" name="npassword" type="password">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Confirm Password <span class="required">*</span></label>
                                                            <input id="edit_conpass" class="form-control square" name="cpassword" type="password">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="button" onclick="updateUser()" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


<!-- Modal -->
<div class="modal fade" id="infoEditModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 610px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-header">
                <h5 class="mb-0">会員情報変更</h5>
            </div>
            <div id="error_update_user" style="padding-left: 9px;"></div><br>
            <form method="post" id='updateUser'>
                @csrf
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table res-user-table user-resp-table">
                            <!-- <tr>
                                <td style="width: 30%;">国/地域</td>
                                <td>
                                    <div class="custom_select">
                                        <select class="js-example-responsive form-control" style="width: 100%">
                                            <option value="日本">日本</option>
                                        </select>
                                    </div>
                                   
                                </td>
                            </tr> -->
                            <tr>
                                <td style="width: 30%;min-width: 130px;">氏名</td>
                                <td style="min-width: 300px;"><input name="name" id="edit_name" value="{{$userInfo->name}}" placeholder="" type="text" class="square"></td>
                            </tr> 
                            <tr>
                                <td>フリガナ</td>
                                <td><input name="furigana" id="edit_furigana" value="{{$userInfo->kaka}}" placeholder="" type="text" class="square"></td>
                            </tr> 
                            <tr>
                                <td>メールアドレス</td>
                                <td><input name="email" id="edit_email" value="{{$userInfo->mail}}" placeholder="" type="text" class="square"></td>
                            </tr>
                            <tr>
                                <td>古いパスワード</td>
                                <td><input name="old_password" value="{{substr($userInfo->passwd,0,6)}}" readonly placeholder="******" type="password" class="square"></td>
                            </tr>
                            <tr>
                                <td>新しいパスワード</td>
                                <td>
                                    <input name="new_password" id="new_password" value="" autocomplete="one-time-code" placeholder="" type="password" class="square mb-1">
                                    <input name="confirm_password" id="confirm_password" value=""  autocomplete="one-time-code" placeholder="もう一度パスワードを入力してください" type="password" class="square">
                                </td>
                                
                            </tr>
                            <tr>
                                <td>郵便番号</td>
                                <td>
                                    <div class="d-flex">
                                        <input name="zipcode1" onkeyup="zipcodeSearch('edit_zipcode1','edit_zipcode2','edit_prefecture','edit_ciadd','edit_address1')" id="edit_zipcode1" value="{{substr($userInfo->yubinbango,0,3)}}" placeholder="000" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="3" type="text" class="square">
                                        <span class="d-flex justify-content-center align-items-center" style="width: 50px">—</span>
                                        <input name="zipcode2" onkeyup="zipcodeSearch('edit_zipcode1','edit_zipcode2','edit_prefecture','edit_ciadd','edit_address1')" id="edit_zipcode2" value="{{substr($userInfo->yubinbango,3,4)}}" placeholder="1111" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="4" type="text" class="square">
                                    </div>
                                </td>
                            </tr> 
                            <tr>
                                <td>都道府県</td>
                                <td>
                                    <div class="custom_select">
                                        <select name="prefecture" id="edit_prefecture" class="js-example-responsive form-control" style="width: 100%">
                                            <option value="">-</option>
                                            <option label="北海道" value="北海道" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '北海道'){{'selected'}}@endif >北海道</option>
                                            <option label="青森県" value="青森県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '青森県'){{'selected'}}@endif >青森県</option>
                                            <option label="岩手県" value="岩手県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '岩手県'){{'selected'}}@endif >岩手県</option>
                                            <option label="宮城県" value="宮城県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '宮城県'){{'selected'}}@endif >宮城県</option>
                                            <option label="秋田県" value="秋田県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '秋田県'){{'selected'}}@endif >秋田県</option>
                                            <option label="山形県" value="山形県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '山形県'){{'selected'}}@endif >山形県</option>
                                            <option label="福島県" value="福島県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '福島県'){{'selected'}}@endif >福島県</option>
                                            <option label="茨城県" value="茨城県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '茨城県'){{'selected'}}@endif >茨城県</option>
                                            <option label="栃木県" value="栃木県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '栃木県'){{'selected'}}@endif >栃木県</option>
                                            <option label="群馬県" value="群馬県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '群馬県'){{'selected'}}@endif >群馬県</option>
                                            <option label="埼玉県" value="埼玉県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '埼玉県'){{'selected'}}@endif >埼玉県</option>
                                            <option label="千葉県" value="千葉県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '千葉県'){{'selected'}}@endif >千葉県</option>
                                            <option label="東京都" value="東京都" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '東京都'){{'selected'}}@endif >東京都</option>
                                            <option label="神奈川県" value="神奈川県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '神奈川県'){{'selected'}}@endif >神奈川県</option>
                                            <option label="新潟県" value="新潟県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '新潟県'){{'selected'}}@endif >新潟県</option>
                                            <option label="富山県" value="富山県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '富山県'){{'selected'}}@endif >富山県</option>
                                            <option label="石川県" value="石川県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '石川県'){{'selected'}}@endif >石川県</option>
                                            <option label="福井県" value="福井県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '福井県'){{'selected'}}@endif >福井県</option>
                                            <option label="山梨県" value="山梨県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '山梨県'){{'selected'}}@endif >山梨県</option>
                                            <option label="長野県" value="長野県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '長野県'){{'selected'}}@endif >長野県</option>
                                            <option label="岐阜県" value="岐阜県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '岐阜県'){{'selected'}}@endif >岐阜県</option>
                                            <option label="静岡県" value="静岡県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '静岡県'){{'selected'}}@endif >静岡県</option>
                                            <option label="愛知県" value="愛知県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '愛知県'){{'selected'}}@endif >愛知県</option>
                                            <option label="三重県" value="三重県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '三重県'){{'selected'}}@endif >三重県</option>
                                            <option label="滋賀県" value="滋賀県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '滋賀県'){{'selected'}}@endif >滋賀県</option>
                                            <option label="京都府" value="京都府" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '京都府'){{'selected'}}@endif >京都府</option>
                                            <option label="大阪府" value="大阪府" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '大阪府'){{'selected'}}@endif >大阪府</option>
                                            <option label="兵庫県" value="兵庫県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '兵庫県'){{'selected'}}@endif >兵庫県</option>
                                            <option label="奈良県" value="奈良県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '奈良県'){{'selected'}}@endif >奈良県</option>
                                            <option label="和歌山県" value="和歌山県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '和歌山県'){{'selected'}}@endif >和歌山県</option>
                                            <option label="鳥取県" value="鳥取県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '鳥取県'){{'selected'}}@endif >鳥取県</option>
                                            <option label="島根県" value="島根県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '島根県'){{'selected'}}@endif >島根県</option>
                                            <option label="岡山県" value="岡山県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '岡山県'){{'selected'}}@endif >岡山県</option>
                                            <option label="広島県" value="広島県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '広島県'){{'selected'}}@endif >広島県</option>
                                            <option label="山口県" value="山口県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '山口県'){{'selected'}}@endif >山口県</option>
                                            <option label="徳島県" value="徳島県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '徳島県'){{'selected'}}@endif >徳島県</option>
                                            <option label="香川県" value="香川県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '香川県'){{'selected'}}@endif >香川県</option>
                                            <option label="愛媛県" value="愛媛県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '愛媛県'){{'selected'}}@endif >愛媛県</option>
                                            <option label="高知県" value="高知県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '高知県'){{'selected'}}@endif >高知県</option>
                                            <option label="福岡県" value="福岡県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '福岡県'){{'selected'}}@endif >福岡県</option>
                                            <option label="佐賀県" value="佐賀県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '佐賀県'){{'selected'}}@endif >佐賀県</option>
                                            <option label="長崎県" value="長崎県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '長崎県'){{'selected'}}@endif >長崎県</option>
                                            <option label="熊本県" value="熊本県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '熊本県'){{'selected'}}@endif >熊本県</option>
                                            <option label="大分県" value="大分県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '大分県'){{'selected'}}@endif >大分県</option>
                                            <option label="宮崎県" value="宮崎県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '宮崎県'){{'selected'}}@endif >宮崎県</option>
                                            <option label="鹿児島県" value="鹿児島県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '鹿児島県'){{'selected'}}@endif >鹿児島県</option>
                                            <option label="沖縄県" value="沖縄県" @if(isset($userInfo->kenadd) && $userInfo->kenadd == '沖縄県'){{'selected'}}@endif >沖縄県</option>
                                        </select>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td>市区町村</td>
                                <td><input name="ciadd" id="edit_ciadd" value="{{$userInfo->ciadd}}" placeholder="" type="text" maxlength="20" class="square"></td>
                            </tr>
                            <tr>
                                <td>町名番地</td>
                                <td><input name="address1" id="edit_address1" value="{{$userInfo->cyouadd}}" placeholder="" type="text" maxlength="50" class="square"></td>
                            </tr>
                            <tr>
                                <td>建物名・部屋番号</td>
                                <td><input name="address2" id="edit_address2" value="{{$userInfo->biladd}}" placeholder="" type="text" maxlength="50" class="square"></td>
                            </tr> 
                            <!-- <tr>
                                <td>電話番号</td>
                                <td><input name="" value="0806582724" placeholder="" type="text" class="square"></td>
                            </tr> -->
                            <tr>
                                <td>電話番号 </td>
                                <!-- <td><input name="phone" id="edit_phone" value="{{$userInfo->tel}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="11" placeholder="" type="text" class="square"></td> -->
                                <td>
                                    <input name="phone" id="edit_phone" value="{{$userInfo->tel}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/^[a-zA-Z1-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="11" placeholder="" type="number" class="square none-triangle">
                                </td>
                                
                            </tr>
                            <tr>
                                <td>性別</td>
                                <td>
                                    <div class="custom_select">
                                        <select name="sex" id="edit_sex" class="js-example-responsive form-control" style="width: 100%">
                                            <option value="">-</option>
                                            <option value="女性" @if($userInfo->sex == '女性'){{'selected'}}@endif>女性</option>
                                            <option value="男性" @if($userInfo->sex == '男性'){{'selected'}}@endif>男性</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>生年月日</td>
                                <td>
                                    @php
                                    $db_year = explode("-",$userInfo->birthday)[0]??"";
                                    $db_month = explode("-",$userInfo->birthday)[1]??"";
                                    $db_day = explode("-",$userInfo->birthday)[2]??"";
                                    @endphp
                                    <div class="d-flex square-parent">
                                        <select name="year" id="edit_year" class="form-select" aria-label="Default select example">
                                            <option value="">-</option>
                                            @for($year = 2021; $year >= 1899; $year--)
                                            <option value="{{$year}}" @if($db_year == $year){{'selected'}}@endif>{{$year}}</option>
                                            @endfor
                                        </select>
                                        <span style="line-height: 40px;padding: 0px 5px;">年</span>
                                       
                                        <select name="month" id="edit_month" class="form-select" aria-label="Default select example">
                                            <option value="">-</option>
                                            @for($month = 1; $month <= 12; $month++)
                                            <option value="{{str_pad($month,2,'0',STR_PAD_LEFT)}}" @if($db_month == $month){{'selected'}}@endif>{{str_pad($month,2,'0',STR_PAD_LEFT)}}</option>
                                            @endfor
                                        </select>
                                        <span style="line-height: 40px;padding: 0px 5px;">月</span>
                                      
                                        <select name="day" id="edit_day" class="form-select" aria-label="Default select example">
                                            <option value="">-</option>
                                            @for($day = 1; $day <= 31; $day++)
                                            <option value="{{str_pad($day,2,'0',STR_PAD_LEFT)}}" @if($db_day == $day){{'selected'}}@endif>{{str_pad($day,2,'0',STR_PAD_LEFT)}}</option>
                                            @endfor
                                        </select>
                                        <span style="line-height: 40px;padding: 0px 5px;">日</span>
                                    </div>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>生年月日</td>
                                <td>
                                    <div class="custom_select">
                                        <select class="js-example-responsive form-control" style="width: 100%">
                                            <option value="女性">女性</option>
                                        </select>
                                    </div>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td>会社名 </td>
                                <td><input name="company_name" value="{{$userInfo->model}}" placeholder="" type="text" class="square"></td>
                            </tr>
                            <tr>
                                <td>電話番号 </td>
                                <td><input name="phone" id="edit_phone" value="{{$userInfo->tel}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="11" placeholder="" type="text" class="square"></td>
                            </tr> -->
                        </table>
                    </div>
                    <div class="col-md-12">
                        <button type="button" onclick="updateUser()" class="btn btn-fill-out submit" name="submit" value="Submit">保存</button>
                    </div>
                </div> 
            </form>
          
        </div>
      </div>
     
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deliveryEditModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 610px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
            <div class="card-header">
                <h5 class="mb-0">お届け先情報変更</h5>
            </div>
            <div id="error_update_haisou" style="padding-left: 9px;"></div><br>
            <form method="post" id='updateHaisouData'>
                <input type="hidden" name="haisou_bango" id="haisou_bango" value="@if(isset($haisouInfo->bango)){{$haisouInfo->bango}}@endif" >
                @csrf
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table res-user-table user-resp-table">
                            <tr>
                                <td style="width: 30%;min-width: 100px;">氏名</td>
                                <td style="min-width: 300px;">
                                    <input name="name" id="haisou_name" value="@if(isset($haisouInfo->name)){{$haisouInfo->name}}@endif" placeholder="" type="text" class="square">
                                    <input id="hidden_haisou_name" value="@if(isset($haisouInfo->name)){{$haisouInfo->name}}@endif" type="hidden" >
                                </td>
                            </tr>
                            <tr>
                                <td>フリガナ</td>
                                <td>
                                    <input name="furigana" id="haisou_furigana" value="@if(isset($haisouInfo->furigana)){{$haisouInfo->furigana}}@endif" placeholder="" type="text" class="square">
                                    <input id="hidden_haisou_furigana" value="@if(isset($haisouInfo->furigana)){{$haisouInfo->furigana}}@endif" type="hidden">
                                </td>
                            </tr> 
                            <tr>
                                <td>郵便番号</td>
                                <td>
                                    <div class="d-flex">
                                        <input name="zipcode_1" id="haisou_zipcode_1" onkeyup="zipcodeSearch('haisou_zipcode_1','haisou_zipcode_2','haisou_prefecture','haisou_address',null,'delivery_address')" value="@if(isset($haisouInfo->zipcode)){{substr($haisouInfo->zipcode,0,3)}}@endif" placeholder="000" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="3" type="text" class="square">
                                        <input id="hidden_haisou_zipcode_1" value="@if(isset($haisouInfo->zipcode)){{substr($haisouInfo->zipcode,0,3)}}@endif" type="hidden">
                                        <span class="d-flex justify-content-center align-items-center" style="width: 50px">—</span>
                                        <input name="zipcode_2" id="haisou_zipcode_2" onkeyup="zipcodeSearch('haisou_zipcode_1','haisou_zipcode_2','haisou_prefecture','haisou_address',null,'delivery_address')" value="@if(isset($haisouInfo->zipcode)){{substr($haisouInfo->zipcode,4,4)}}@endif" placeholder="1111" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="4" type="text" class="square">
                                        <input id="hidden_haisou_zipcode_2" value="@if(isset($haisouInfo->zipcode)){{substr($haisouInfo->zipcode,4,4)}}@endif" type="hidden">
                                    </div>
                                </td>
                            </tr> 
                            <tr>
                                <td>都道府県</td>
                                <td>
                                    <div class="custom_select" id="haisou_prefecture_grp">
                                        <input id="hidden_haisou_prefecture" value="@if(isset($haisouInfo->prefecture)){{$haisouInfo->prefecture}}@endif" type="hidden" >
                                        <select name="prefecture" id="haisou_prefecture" class="form-control select-active" style="width: 100%;">
                                            <option value="">-</option>
                                            <option label="北海道" value="北海道" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '北海道'){{'selected'}}@endif >北海道</option>
                                            <option label="青森県" value="青森県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '青森県'){{'selected'}}@endif >青森県</option>
                                            <option label="岩手県" value="岩手県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '岩手県'){{'selected'}}@endif >岩手県</option>
                                            <option label="宮城県" value="宮城県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '宮城県'){{'selected'}}@endif >宮城県</option>
                                            <option label="秋田県" value="秋田県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '秋田県'){{'selected'}}@endif >秋田県</option>
                                            <option label="山形県" value="山形県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '山形県'){{'selected'}}@endif >山形県</option>
                                            <option label="福島県" value="福島県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '福島県'){{'selected'}}@endif >福島県</option>
                                            <option label="茨城県" value="茨城県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '茨城県'){{'selected'}}@endif >茨城県</option>
                                            <option label="栃木県" value="栃木県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '栃木県'){{'selected'}}@endif >栃木県</option>
                                            <option label="群馬県" value="群馬県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '群馬県'){{'selected'}}@endif >群馬県</option>
                                            <option label="埼玉県" value="埼玉県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '埼玉県'){{'selected'}}@endif >埼玉県</option>
                                            <option label="千葉県" value="千葉県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '千葉県'){{'selected'}}@endif >千葉県</option>
                                            <option label="東京都" value="東京都" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '東京都'){{'selected'}}@endif >東京都</option>
                                            <option label="神奈川県" value="神奈川県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '神奈川県'){{'selected'}}@endif >神奈川県</option>
                                            <option label="新潟県" value="新潟県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '新潟県'){{'selected'}}@endif >新潟県</option>
                                            <option label="富山県" value="富山県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '富山県'){{'selected'}}@endif >富山県</option>
                                            <option label="石川県" value="石川県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '石川県'){{'selected'}}@endif >石川県</option>
                                            <option label="福井県" value="福井県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '福井県'){{'selected'}}@endif >福井県</option>
                                            <option label="山梨県" value="山梨県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '山梨県'){{'selected'}}@endif >山梨県</option>
                                            <option label="長野県" value="長野県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '長野県'){{'selected'}}@endif >長野県</option>
                                            <option label="岐阜県" value="岐阜県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '岐阜県'){{'selected'}}@endif >岐阜県</option>
                                            <option label="静岡県" value="静岡県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '静岡県'){{'selected'}}@endif >静岡県</option>
                                            <option label="愛知県" value="愛知県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '愛知県'){{'selected'}}@endif >愛知県</option>
                                            <option label="三重県" value="三重県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '三重県'){{'selected'}}@endif >三重県</option>
                                            <option label="滋賀県" value="滋賀県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '滋賀県'){{'selected'}}@endif >滋賀県</option>
                                            <option label="京都府" value="京都府" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '京都府'){{'selected'}}@endif >京都府</option>
                                            <option label="大阪府" value="大阪府" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '大阪府'){{'selected'}}@endif >大阪府</option>
                                            <option label="兵庫県" value="兵庫県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '兵庫県'){{'selected'}}@endif >兵庫県</option>
                                            <option label="奈良県" value="奈良県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '奈良県'){{'selected'}}@endif >奈良県</option>
                                            <option label="和歌山県" value="和歌山県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '和歌山県'){{'selected'}}@endif >和歌山県</option>
                                            <option label="鳥取県" value="鳥取県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '鳥取県'){{'selected'}}@endif >鳥取県</option>
                                            <option label="島根県" value="島根県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '島根県'){{'selected'}}@endif >島根県</option>
                                            <option label="岡山県" value="岡山県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '岡山県'){{'selected'}}@endif >岡山県</option>
                                            <option label="広島県" value="広島県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '広島県'){{'selected'}}@endif >広島県</option>
                                            <option label="山口県" value="山口県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '山口県'){{'selected'}}@endif >山口県</option>
                                            <option label="徳島県" value="徳島県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '徳島県'){{'selected'}}@endif >徳島県</option>
                                            <option label="香川県" value="香川県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '香川県'){{'selected'}}@endif >香川県</option>
                                            <option label="愛媛県" value="愛媛県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '愛媛県'){{'selected'}}@endif >愛媛県</option>
                                            <option label="高知県" value="高知県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '高知県'){{'selected'}}@endif >高知県</option>
                                            <option label="福岡県" value="福岡県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '福岡県'){{'selected'}}@endif >福岡県</option>
                                            <option label="佐賀県" value="佐賀県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '佐賀県'){{'selected'}}@endif >佐賀県</option>
                                            <option label="長崎県" value="長崎県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '長崎県'){{'selected'}}@endif >長崎県</option>
                                            <option label="熊本県" value="熊本県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '熊本県'){{'selected'}}@endif >熊本県</option>
                                            <option label="大分県" value="大分県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '大分県'){{'selected'}}@endif >大分県</option>
                                            <option label="宮崎県" value="宮崎県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '宮崎県'){{'selected'}}@endif >宮崎県</option>
                                            <option label="鹿児島県" value="鹿児島県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '鹿児島県'){{'selected'}}@endif >鹿児島県</option>
                                            <option label="沖縄県" value="沖縄県" @if(isset($haisouInfo->prefecture) && $haisouInfo->prefecture == '沖縄県'){{'selected'}}@endif >沖縄県</option>
                                        </select>
                                    </div>
                                </td>
                            </tr> 
                            <tr>
                                <td>住所</td>
                                <td>
                                    <input name="address" id="haisou_address" value="@if(isset($haisouInfo->address)){{$haisouInfo->address}}@endif" placeholder="" type="text" class="square">
                                    <input id="hidden_haisou_address" value="@if(isset($haisouInfo->address)){{$haisouInfo->address}}@endif" type="hidden">
                                </td>
                            </tr>
                            <tr>
                                <td>電話番号</td>
                                <td>
                                     <!-- <input type="text" maxlength="11" name="phone" id="haisou_phone" value="@if(isset($haisouInfo->tel)){{$haisouInfo->tel}}@endif" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" placeholder=""> -->
                                     <input type="number" maxlength="11" name="phone" id="haisou_phone" value="@if(isset($haisouInfo->tel)){{$haisouInfo->tel}}@endif" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); this.value = this.value.replace(/^[a-zA-Z1-9]/g, '').replace(/(\..*?)\..*/g, '$1')" placeholder="" class="square none-triangle">
                                    <input type="hidden" id="hidden_haisou_phone" value="@if(isset($haisouInfo->tel)){{$haisouInfo->tel}}@endif" >
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <button type="button" onclick='updateHaisouData()' class="btn btn-fill-out submit" name="submit">保存</button>
                    </div>
                </div> 
            </form>
          
        </div>
      </div>
     
    </div>
  </div>
</div>

<!-- Modal -->
<div id="orderDetailsModal">
    @include('UserPanel/orderDetails')
</div>

<!-- Modal -->
<div class="modal fade" id="membershipModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 450px;">
    <div class="modal-content">
      <div class="modal-header" style="border: 0;padding: 15px 15px 5px;">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div class="mb-25">
            本当にメンバーシップを削除しますか
        </div>

          <button onclick="memberCancellation()" type="button" class="btn btn-fill-out submit" name="submit" value="Submit">はい</button>
        <button onclick="hideMemberCancellation()" type="button" class="btn btn-fill-out submit" name="" value="">いいえ</button>
      </div>
    </div>
  </div>
</div>

@include('UserPanel/inc/footer')