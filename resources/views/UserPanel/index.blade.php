@include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
    <main class="main">       
        <section class="home-slider position-relative">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <!-- <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Trade-in offer</h4>
                                    <h2 class="animated fw-900">Supper value deals</h2>
                                    <h1 class="animated fw-900 text-brand">On all products</h1>
                                    <p class="animated">Save more with coupons & up to 70% off</p>
                                    <a class="animated btn btn-brush btn-brush-3" href="#"> Shop Now </a>
                                </div>
                            </div> -->
                            <div class="col-lg-12 col-md-12">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="{{asset('UserPanel/imgs/slider/slider-1.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <!-- <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Hot promotions</h4>
                                    <h2 class="animated fw-900">Fashion Trending</h2>
                                    <h1 class="animated fw-900 text-7">Great Collection</h1>
                                     <p class="animated">Save more with coupons & up to 20% off</p> 
                                    <a class="animated btn btn-brush btn-brush-2" href="#"> Discover Now </a>
                                </div>
                            </div> -->
                            <div class="col-lg-12 col-md-12">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-2" src="{{asset('UserPanel/imgs/slider/slider-2.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <!-- <div class="col-lg-12 col-md-12">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Upcoming Offer</h4>
                                    <h2 class="animated fw-900">Big Deals From</h2>
                                    <h1 class="animated fw-900 text-8">Manufacturer</h1>
                                    <p class="animated">Clothing, Shoes, Bags, Wallets...</p>
                                    <a class="animated btn btn-brush btn-brush-1" href="#"> Shop Now </a>
                                </div>
                            </div> -->
                            <div class="col-lg-12 col-md-12">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-3" src="{{asset('UserPanel/imgs/slider/slider-3.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        
    </main>

    <!-- Modal -->
    <div class="modal fade" id="stockOutModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 450px;">
        <div class="modal-content">
          <div class="modal-header" style="border: 0;padding: 15px 15px 5px;">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <div class="mb-25">
                在庫なし
            </div>

            <button type="button" class="btn btn-fill-out submit" data-bs-dismiss="modal">はい</button>
          </div>
        </div>
      </div>
    </div>

﻿@include('UserPanel/inc/footer')