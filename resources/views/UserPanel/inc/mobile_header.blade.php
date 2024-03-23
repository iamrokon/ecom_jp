<div class="mobile-header-active mobile-header-wrapper-style responsiveMobile">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                   
                    {{\DB::table('kokyaku1')->where('bango',env('store'))->first()->name??""}}
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form method="get" action="{{route('search')}}">
                        <input name="data" value="@if(isset($data)){{$data}}@endif" type="text" placeholder="アイテムを検索">
                        <button class="search-icon-btn" type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> カテゴリ一覧
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>								
                                @foreach($categories as $categorie)
                                @php
                                $sub_categories = getSubCategoryList($categorie->bango);
                                @endphp
                                <li class="@if(count($sub_categories) > 0){{'has-children'}}@endif">
                                    <a @if(count($sub_categories) < 1)onclick='categoryWiseProductFilter($(this),"{{$categorie->zokusei}}")'@endif>
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
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{route('productList')}}">商品一覧</a></li>
                            {{-- <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{route('brandList')}}">ブランド</a></li> --}}
                            {{-- <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{route('about')}}">会社概要</a></li> --}}
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{route('contact')}}">お問い合わせ</a></li>
                            @if(Session::has('userlogin'))<li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{route('user')}}">マイページ</a></li>@endif
                            
                            {{-- <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">日本語</a>
                                <ul class="dropdown">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Spanish</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a  href="#"> 所在地 </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <!-- <a href="{{route('loadAuthenticationPage')}}">ログイン</a> -->
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#" style="line-height: 18px;">00-1111-2222 <br> 000-111-2222</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>