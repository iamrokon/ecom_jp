<div class="sidebar capsule--rounded bg_img overlay--dark" data-background="{{ asset('assets/admin/images/sidebar/2.jpg') }}"
>
<button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
<div class="sidebar__inner">
    <div class="sidebar__logo">
        <h5 class="text-white">{{ session()->get('kokyaku_name') }}</h5>
    </div>
@php
 $tantousya=session()->get('tantousya');
@endphp
    <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
        <ul class="sidebar__menu">
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="javascript:void(0)" class="">
                    <i class="menu-icon las la-users"></i>
                    <span class="menu-title">会員管理</span>

                </a>
                <div class="sidebar-submenu  ">
                    <ul>
                        <li class="sidebar-menu-item  ">
                            <a href="{{ route('admin.customer.index') }}" class="nav-link">
                                <i class="menu-icon las la-user-friends"></i>
                                <span class="menu-title">会員一覧</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="javascript:void(0)" class="">
                    <i class="la la-product-hunt menu-icon"></i>
                    <span class="menu-title">商品管理</span>
                </a>
                <div class="sidebar-submenu  ">
                    <ul>
                        <li class="sidebar-menu-item ">
                            <a class="nav-link" href="{{ route('admin.category.index') }}">
                                <i class="las la-align-left menu-icon"></i>
                                <span class="menu-title">カテゴリ</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-menu-item ">
                            <a class="nav-link" href="{{ route('admin.brand.index') }}">
                                <i class="la la-tags menu-icon"></i>
                                <span class="menu-title">ブランド</span>
                            </a>
                        </li> -->

                        <li class="sidebar-menu-item ">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">
                                <i class="menu-icon las la-tshirt"></i>
                                <span class="menu-title">商品一覧</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item ">
                            <form method="POST" id="perl_form" action="">
                               <input type="hidden" name="ACNAME" value="{{ $tantousya->bango }}">
                               <input type="hidden" name="ACC" value="{{ $tantousya->accesscode }}">
                               <a class="nav-link" href="#" onclick="perlSubmit('/cgi-bin/db_m_menu.cgi')">
                                <i class="menu-icon las la-tshirt"></i>
                                <span class="menu-title">WMS</span>
                               </a>
                            </form>
                            
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-item sidebar-dropdown">
                <a href="javascript:void(0)" class="">
                    <i class="menu-icon la la-tools"></i>
                    <span class="menu-title">設定</span>
                </a>
                <div class="sidebar-submenu  ">
                    <ul>
                        <li class="sidebar-menu-item ">
                            <a href="{{ route('admin.shop.index') }}" class="nav-link">
                                <i class="menu-icon las la-store-alt"></i>
                                <span class="menu-title">ショップ</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item ">
                            <a href="{{ route('admin.shipping.index') }}" class="nav-link">
                                <i class="fas fa-shipping-fast menu-icon"></i>
                                <span class="menu-title">配送設定</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-item ">
                            <a href="{{ route('admin.payment.index') }}" class="nav-link">
                                <i class="menu-icon las la-money-bill"></i>
                                <span class="menu-title">支払設定</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item ">
                            <a href="{{ route('admin.mail.index') }}" class="nav-link">
                                <i class="menu-icon las la-envelope-open-text"></i>
                                <span class="menu-title">メール</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <script type="text/javascript">
                function perlSubmit(url_last_part){
                    var user = window.location.hostname;
                    url='https://'+user.replaceAll('.jp','.com')+url_last_part;
                    console.log(url);
                    document.getElementById('perl_form').action =  url;
                    document.getElementById('perl_form').submit();
                }
            </script>
            <!-- <li class="sidebar-menu-item mt-2">
                <div class="nav-link d-flex justify-content-center">
                    <span>
                        <span class="text--primary font-weight-bold">ViserMart</span>
                        <span class="text--success">V1.0 </span>
                    </span>
                </div>
            </li> -->
        </ul>
    </div>
</div>
</div>