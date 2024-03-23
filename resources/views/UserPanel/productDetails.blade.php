@include('UserPanel/inc/header')
@include('UserPanel/inc/menu')
@include('UserPanel/inc/mobile_header')
<style>
       
/* 
    /* .zoomContainer{ 
        z-index: 99;
    }

    .zoomWindow{ 
        z-index: 99;
    } */ */
    .cartWrapper{
        overflow: hidden;
    }
    #modal_img_zoom{
        margin-top: 15px;
    }

    #modal_img_zoom img{
        max-width: 120px;
        max-height: 120px;
        border: 2px solid #fff;
        margin-right: 10px;
    }
     
    #modal_img_zoom .active img{
        border: 2px solid #a2d2c9 !important;
    }
    .cartWrapper .zoomContainer{
        z-index: 99;
    }
    .quick-modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 8;
        width: 100vw;
        height: 100vh;
        background-color: #000;
        opacity: .6;
    }

    body{
        overflow-x: hidden;
    }
    </style>

<main class="main custom-zoomconainer">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                <span onclick='categoryWiseProductFilter($(this),"{{$productDetails[0]->category_name}}")' style="cursor:pointer;">{{$productDetails[0]->category_name}}</span> 
                <span class="active">{{$productDetails[0]->product_name}}</span> 
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50 my-xs-n0 my-xs-mt25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Success Message -->
                    @if(Session::has('cart_msg'))
                    <div class="alert alert-primary alert-dismissible">
                      <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                      <strong>{{session()->get('cart_msg')}}</strong>
                    </div>
                    @endif

                    <div class="product-detail accordion-detail">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @php
                                        $file_name = url('storage/product/images'.'/'.$productDetails[0]->file_name);
                                        $file_name2 = $productDetails[0]->file_name2 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name2):"";
                                        $file_name3 = $productDetails[0]->file_name3 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name3):"";
                                        $file_name4 = $productDetails[0]->file_name4 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name4):"";
                                        $file_name5 = $productDetails[0]->file_name5 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name5):"";
                                        $file_name6 = $productDetails[0]->file_name6 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name6):"";
                                        @endphp
                                        <figure class="border-radius-10">
                                            <img src="{{$file_name}}" alt="product image">
                                        </figure>
                                        @if($file_name2 != "")
                                        <figure class="border-radius-10">
                                            <img src="{{$file_name2}}" alt="product image">
                                        </figure>
                                        @endif
                                        @if($file_name3 != "")
                                        <figure class="border-radius-10">
                                            <img src="{{$file_name3}}" alt="product image">
                                        </figure>
                                        @endif
                                        @if($file_name4 != "")
                                        <figure class="border-radius-10">
                                            <img src="{{$file_name4}}" alt="product image">
                                        </figure>
                                        @endif
                                        @if($file_name5 != "")
                                        <figure class="border-radius-10">
                                            <img src="{{$file_name5}}" alt="product image">
                                        </figure>
                                        @endif
                                        @if($file_name6 != "")
                                        <figure class="border-radius-10">
                                            <img src="{{$file_name6}}" alt="product image">
                                        </figure>
                                        @endif
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                        <div><img src="{{$file_name}}" alt="product image"></div>
                                        @if($file_name2 != "")<div><img src="{{$file_name2}}" alt="product image"></div>@endif
                                        @if($file_name3 != "")<div><img src="{{$file_name3}}" alt="product image"></div>@endif
                                        @if($file_name4 != "")<div><img src="{{$file_name4}}" alt="product image"></div>@endif
                                        @if($file_name5 != "")<div><img src="{{$file_name5}}" alt="product image"></div>@endif
                                        @if($file_name6 != "")<div><img src="{{$file_name6}}" alt="product image"></div>@endif
                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <!-- <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Share this:</strong></li>
                                        <li class="social-facebook"><a href="#"><img src="{{asset('public/UserPanel/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a></li>
                                        <li class="social-twitter"> <a href="#"><img src="{{asset('public/UserPanel/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a></li>
                                        <li class="social-instagram"><a href="#"><img src="{{asset('public/UserPanel/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a></li>
                                        <li class="social-linkedin"><a href="#"><img src="{{asset('public/UserPanel/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a></li>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <form method="post" action="{{ route('addToShopCart',[$productDetails[0]->product_id])}}" onsubmit="addToCart('{{route("addToShopCart",[$productDetails[0]->product_id])}}'); event.preventDefault();" id="addToCart">
                                    <input type="hidden" name="page_name" value="product_details"/>
                                    <input type="hidden" name="color" id="req_color"/>
                                    <input type="hidden" name="size" id="req_size"/>
                                    <input type="hidden" name="qty" id="req_qty"/>
                                    <input type="hidden" value="{{$productDetails[0]->product_id}}" id="product_id"/>
                                    <input type="hidden" value="{{$productDetails[0]->stock_status}}" id="stock_status"/>
                                    @csrf
                                    <div class="detail-info">
                                        <h6 style="margin-bottom:8px;">{{$productDetails[0]->brand_name}}</h6>
                                        <h2 class="title-detail">{{$productDetails[0]->product_name}}</h2>
                                        <h5 class="mt-2">{{$productDetails[0]->product_id}}</h5>
                                        @if($productDetails[0]->stock_status == 'stock_out')
                                        <span style="font-weight: bold;color: orangered;">在庫なし</span>
                                        @endif
                                        <!--<div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> Brands: <a href="#">{{--$productDetails[0]->brand_name--}}</a></span>
                                            </div>
                                        </div>-->
                                        <div class="clearfix product-price-cover mb-15">
                                            <div class="product-price primary-color float-left">
                                                @if($productDetails[0]->kakaku != null)
                                                <ins>
                                                    <span class="old-price font-md ml-0">￥{{number_format($productDetails[0]->kakaku)}}</span>
                                                </ins>
                                                @endif
                                                <ins><span class="text-brand">￥{{number_format($productDetails[0]->data23)}}</span></ins>
                                                
                                                @if($productDetails[0]->kakaku != null)
                                                @php
                                                $percentage = 100 - ($productDetails[0]->data23 / ($productDetails[0]->kakaku)*100);
                                                $percentage = round($percentage);
                                                @endphp
                                                <span class="save-price  font-md color3 ml-15 text-danger">ON SALE {{$percentage}}%OFF</span>
                                                @endif
                                            </div>
                                        </div>
                                   
                                        @php
                                        $sizeList = getProductSizeList($productDetails[0]->kokyakusyouhinbango,$productDetails[0]->product_color);
                                        $colorList = getProductColorList($productDetails[0]->kokyakusyouhinbango,$productDetails[0]->product_size);
                                        @endphp
                                        
                                        @if(count($sizeList) > 0)
                                        <div class="mb-15">
                                            <div class="product-size" style="width: 50px;height: 40px;line-height: 40px;float: left;">
                                            サイズ 
                                            </div>
                                            <div style="overflow: hidden;display: block;">
                                            @foreach($sizeList as $key=>$val)
                                            <a href="{{url("productDetails/".$sizeList[$key]->bango."/".$sizeList[$key]->jouhou)}}">
                                                <div class="pt_size" onclick="sizeSelection($(this),'{{$sizeList[$key]->size}}','{{$sizeList[$key]->bango}}')" style="cursor:pointer;display:inline-block;border: 2px solid #f3f5f5;min-width: 100px;padding: 0 3px;margin-bottom: 2px;text-align: center;height: 40px;line-height: 36px;border-radius: 4px;color:#000;@if($sizeList[$key]->size == $productDetails[0]->product_size) background:#d8d5fb;border:2px solid #7367f0;color:#000; @endif">
                                                    {{$sizeList[$key]->size}}
                                                </div>
                                            </a>
                                            @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if(count($colorList) > 0)
                                        <div class="mb-15">
                                            <div class="product-color" style="width: 50px;height: 40px;line-height: 40px;float: left;">
                                            カラー 
                                            </div>
                                            <div style="overflow: hidden;display: block;">
                                            @foreach($colorList as $key=>$val)
                                            <a href="{{url("productDetails/".$colorList[$key]->bango."/".$colorList[$key]->jouhou)}}">
                                                <div class="pt_color" onclick="colorSelection($(this),'{{$colorList[$key]->color}}','{{$colorList[$key]->bango}}')" style="cursor:pointer;display:inline-block;border: 2px solid #f3f5f5;min-width: 100px;padding: 0 3px;margin-bottom: 2px;text-align: center;height: 40px;line-height: 36px;border-radius: 4px;color:#000;@if($colorList[$key]->color == $productDetails[0]->product_color) background:#d8d5fb;border:2px solid #7367f0;color:#000; @endif">
                                                    {{$colorList[$key]->color}}
                                                </div>
                                            </a>
                                            @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="product-quantity">
                                            <label>数量</label>
                                            <div class="detail-extralink">
                                                <div class="detail-qty border radius">
                                                    <a href="#" class="qty-down">-</a>
                                                    <!-- <span class="qty-val">1</span> -->
                                                    <input type="text" name="" class="qty-val form-control form-qty-control" value="@if($productDetails[0]->stock_status == 'stock_out'){{0}}@else{{1}}@endif" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')">
                                                    <a href="#" class="qty-up">+</a>
                                                </div>
												
												@if($productDetails[0]->stock_status != 'stock_out')
                                                <div class="product-extra-link2">
                                                    <button type="submit" class="button button-add-to-cart" @if($productDetails[0]->stock_status == 'stock_out'){{'disabled'}}@endif>カートに追加</button>
                                                    <!--<a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>-->
                                                </div>
												@endif
												
                                            </div>
                                        </div>
										
										@if($productDetails[0]->gender != null)
                                        <div class="mancloth gender" style="background:black;border-radius: 4px;text-align: center;color: white;padding: 8px 40px;display: inline-block;">
                                            {{$productDetails[0]->gender}}
                                        </div>
										@endif
										
                                        @if($productDetails[0]->product_comment != null)<p style="padding-top: 15px;margin: 0px;">{!! nl2br(e($productDetails[0]->product_comment)) !!}</p>@endif

                                        <div style="padding-top:15px; margin-bottom: 15px;display: flex;align-items: center;">
                                                <!-- <div class="product-color" style="margin-right: 13px;">
                                                素材表記 
                                                </div> -->
                                            <div class="" style="font-weight:bold;">
                                                {!! nl2br(e($productDetails[0]->product_material)) !!}
                                            </div>
                                        </div>

                                        <div style="padding-top:15px; margin-bottom: 15px;display: flex;align-items: center;">
                                            <div class="" style="font-weight:bold;">
                                                {!! nl2br(e($productDetails[0]->measuring_info)) !!}
                                            </div>
                                        </div>

                                        <!-- <div class="mb-15">
                                            <p>着心地が良くリラックス感のあるコーディネートですが、やや光沢があるワンランク上の素材を使用したトップスを使ってどこか品のあるカジュアルコーデにしました。トップスは、サイドの紐を前or後ろで結んだり、紐付け根の穴に紐を入れ込むと紐無し仕様にもなる3way。様々な組み合わせを楽しんでください。</p>
                                        </div> -->
                                    </div>
                                    
                                    <!-- Product Inquiry Mail -->
                                    {{-- <div class="collapsibles-wrapper" style="border:1px solid #e2e9e1 !important">
                                        <div class="contact-form" style="padding: 20px;cursor:pointer;position:relative;color:black;">
                                            この商品について問い合わせる
                                                <span class="angel-icon" style="position: absolute;font-size: 30px;right: 7px;top: 20px;color: black;"><i class="fi-rs-angle-small-up"></i></span>
                                            </button>
                                        </div>
                                        <div id="mail_msg"></div>
                                        <div class="collapsibles-body" style="padding:0px 20px;display:none;">
                                           <div style="">
                                            <div class="grid grid--small">
                                                <div class="d-flex">
                                                    <div class="grid__item medium-up--one-half" style="width: 48%;margin-right:4%;">
                                                            <label>名前</label>
                                                            <input name="name" id="contact_name" type="text" class="input-full">
                                                        </div>
                                                        <div class="grid__item medium-up--one-half" style="width: 48%;">
                                                            <label>メールアドレス</label>
                                                            <input name="email" id="contact_email" type="email" class="input-full">
                                                        </div>
                                                </div>
                                                </div>
                                                <div style="margin-top:95px">
                                                    <label>メッセージ</label>
                                                    <textarea name="message" id="contact_message" rows="5" class="input-full"></textarea>
                                                </div>
                                                <button onclick="contactMail('{{url('/contactMail')}}','productDetails')" type="button" class="btn" style=" margin-top: 16px; margin-bottom: 20px;">送信</button>
                                           </div>
                                        </div>
                                    </div> --}}
                            
                                </form>
                               
                            </div>
                        </div>
                        <div class="product-grid product-grid5">
                            <div class="row">
                                <h4 style="margin-bottom: 20px;margin-top:40px;">これらのアイテムもおすすめです</h4>
                            </div>
                            <div class="row">
                               @foreach($recommendedProducts as $product)
                                <div class="col-md-4 col-lg-3">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                @php
                                                $file_name = url('storage/product/images'.'/'.$product->file_name);
                                                @endphp
                                                <a href="{{url("productDetails/".$product->product_id."/".$product->product_name)}}">
                                                    <img class="default-img" src="{{$file_name}}" alt="">
                                                    <img class="hover-img" src="{{$file_name}}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a onclick="openProductDetails({{$product->product_id}},'{{route("quickViewProduct")}}')" aria-label="クイックビュー" class="action-btn hover-up viewCartIndex"><i class="fi-rs-eye"></i></a>
                                                <a onclick="quickAddToCart('{{route("quickAddToShopCart",[$product->product_id])}}'); event.preventDefault();" aria-label="カートへ追加" class="action-btn hover-up" href="#"><i class="bi bi-bag"></i></a>
                                            </div>
                                            @if($product->stock_status == 'stock_out')
                                            <div class="stock-product">
                                                <span>在庫なし</span>
                                            </div>
                                            @endif
                                            <!--<div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>-->
                                        </div>
                                        <a href="{{url("productDetails/".$product->product_id."/".$product->product_name)}}">
                                            <div class="product-content-wrap">
                                                <h2>{{$product->product_name}}</h2>
                                                <div class="product-category">
                                                    {{$product->brand_name}}
                                                </div>
                                                <div class="product-price">
                                                    @if($product->kakaku != null)
                                                    <span style="font-size:14px;margin-left:0px;" class="old-price">￥{{number_format($product->kakaku)}}</span>
                                                    @endif
                                                    <span style="font-size:14px;">￥{{number_format($product->data23)}}</span>
                                                    @if($product->kakaku != null)
                                                    @php
                                                    $percentage = 100 - ($product->data23 / ($product->kakaku)*100);
                                                    $percentage = round($percentage);
                                                    @endphp
                                                    <div style="font-size: 14px;color:red;font-weight:bold;">ON SALE {{$percentage}}%OFF</div>
                                                    @endif
                                                </div>
                                                <!--<div class="product-action-1 show">
                                                    <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                                </div>-->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Product Details Modal -->
<div id="productDetailsModal">

</div>
@include('UserPanel/cart/statusModal')
@include('UserPanel/inc/footer')
<script>
     $(".viewCartIndex").click(function() {
           $("body").addClass("cartWrapper");
        //    $(".zoomContainer").addClass('zoomRemove');
        $(".zoomContainer").remove();
    });
    $(".cartClose").click(function() {
        $("body").removeClass("cartWrapper");
    });
    // $(".cartClose").click(function() {
    //         // alert('hello');
    //         // $(".zoomContainer").hide();
    //         $(".zoomContainer").last().remove();
    //         $(".quick-modal-backdrop").hide();
    //         $(".viewCartModal").removeClass("show");

    //         // $("body").removeClass("cartWrapper");
    //         // $(".zoomRemove").addClass('zoomContainer');
    //     });
</script>

