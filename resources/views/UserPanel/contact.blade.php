@include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">お問い合わせ</span> 
                </div>
            </div>
        </div>
        <section class="bg-green contact-content-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="text-center">
                            <!-- <h4 class="text-brand mb-20">Get in touch</h4> -->
                            <h3 class="mb-10 wow fadeIn animated">
                                お問い合わせ
                            </h3>
                            <p>個人情報の取り扱いに関しては、<a href="{{route('privacyPolicy')}}">プライバシーポリシー</a>をご確認ください。</p>
                            <p class="wow fadeIn animated">受付順にご対応させていただいておりますが、確認が必要なお問い合わせや、混雑具合によってご対応にお時間をいただく場合がございます。 <br>土曜日・日曜日・祝祭日・夏季休業・年末年始をはさむ場合は、対応にお時間をいただくことがございます。あらかじめご了承ください。</p>
                            <!-- <p class="wow fadeIn animated">
                                <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="{{route('about')}}">About Us</a>
                                <a class="btn btn-outline btn-lg btn-brand-outline font-weight-bold text-brand bg-white text-hover-white ml-15 border-radius-5 btn-shadow-brand hover-up">Support Center</a>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="contact-form-section pt-30 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="contact-from-area padding-20-row-col wow FadeInUp">
                            <!-- <h3 class="mb-10 text-center">私たちに連絡してください</h3> -->
                            <div id="contact_error_data" style="margin-bottom: 10px;"></div>
                            <!-- Success Message -->
                            @if(Session::has('success_mail'))
                            <div class="alert alert-primary alert-dismissible">
                              <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                              <strong>{{session()->get('success_mail')}}</strong>
                            </div>
                            @endif
                            <form class="contact-form-style text-center" id="contactMail" action="#" method="post">
                                <input type="hidden" name="_token" id="contactCsrf" value="{{csrf_token()}}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="name" id="contact_name" placeholder="名前" type="text">
                                            <span id="err_name" class="input-error-message" style="float: left;padding-bottom: 10px;"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="email" id="contact_email" placeholder="メール" type="email">
                                            <span id="err_email" class="input-error-message" style="float: left;padding-bottom: 10px;"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="phone" id="contact_phone" placeholder="電話" type="text" oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="11">
                                            <span id="err_phone" class="input-error-message" style="float: left;padding-bottom: 10px;"></span>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12">
                                        <div class="input-style mb-20">
                                            <input name="subject" id="contact_subject" placeholder="件名" type="text">
                                            <span id="err_subject" class="input-error-message" style="float: left;padding-bottom: 10px;"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="textarea-style mb-30">
                                            <textarea name="message" id="contact_message" placeholder="メッセージ"></textarea>
                                            <span id="err_message" class="input-error-message" style="float: left;padding-bottom: 10px;"></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button onclick="contactMail('{{url('/contactMail')}}')" class="submit submit-auto-width" type="button">メッセージを送る</button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="section-border pt-50 pb-50">
            <div class="container">
                <div id='map-panes' class="leaflet-map mb-50"></div>
                <div class="row">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h4 class="mb-15 text-brand">Office</h4>
                        〒261-0023<br>
                        千葉県千葉市美浜区中瀬1-7-1<br>
                        住友ケミカルエンジニアリングセンタービル16F<br>
                        <abbr title="Phone">TEL:</abbr> 043-309-4741<br>
                        <abbr title="Email">メール: </abbr>contact@Evara.com<br>
                    </div>
                    <div class="col-md-4 mb-4 mb-md-0">
                        <h4 class="mb-15 text-brand">Studio</h4>
                        〒261-0023<br>
                        千葉県千葉市美浜区中瀬1-7-1<br>
                        住友ケミカルエンジニアリングセンタービル16F<br>
                        <abbr title="Phone">TEL:</abbr> (123) 456-7890<br>
                        <abbr title="Email">メール: </abbr>contact@Evara.com<br>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mb-15 text-brand">Shop</h4>
                        〒261-0023<br>
                        千葉県千葉市美浜区中瀬1-7-1<br>
                        住友ケミカルエンジニアリングセンタービル16F<br>
                        <abbr title="Phone">TEL:</abbr> (123) 456-7890<br>
                        <abbr title="Email">メール: </abbr>contact@Evara.com<br>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
    ﻿@include('UserPanel/inc/footer')