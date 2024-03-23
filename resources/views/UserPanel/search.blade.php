﻿﻿@include('UserPanel/inc/header')
    @include('UserPanel/inc/menu')
    @include('UserPanel/inc/mobile_header')
    <style>
        #scrollUp {
            display: flex;
            align-items: center;
            justify-content: center;
        }

    .zoomContainer{ 
        z-index: 9999;
    }

    .zoomWindow{ 
        z-index: 9999;
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
        border: 2px solid #7367f0 !important;
    }
    .slider-nav-thumbnails .slick-slide.slick-current img {
    border: 2px solid #7367f0;
}
    .quick-modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: #000;
        opacity: .6;
    }
    #productDetailsModal .quick-modal-backdrop{
        z-index: 8;
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
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p style="font-weight: bold;"> {{$total_product}} 件</p>
                                <p style="color: black;"> @if($total_product == 0){{'「'.$data.'」'.'を検索しましたが、ヒットしませんでした。'}}@endif</p>
                            </div>
                            <!--<div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
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
                                </div>
                                <div class="sort-by-cover">
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
                                </div>
                            </div>-->
                        </div>
                        <div class="row product-grid-3" style="min-height: 100px;">
                            @foreach($products as $product)
                            <div class="col-lg-3 col-md-4">
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
                                            <a onclick="openProductDetails({{$product->product_id}},'{{route("quickViewProduct")}}')" aria-label="クイックビュー" class="action-btn hover-up"><i class="fi-rs-eye"></i></a>
                                            <a onclick="quickAddToCart('{{route("quickAddToShopCart",[$product->product_id])}}'); event.preventDefault();" aria-label="カートへ追加" class="action-btn hover-up" href="#"><i class="bi bi-bag"></i></a>
                                        </div>
                                        @if($product->stock_status == 'stock_out')
                                        <div class="stock-product">
                                            <span>在庫なし</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="product-content-wrap">
                                        <h2><a href="{{url("productDetails/".$product->product_id."/".$product->product_name)}}">{{$product->product_name}}</a></h2>
                                        <div class="product-category">
                                            <a href="#">@if($product->brand_name != ""){{$product->brand_name}}@else &nbsp @endif</a>
                                        </div>
                                        <div class="product-price">
                                            @if($product->data23 != null)
                                            <span class="old-price">￥{{number_format($product->kakaku)}}</span>
                                            @endif
                                            <span>￥@if($product->data23 != null){{number_format($product->data23)}}@else {{number_format($product->kakaku)}} @endif</span>
                                            <div style="font-size: 14px;color:red;font-weight:bold;">ON SALE 12%OFF</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                {{ $products->appends(request()->input())->links() }}
                            </nav>
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