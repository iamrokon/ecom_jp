﻿
    @include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
    
    <style>
        #scrollUp {
            display: flex;
            align-items: center;
            justify-content: center;
        }

    .zoomContainer{ 
        z-index: 9;
    }
    .zoomWindow{ 
        z-index: 9;
    } 

    /*.zoomContainer {
        z-index: 60;
    }*/
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
    .tabfocused:focus {
    box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%) !important;
    border-color: #80bdff;
}
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('homepage')}}" rel="nofollow">トップ</a>
                    <span class="active">商品一覧</span> 
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50 my-xs-mt25 my-xs-n0">
            <form method="get" id="productListForm" action="{{route('productList')}}">
                <!--<input type="hidden" name="cat" id="product_cat" value="{{--$cat--}}"/>
                <input type="hidden" name="sub_cat" id="product_sub_cat" value="{{--$sub_cat--}}"/>
                <input type="hidden" name="brand" id="product_brand" value="{{--$brand--}}"/>
                <input type="hidden" name="type" id="product_type" value="{{--$type--}}"/>
                <input type="hidden" name="price" id="product_price" value="{{--$price--}}"/>
                <input type="hidden" name="off" id="product_off" value="{{--$off--}}"/>-->
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-10 custom-col-lg-10">
                            <div id="quick_add_to_cart_msg"></div>
                            <div class="shop-product-fillter">
                              <div class="filter-icon d-lg-none d-block">
                                  <i class="bi bi-funnel"></i> サブメニュー
                              </div>
                                <div class="totall-product">
                                    <p>表示件数　全<strong class="text-brand">{{$total_product}}</strong>品</p>
                                </div>
                                <div class="sort-by-product-area">
                                    <select name="pagi" class="product-pagination" onchange="filterProductList($(this))">
                                        <option value="50" @if($pagination == 50){{'selected'}}@endif>50</option>
                                        <option value="100" @if($pagination == 100){{'selected'}}@endif>100</option>
                                        <option value="150" @if($pagination == 150){{'selected'}}@endif>150</option>
                                        <option value="200" @if($pagination == 200){{'selected'}}@endif>200</option>
                                    </select>
                                    <!--<div class="sort-by-cover mr-10">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps"></i>Show:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a class="active" href="#">50</a></li>
                                                <li><a href="#">100</a></li>
                                                <li><a href="#">150</a></li>
                                                <li><a href="#">200</a></li>
                                                <li><a href="#">All</a></li>
                                            </ul>
                                        </div>
                                    </div>-->
                                    <!--<div class="sort-by-cover">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li><a class="active" href="#">Featured</a></li>
                                                <li><a href="#">Price: Low to High</a></li>
                                                <li><a href="#">Price: High to Low</a></li>
                                                <li><a href="#">Release Date</a></li>
                                                <li><a href="#">Avg. Rating</a></li>
                                            </ul>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="row product-grid-3">
                                @foreach($products as $product)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
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
                                                <!-- <a href="{{url("productDetails/".$product->product_id."/".$product->product_name)}}" aria-label="Quick view" class="action-btn hover-up"><i class="fi-rs-eye"></i></a> -->
                                                <a onclick="openProductDetails({{$product->product_id}},'{{route("quickViewProduct")}}')" aria-label="クイックビュー" class="hover-up action-btn viewCart eyeicon"><i class="fi-rs-eye"></i></a>
                                                <!-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a> -->
                                                <a data-bs-toggle="modal" data-bs-target="#" onclick="quickAddToCart('{{route("quickAddToShopCart",[$product->product_id])}}'); event.preventDefault();" aria-label="カートへ追加" class="action-btn hover-up" href="#"><i class="bi bi-bag"></i></a>
                                            </div>
                                            <!--<div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>-->
                                            @if($product->stock_status == 'stock_out')
                                            <div class="stock-product">
                                                <span>在庫なし</span>
                                            </div>
                                            @endif
                                        </div>
                                       
                                        <a href="{{url("productDetails/".$product->product_id."/".$product->product_name)}}">
                                            <div class="product-content-wrap">
                                                <h2>{{$product->product_name}}</h2>
                                                <div class="product-category">
                                                    @if($product->brand_name != ""){{$product->brand_name}}@else &nbsp @endif
                                                </div>
                                                <!--<div class="rating-result" title="90%">
                                                    <span>
                                                        <span>90%</span>
                                                    </span>
                                                </div>-->
                                                <div class="product-price">
                                                    @if($product->kakaku != null)
                                                    <span class="old-price" style="font-size: 14px;">￥{{number_format($product->kakaku)}}</span>
                                                    @endif
                                                    <span style="font-size: 14px;">￥{{number_format($product->data23)}}</span>
                                                    
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
                            <!--pagination-->
                            <div class="pagination-area mt-15 mb-sm-5 mb-lg-0 my-xs-mt0 my-xs-n0">
                                <nav aria-label="Page navigation example">
                                    <!--<ul class="pagination justify-content-start">
                                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link" href="#">16</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                                    </ul>-->
                                    {{ $products->appends(request()->input())->links() }}
                                </nav>
                            </div>
                        </div>
                        @include('UserPanel/leftSidebar')
                    </div>
                </div>
            </form>
        </section>
    </main>

    <!-- responsive filter -->
    <div class="mobile-filter-active mobile-filter-wrapper-style">
      <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
          <div class="mobile-header-text">
            サブメニュー
          </div>
          <div class="mobile-filter-close close-style-wrap close-style-position-inherit">
            <button class="close-style search-close">
            <i class="icon-top"></i>
            <i class="icon-bottom"></i>
            </button>
          </div>
        </div>
        <div class="mobile-header-content-area">
          <div class="sidebar-widget price_range range">
            <form method="get" id="productListMobileMenuForm" action="{{route('productList')}}">
            <ul>
              <li style="border-bottom: 1px solid #e2e9e1;">
                <a class="category iconUpDown">カテゴリー <span class="top-angle"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideDown" style="@if($cat == ''){{'display: none'}}@endif">
                  @foreach($categories as $categorie)  
                  <li>
                    @php
                    $sub_categories = getSubCategoryList($categorie->bango);
                    @endphp
                    <div class="custome-checkbox">
                        <input name="cat[]" class="form-check-input" type="checkbox" id="mobileCheck{{$categorie->bango}}" value="{{$categorie->zokusei}}" @if(in_array($categorie->zokusei, $cat)){{'checked'}}@endif>
                        <label onclick='filterProductListForMobile($(this),"{{$categorie->zokusei}}")' class="form-check-label" for="mobileCheck{{$categorie->bango}}"></label><span>{{$categorie->zokusei}}</span>
                        <ul class="subcat" style="margin-left:15px; @if(in_array($categorie->zokusei, $cat)) {{'display: block'}} @else {{'display: none'}} @endif">
                            @if(count($sub_categories) > 0)
                            @foreach($sub_categories as $sub_category)
                            <li>
                                <input name="sub_cat[]" class="form-check-input" type="checkbox" id="mobileExampleCheckbox{{$sub_category->bango}}" value="{{$sub_category->zokusei}}" @if(in_array($sub_category->zokusei, $sub_cat)){{'checked'}}@endif>
                                <label onclick='filterProductListForMobile($(this),null,null,null,null,null,"{{$sub_category->zokusei.'-'.$categorie->zokusei}}")' class="form-check-label" for="mobileExampleCheckbox{{$sub_category->bango}}"><span>{{$sub_category->zokusei}}</span></label>
                                <br> 
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </li>
              
              <!--
              <li style="border-bottom: 1px solid #e2e9e1;">
                <a class="allBrand iconUpDown2">ブランド <span class="top-angle"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideDownBrand" style="@if($brand == ''){{'display: none'}}@endif">
                   @foreach($brands as $brnd) 
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check{{$brnd->bango}}" value="" @if($brnd->zokusei == $brand){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,"{{--$brnd->zokusei--}}")' class="form-check-label" for="check{{--$brnd->bango--}}"></label><span>{{--$brnd->zokusei--}}</span>
                    </div>
                  </li>
                  @endforeach
                </ul>
              </li> -->
              
              <!--
              <li style="border-bottom: 1px solid #e2e9e1;">
                <a class="gender iconUpDown3">性別 <span class="top-angle"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideGender" style="@if($type == ''){{'display: none'}}@endif">
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="typeCheck6" value="Male" @if($type == "Male"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,"Male")' class="form-check-label" for="typeCheck6"></label><span>Male</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="typeCheck7" value="Female" @if($type == "Female"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,"Female")' class="form-check-label" for="typeCheck7"></label><span>Female</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="checkKids" value="Kids" @if($type == "Kids"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,"Kids")' class="form-check-label" for="checkKids"></label><span>Kids</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="typeCheck8" value="Unisex" @if($type == "Unisex"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,"Unisex")' class="form-check-label" for="typeCheck8"></label><span>Unisex</span>
                    </div>
                  </li>
                </ul>
              </li>-->
              
              <!--
              <li style="border-bottom: 1px solid #e2e9e1;">
                <a class="priceDropdown iconUpDown4">価格 <span class="top-angle"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slidepriceDropdown" style="@if($price == ''){{'display: none'}}@endif">
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="priceCheck9" value="1〜999" @if($price == "1〜999"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,"1〜999")' class="form-check-label" for="priceCheck9"></label><span>1〜999円</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check10" value="1000〜2999" @if($price == "1000〜2999"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,"1000〜2999")' class="form-check-label" for="check10"></label><span>1000〜2999円</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check11" value="3000〜4999" @if($price == "3000〜4999"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,"3000〜4999")' class="form-check-label" for="check11"></label><span>3000〜4999円</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check12" value="5000〜9999" @if($price == "5000〜9999"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,"5000〜9999")' class="form-check-label" for="check12"></label><span>5000〜9999円</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check13" value="10000〜" @if($price == "10000〜"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,"10000〜")' class="form-check-label" for="check13"></label><span>10000円〜</span>
                    </div>
                  </li>
                </ul>
              </li>-->
              
              <!--
              <li>
                <a class="offDropdown iconUpDown5">セール <span class="top-angle"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideoffDropdown" style="@if($off == ''){{'display: none'}}@endif">
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check14" value="80" @if($off == "80"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,null,"80")' class="form-check-label" for="check14"></label><span>80％OFF〜</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check15" value="60〜79" @if($off == "60〜79"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,null,"60〜79")' class="form-check-label" for="check15"></label><span>60〜79％OFF</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check16" value="50〜59" @if($off == "50〜59"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,null,"50〜59")' class="form-check-label" for="check16"></label><span>50〜59％OFF</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="offCheck17" value="30〜49" @if($off == "30〜49"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,null,"30〜49")' class="form-check-label" for="offCheck17"></label><span>30〜49％OFF</span>
                    </div>
                  </li>
                  <li>
                    <div class="custome-checkbox">
                      <input class="form-check-input" type="checkbox" id="check18" value="1〜29" @if($off == "1〜29"){{'checked'}}@endif>
                      <label onclick='filterProductList($(this),null,null,null,null,"1〜29")' class="form-check-label" for="check18"></label><span>1〜29％OFF</span>
                    </div>
                  </li>
                </ul>
              </li>-->
              
              
            </ul>
          </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Details Modal -->
    <div id="productDetailsModal">
    
    </div>


<!-- Stock Out Modal -->
@include('UserPanel/cart/statusModal')

  
    @include('UserPanel/inc/footer')

    <script>
      $(".viewCart").click(function() {
           $("body").addClass("cartWrapper");
      });
      $(".cartClose").click(function() {
          $("body").removeClass("cartWrapper");
      });
    </script>
    <script>
      // $( "body" ).find( ".tabfocused" );
        // $('.tabfocused').focus();
 
        // $('.fmq').keypress(function() {
        //     $(this).next().focus();
        // }

        // $(window).load(function () {
        //   $(".logo .tabfocused").focus();
        // });
    </script>