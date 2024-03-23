<header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 ">
            <div class="container">
                <div class="row justify-content-end">
                    <!-- <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                        <div class="header-info ">
                            <ul>
                                <li><i class="fi-rs-smartphone"></i> <a href="#">00-1111-2222<br>000-111-2222</a></li>
                                <li><i class="fi-rs-marker"></i><a  href="#">所在地</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 col-12">
                        <div class="news-flash-content owl-carousel owl-theme text-center">
                            <div class="item">Get great devices up to 50% off <a href="#">View details</a></div>
                            <div class="item">Supper Value Deals - Save more with coupons</div>
                            <div class="item">Trendy 25silver jewelry, save up 35% off today <a href="#">Shop now</a></div>
                        </div>
                    </div> -->
                    <div class="col-lg-4 ml-auto">
                        <div class="header-info header-info-right">
                            <ul>
                                <!-- <li>
                                    <a class="language-dropdown-active" href="#"> 
                                       <i class="fi-rs-world"></i> 日本語 <i class="fi-rs-angle-small-down"></i> 
                                        <img src="{{asset('UserPanel/imgs/theme/flag-jp.jpg')}}" alt=""><i class="fi-rs-angle-small-down"></i>
                                    </a>
                                    <ul class="language-dropdown">
                                        <li><a href="#"><img src="{{asset('UserPanel/imgs/theme/flag-fr.png')}}" alt="">Français</a></li>
                                        <li><a href="#"><img src="{{asset('UserPanel/imgs/theme/flag-dt.png')}}" alt="">Deutsch</a></li>
                                        <li><a href="#"><img src="{{asset('UserPanel/imgs/theme/flag-ru.png')}}" alt="">Pусский</a></li>
                                    </ul>
                                </li> -->
                                @if(Session::has('userlogin'))
                                <li><i class="fi-rs-user"></i><a href="{{route('logoutUser')}}">ログアウト</a></li>
                                {{--<li><i class="fi-rs-user"></i><a href="#">@if(isset(session()->get('userlogin')['login_name'])){{session()->get('userlogin')['login_name']}}@endif</a></li>
                                 <li><a href="{{route('logoutUser')}}" class="logout-button"><i class="fi-rs-power"></i></a></li> --}}
                                @else
                                <li>
                                   
                                    <a href="{{route('loadAuthenticationPage')}}"> <i class="fi-rs-user"></i>ログイン/新規登録</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                    
                       <a class="tabfocused" href="{{route('homepage')}}" id="home" style="width:218px;font-size:18px;font-weight:bold;color:#088178;"><strong>{{\DB::table('kokyaku1')->where('bango',env('store'))->first()->name??""}}</strong></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form method="get" action="{{route('search')}}">
                                  
                                        <select name="cat" class="select-active tabfocused">
                                            <option value="all">全カテゴリ</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->zokusei}}" @if(isset($search_category) && $category->zokusei == $search_category){{'selected'}}@endif>{{$category->zokusei}}</option>
                                            @endforeach
                                        </select>
                                  
                                <!-- <input type="text" name="data" value="@if(isset($data)){{$data}}@endif" placeholder="アイテムを検索"> -->
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <button type="submit">
                                            <img src="{{asset('UserPanel/imgs/theme/icons/search.png')}}" alt="Search Icon">
                                        </button>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control tabfocused" name="data" value="@if(isset($data)){{$data}}@endif" placeholder="アイテムを検索" tabindex="0">
                                </div>
                            </form>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <!--<div class="header-action-icon-2">
                                    <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Evara" src="{{asset('UserPanel/imgs/theme/icons/icon-heart.svg')}}">
                                        <span class="pro-count blue">4</span>
                                    </a>
                                </div>-->
								
								<!-- mini cartlist -->
								<div id="mini_cartlist">
                                @include('UserPanel.inc.mini_cartlist')
								</div>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        
                        <a href="{{route('homepage')}}" id="home" style="width:218px;font-size:18px;font-weight:bold;color:#088178;"><strong>{{\DB::table('kokyaku1')->where('bango',env('store'))->first()->name??""}}</strong></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> カテゴリ一覧
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>								
                                    @foreach($categories as $categorie)
                                    @php
                                    $sub_categories = getSubCategoryList($categorie->bango);
                                    @endphp
                                    <li class="@if(count($sub_categories) > 0){{'has-children'}}@endif">
                                        <a onclick='categoryWiseProductFilter($(this),"{{$categorie->zokusei}}")'>
                                        <!--<i class="evara-font-tshirt"></i>-->
                                        {{$categorie->zokusei}}
                                        </a>
                                        @if(count($sub_categories) > 0)
                                        <div class="dropdown-menu">
                                            <ul class="mega-menu d-lg-flex">
                                                <li class="mega-menu-col">
                                                    <ul>       
                                                        @foreach($sub_categories as $sub_category)
                                                        <li><a onclick='categoryWiseProductFilter($(this),null,"{{$sub_category->zokusei.'-'.$categorie->zokusei}}")' class="dropdown-item nav-link nav_item" href="#">{{$sub_category->zokusei}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
					                @endif
                                    </li>
                                    @endforeach
                                </ul>   
                                    <!--<li><a href="shop-grid-right.html"><i class="evara-font-desktop"></i>Computer & Office</a></li>
                                    <li><a href="shop-grid-right.html"><i class="evara-font-cpu"></i>Consumer Electronics</a></li>
                                    <li><a href="shop-grid-right.html"><i class="evara-font-diamond"></i>Jewelry & Accessories</a></li>
                                    <li><a href="shop-grid-right.html"><i class="evara-font-home"></i>Home & Garden</a></li>
                                    <li><a href="shop-grid-right.html"><i class="evara-font-high-heels"></i>Shoes</a></li>
                                    <li><a href="shop-grid-right.html"><i class="evara-font-teddy-bear"></i>Mother & Kids</a></li>
                                    <li><a href="shop-grid-right.html"><i class="evara-font-kite"></i>Outdoor fun</a></li>
                                    <li>
                                        <ul class="more_slide_open" style="display: none;">
                                            <li><a href="shop-grid-right.html"><i class="evara-font-desktop"></i>Beauty, Health</a></li>
                                            <li><a href="shop-grid-right.html"><i class="evara-font-cpu"></i>Bags and Shoes</a></li>
                                            <li><a href="shop-grid-right.html"><i class="evara-font-diamond"></i>Consumer Electronics</a></li>
                                            <li><a href="shop-grid-right.html"><i class="evara-font-home"></i>Automobiles & Motorcycles</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="more_categories">Show more...</div>-->
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            
                            <!-- brand product filter form -->
                            <form method="get" id="brandProductFilter" action="{{route('productList')}}">
                                <input type="hidden" name="cat" id="menu_product_cat" value=""/>
                                <input type="hidden" name="brand" id="menu_product_brand" value=""/>
                            </form>
                            
                            <nav>
                                <ul>
                                    <li><a  href="{{route('productList')}}">商品一覧</a>
                                    {{-- <li><a href="{{route('brandList')}}">ブランド</i></a>
                                        <ul class="sub-menu menu-brand">
                                            @foreach($brands as $brand)
                                            <li><a onclick='filterBrandProduct("{{$brand->zokusei}}")' href="#">{{$brand->zokusei}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li> --}}
                                    <!-- <li>
                                        <a href="{{route('about')}}">会社概要</a>
                                    </li> -->
                                    <!--<li><a href="shop-grid-right.html">Shop <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                            <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                            <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                            <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                            <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                            <li><a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                                    <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                                    <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="shop-filter.html">Shop – Filter</a></li>
                                            <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                            <li><a href="shop-cart.html">Shop – Cart</a></li>
                                            <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                            <li><a href="shop-compare.html">Shop – Compare</a></li>
                                        </ul>
                                    </li>-->
                                    <!--<li class="position-static"><a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Women's Fashion</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Dresses</a></li>
                                                    <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                                    <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                                    <li><a href="shop-product-right.html">Wedding Dresses</a></li>
                                                    <li><a href="shop-product-right.html">Prom Dresses</a></li>
                                                    <li><a href="shop-product-right.html">Cosplay Costumes</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Men's Fashion</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Jackets</a></li>
                                                    <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                                    <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                                    <li><a href="shop-product-right.html">Casual Pants</a></li>
                                                    <li><a href="shop-product-right.html">Sweatpants</a></li>
                                                    <li><a href="shop-product-right.html">Harem Pants</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Technology</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                                    <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                                    <li><a href="shop-product-right.html">Tablets</a></li>
                                                    <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                                    <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="shop-product-right.html"><img src="{{asset('UserPanel/imgs/banner/menu-banner.jpg')}}" alt="Evara"></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>Don't miss<br> Trending</h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="shop-product-right.html">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>35%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>-->
                                    
                                    <!--<li><a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                            <li><a href="blog-category-list.html">Blog Category List</a></li>
                                            <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                            <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                            <li><a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu level-menu-modify">
                                                    <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                    <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                    <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>-->
                                    <!--<li><a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="page-about.html">About Us</a></li>
                                            <li><a href="page-contact.html">Contact</a></li>
                                            <li><a href="page-account.html">My Account</a></li>
                                            <li><a href="page-login-register.html">login/register</a></li>
                                            <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                            <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                            <li><a href="page-terms.html">Terms of Service</a></li>
                                            <li><a href="page-404.html">404 Page</a></li>
                                        </ul>
                                    </li>-->
                                    <li>
                                        <a href="{{route('contact')}}">お問い合わせ</a>
                                    </li>
                                    
                                    @if(Session::has('userlogin'))
                                    <li>
                                        <a href="{{route('user')}}">マイページ</a>
                                    </li>
                                    @endif 
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!--<div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-headset"></i><span>Hotline</span> 1900 - 888 </p>
                    </div>-->
                    <!-- <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p> -->
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            {{-- <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Evara" src="{{asset('UserPanel/imgs/theme/icons/icon-heart.svg')}}">
                                    <span class="pro-count white">4</span>
                                </a>
                            </div> --}}
                            <div class="header-action-icon-2 mobile-cart-icon">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Evara" src="{{asset('UserPanel/imgs/theme/icons/icon-cart.svg')}}">
                                    <span class="pro-count white">@if(Cart::count() > 99){{"99+"}}@else{{Cart::count()}}@endif</span>
                                </a>
                                
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
					@foreach(Cart::content() as $row)
                                        <li>
                                            <div class="shopping-cart-img">
                                                @php
                                                $file_name = url('storage/product/images'.'/'.$row->options->file_name);
                                                @endphp
                                                <a href="{{url("productDetails/".$row->id."/".$row->name)}}"><img alt="Evara" src="{{$file_name}}"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{url("productDetails/".$row->id."/".$row->name)}}">{{$row->name}}</a></h4>
                                                <h3><span>{{$row->qty}} × </span>￥{{$row->price}}</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="{{url('removeCartItem/'.$row->rowId)}}"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
					@endforeach										                                       
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>合計 <span>￥{{Cart::total(0)}}</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{route('cartItemList')}}">カート内へ</a>
                                            <a href="{{route('checkout')}}">ご購入手続きへ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>