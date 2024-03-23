<div class="header-action-icon-2 mobile-cart-icon">
    <a class="mini-cart-icon" href="#">
            <img alt="Netshop" src="{{asset('UserPanel/imgs/theme/icons/icon-cart.svg')}}">
            <span class="pro-count blue">@if(Cart::count() > 99){{"99+"}}@else{{Cart::count()}}@endif</span>
            
    </a>
    {{-- <a class="mini-cart-icon" onclick="ajudaUpload();return false;" href="{{route('cartItemList')}}">
        <img alt="Netshop" src="{{asset('UserPanel/imgs/theme/icons/icon-cart.svg')}}">
        <span class="pro-count blue">@if(Cart::count() > 99){{"99+"}}@else{{Cart::count()}}@endif</span>
        
    </a> --}}
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                <ul>
                    @foreach(Cart::content() as $row)
                    <li>
                        <div class="shopping-cart-img">
                            @php
                            $file_name = url('storage/product/images'.'/'.$row->options->file_name);
                            @endphp
                            <a href="{{url("productDetails/".$row->id."/".$row->name)}}"><img alt="Netshop" src="{{$file_name}}"></a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4><a href="{{url("productDetails/".$row->id."/".$row->name)}}">{{$row->name}}</a></h4>
                            <h4><span>{{$row->qty}} × </span>￥{{number_format($row->price)}}</h4>
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
                        <a style="background-color:#7367f0;color:white;" href="{{route('cartItemList')}}" id="cartList" class="outline">カート内へ</a>
                        <a href="{{route('checkout')}}">ご購入手続きへ</a>
                    </div>
                </div>
            </div>
</div>