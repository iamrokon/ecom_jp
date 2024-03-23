 <footer class="main">
        
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <!-- <a href="{{route('homepage')}}"><img src="{{asset('UserPanel/imgs/theme/logo.svg')}}" alt="logo"></a> -->
                                <a href="{{route('homepage')}}"><strong style="font-size:18px;">{{\DB::table('kokyaku1')->where('bango',env('store'))->first()->name??""}}</strong></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">所在地・連絡先</h5>
                            <p class="wow fadeIn animated location-info position-relative" style="height: 48px;font-size:14px;">
                               <span style="display: inline-block;"><strong style="padding-right:3px;">住所: </strong></span><span style="position: absolute;top:0;">〒261-0023 千葉県千葉市美浜区中瀬1-7-1 住友ケミカルエンジニアリングセンタービル16F</span>
                               
                            </p>
                            <p class="wow fadeIn animated" style="font-size:14px;">
                                <strong style="padding-right:5px;">TEL: </strong>00-1111-2222 / 000-111-2222
                            </p>
                            <p class="wow fadeIn animated" style="font-size:14px;">
                                <strong>営業時間: </strong>10：00〜18：00、月〜土
                            </p>
                            <!-- <p class="wow fadeIn animated">
                                <strong>Address: </strong>562 Wellington Road, Street 32, San Francisco
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>+01 2222 365 /(+91) 01 2345 6789
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Hours: </strong>10:00 - 18:00, Mon - Sat
                            </p> -->
                            {{-- <h5 class="mobile-social-label mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">SNS公式アカウント</h5> --}}
                            {{-- <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="{{asset('UserPanel/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('UserPanel/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('UserPanel/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('UserPanel/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('UserPanel/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 offset-lg-1 p-0">
                        <div class="mobile-footer-menu">
                            <h5 class="widget-title wow fadeIn animated" style="font-size:16px;">会社概要＆ご利用ガイド</h5>
                            <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                <li><a href="{{route('companyProfile')}}">会社概要</a></li>
                                <li><a href="{{route('companyProfileOne')}}">配送について</a></li>
                                <li><a href="{{route('fPrivacyPolicy')}}">プライバシーポリシー</a></li>
                                <li><a href="{{route('termsService')}}">ご利用規約</a></li>
                                <li><a href="{{route('contact')}}">お問い合わせ</a></li>
                                {{-- <li><a href="#">サポートセンター</a></li> --}}
                                
                            </ul>
                        </div>
                    </div>
                    <!--<div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">My Account</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Order</a></li>
                        </ul>
                    </div>-->
                    <div class="col-lg-4 offset-lg-1">
                        {{-- <h5 class="widget-title wow fadeIn animated" style="font-size:16px;">Install App</h5> --}}
                        <div class="row">
                            {{-- <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">From App Store or Google Play</p>
                                <div class="download-app wow fadeIn animated">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="{{asset('UserPanel/imgs/theme/app-store.jpg')}}" alt=""></a>
                                    <a href="#" class="hover-up"><img src="{{asset('UserPanel/imgs/theme/google-play.jpg')}}" alt=""></a>
                                </div>
                            </div> --}}
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
                                <div>   
                                    <span class="payment-img-box">
                                        <img class="wow fadeIn animated" src="{{asset('UserPanel/imgs/theme/visa.png')}}" alt="">
                                    </span>
                                    <span  class="payment-img-box">
                                        <img class="wow fadeIn animated" src="{{asset('UserPanel/imgs/theme/MasterCard_logo.png')}}" alt="">
                                    </span>
                                    <span  class="payment-img-box">
                                        <img class="wow fadeIn animated" src="{{asset('UserPanel/imgs/theme/jcb1.jpg')}}" alt="">
                                    </span>
                                    <span  class="payment-img-box">
                                        <img class="wow fadeIn animated" src="{{asset('UserPanel/imgs/theme/americanExpress.png')}}" alt="">
                                    </span>
                                </div>
                                {{-- <img class="wow fadeIn animated" src="{{asset('UserPanel/imgs/theme/payment-method.png')}}" alt=""> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">&copy; 2021
                        <!-- <strong class="text-brand">Evara</strong> - HTML Ecommerce Template -->
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        Designed by 
                        <!-- <a href="http://alithemes.com" target="_blank">Alithemes.com</a> -->
                        . All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Vendor JS-->
   
    <script src="{{asset('UserPanel/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script> -->
     <script src="{{asset('UserPanel/js/vendor/jquery-3.6.0.min.js')}}"></script> 
    <script src="{{asset('UserPanel/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="{{asset('UserPanel/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/slick.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/owl.carousel.min.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/wow.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/isotope.js')}}"></script>
    {{-- <script src="{{asset('UserPanel/js/plugins/scrollup.js')}}"></script> --}}
    <script src="{{asset('UserPanel/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/leaflet.js')}}"></script>
    <script src="{{asset('UserPanel/js/plugins/jquery.elevatezoom.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Template  JS -->
    <script src="{{asset('UserPanel/js/shop.js')}}"></script>
    <script src="{{asset('UserPanel/js/main.js')}}"></script>
  
    <script src="{{asset('UserPanel/js/custom.js')}}"></script>
    <script src="{{asset('UserPanel/js/customFrontend.js')}}"></script>
</body>

</html>