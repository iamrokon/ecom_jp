{{-- @include('UserPanel/inc/temp_header') --}}
<style>
.viewCartModal{
    margin: 15px auto;position: fixed;left: 15px;right: 15px;top: 0;background: #fff;padding: 45px;display: none;height:595px;z-index:9;overflow-y:auto;
}
@media only screen and (max-width: 768px)
{
    .viewCartModal{
    padding: 45px 35px!important;
}
}

</style>

<div class="viewCartModal" style="">
    <span style="font-size: 14px;cursor: pointer;text-align: right;position: fixed;right: 35px;top: 28px;border: 1px solid #7367f0;color:#7367f0;border-radius: 100px;display: inline-block;width: 25px;height: 25px;text-align: center;line-height: 24px;" class="cartClose">X</span>
    <div class="viewCartModalBody customSlick-slider">
    <div class="product-detail accordion-detail">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="detail-gallery">
                        <!-- <span class="zoom-icon"></span> -->
                        @php
                        $file_name = url('storage/product/images'.'/'.$productDetails[0]->file_name);
                        $file_name2 = $productDetails[0]->file_name2 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name2):"";
                        $file_name3 = $productDetails[0]->file_name3 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name3):"";
                        $file_name4 = $productDetails[0]->file_name4 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name4):"";
                        $file_name5 = $productDetails[0]->file_name5 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name5):"";
                        $file_name6 = $productDetails[0]->file_name6 != ""?url('storage/product/images'.'/'.$productDetails[0]->file_name6):"";
                        @endphp
                        <img id="modal_zoom" src="{{$file_name}}" data-zoom-image="{{$file_name}}"/>

                        <div id="modal_img_zoom">

                          <a href="#" class="active" data-image="{{$file_name}}" data-zoom-image="{{$file_name}}">
                            <img id="modal_zoom" src="{{$file_name}}" class="img-fluid" />
                          </a>

                          @if($file_name2 != "")
                          <a href="#" data-image="{{$file_name2}}" data-zoom-image="{{$file_name2}}">
                            <img id="modal_zoom" src="{{$file_name2}}" class="img-fluid" />
                          </a>
                          @endif
                          
                          @if($file_name3 != "")
                          <a href="#" data-image="{{$file_name3}}" data-zoom-image="{{$file_name3}}">
                            <img id="modal_zoom" src="{{$file_name3}}" class="img-fluid" />
                          </a>
                          @endif
                          
                          @if($file_name4 != "")
                          <a href="#" data-image="{{$file_name4}}" data-zoom-image="{{$file_name4}}">
                            <img id="modal_zoom" src="{{$file_name4}}" class="img-fluid" />
                          </a>
                          @endif
                          
                          @if($file_name5 != "")
                          <a href="#" data-image="{{$file_name5}}" data-zoom-image="{{$file_name5}}">
                            <img id="modal_zoom" src="{{$file_name5}}" class="img-fluid" />
                          </a>
                          @endif
                          
                          @if($file_name6 != "")
                          <a href="#" data-image="{{$file_name6}}" data-zoom-image="{{$file_name6}}">
                            <img id="modal_zoom" src="{{$file_name6}}" class="img-fluid" />
                          </a>
                          @endif

                          <!-- <a href="#" data-image="images/small/image4.png" data-zoom-image="images/large/image4.jpg">
                            <img id="modal_zoom" src="images/thumb/image4.jpg" />
                          </a> -->

                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <form method="post" action="{{ route('addToShopCart',[$productDetails[0]->product_id])}}" onsubmit="addToCart('{{route("addToShopCart",[$productDetails[0]->product_id])}}'); event.preventDefault();" id="addToCart">
                    <input type="hidden" name="page_name" value="product_details"/>
                    <input type="hidden" name="color" id="req_color"/>
                    <input type="hidden" name="size" id="req_size"/>
                    <input type="hidden" name="qty" id="req_qty"/>
                    <input type="hidden" value="{{$productDetails[0]->product_id}}" id="product_id"/>
                    @csrf
                        <div class="detail-info detal-info2">
                            <h5 style="margin-bottom:8px;">{{$productDetails[0]->brand_name}}</h5>
                            <h2 class="title-detail">@if(isset($productDetails)){{$productDetails[0]->product_name}}@endif</h2>
                            <div class="product-detail-rating">
                                <div class="pro-details-brand">
                                    <span>{{$productDetails[0]->product_id}}</span>
                                </div>
                            </div>
                            @if($productDetails[0]->stock_status == 'stock_out')
                            <p style="font-weight: bold;color: orangered;">在庫なし</p>
                            @endif
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
                                    <a onclick="openProductDetails({{$sizeList[$key]->bango}},'{{route("quickViewProduct")}}')">
                                    <div class="pt_size" onclick="sizeSelection($(this),'{{$sizeList[$key]->size}}','{{$sizeList[$key]->bango}}')" style="display:inline-block;border: 2px solid #f3f5f5;min-width: 100px;padding: 0 3px;margin-bottom: 2px;text-align: center;height: 40px;line-height: 36px;border-radius: 4px;color:#000;@if($sizeList[$key]->size == $productDetails[0]->product_size) background:#d8d5fb;border:2px solid #7367f0;color:#000; @endif">
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
                                <a onclick="openProductDetails({{$colorList[$key]->bango}},'{{route("quickViewProduct")}}')">
                                <div class="pt_color" onclick="colorSelection($(this),'{{$colorList[$key]->color}}','{{$colorList[$key]->bango}}')" style="display:inline-block;border: 2px solid #f3f5f5;min-width: 100px;padding: 0 3px;margin-bottom: 2px;text-align: center;height: 40px;line-height: 36px;border-radius: 4px;color:#000;@if($colorList[$key]->color == $productDetails[0]->product_color) background:#d8d5fb;border:2px solid #7367f0;color:#000; @endif">
                                    {{$colorList[$key]->color}}
                                </div>
                                </a>
                                @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="product-quantity">
                                <label class="mb-15 mt-15">数量</label>
                                <div class="detail-extralink">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down">-</a>
                                        <!-- <span class="qty-val">1</span> -->
                                        <input type="text" name="" oninput = "this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" class="qty-val form-control form-qty-control" value="@if($productDetails[0]->stock_status == 'stock_out'){{0}}@else{{1}}@endif">
                                        <a href="#" class="qty-up">+</a>
                                    </div>
									
									@if($productDetails[0]->stock_status != 'stock_out')
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart" @if($productDetails[0]->stock_status == 'stock_out'){{'disabled'}}@endif>カートに追加</button>
                                    </div>
									@endif
									
                                </div>
                            </div>
							
							@if($productDetails[0]->gender != null)
                            <div class="mancloth" style="background:black;border-radius: 4px;text-align: center;color: white;padding: 20px 40px;display: inline-block;">
                                {{$productDetails[0]->gender}}
                            </div>
							@endif
							
                            @if($productDetails[0]->product_comment != null)<p style="padding-top: 15px;margin: 0px;">{!! nl2br(e($productDetails[0]->product_comment)) !!}</p>@endif
                            <div style="padding-top:15px; margin-bottom: 15px;display: flex;align-items: center;">
                                    <!-- <div class="product-color" style="margin-right: 13px;">
                                    素材表記 
                                    </div> -->
                                <div style="font-weight:bold;">
                                    {{$productDetails[0]->product_material}}
                                </div>
                            </div>

                            <!-- <div class="mb-15">
                                <p>着心地が良くリラックス感のあるコーディネートですが、やや光沢があるワンランク上の素材を使用したトップスを使ってどこか品のあるカジュアルコーデにしました。トップスは、サイドの紐を前or後ろで結んだり、紐付け根の穴に紐を入れ込むと紐無し仕様にもなる3way。様々な組み合わせを楽しんでください。</p>
                            </div> -->
                        </div>

                        {{-- <div class="collapsibles-wrapper" style="border:1px solid #e2e9e1 !important;">
                            <div class="contact-form" style="padding: 20px;cursor:pointer;position:relative;color:black;">
                                この商品について問い合わせる
                                    <span class="angel-icon" style="position: absolute;font-size: 30px;right: 7px;top: 6px;color: black;"><i class="fi-rs-angle-small-up"></i></span>
                            </div>
                            <div id="mail_msg"></div>
                            <div class="collapsibles-body" style="padding:0px 20px;display:none;padding-top: 25px;">
                                <div style="">
                                <div class="grid grid--small">
                                    <div class="d-flex">
                                        <div class="grid__item medium-up--one-half" style="width: 48%;margin-right:4%;">
                                                <label style="padding-bottom: 15px;">名前</label>
                                                <input name="name" id="contact_name" type="text" class="input-full">
                                            </div>
                                            <div class="grid__item medium-up--one-half" style="width: 48%;">
                                                <label style="padding-bottom: 15px;">メールアドレス</label>
                                                <input name="email" id="contact_email" type="email" class="input-full">
                                            </div>
                                    </div>
                                    </div>
                                    <div style="margin-top:30px">
                                        <label style="padding-bottom: 15px;">メッセージ</label>
                                        <textarea name="message" id="contact_message" rows="5" class="input-full" style="line-height: initial;"></textarea>
                                    </div>
                                    <button onclick="contactMail('{{url('/contactMail')}}','productDetails')" type="button" class="btn" style=" margin-top: 16px; margin-bottom: 20px;">送信</button>
                                </div>
                            </div>
                        </div> --}}      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="quick-modal-backdrop"></div>

{{-- @include('UserPanel/inc/footer') --}}

<script src="{{asset('UserPanel/js/vendor/jquery-3.6.0.min.js')}}"></script>
<!-- Image Zoom -->
<script src="{{asset('UserPanel/js/plugins/slick.js')}}"></script>
<script src="{{asset('UserPanel/js/plugins/jquery.elevatezoom.js')}}"></script>
<!-- Template  JS -->
<script src="{{asset('UserPanel/js/shop.js')}}"></script>
<script src="{{asset('UserPanel/js/main.js')}}"></script>
<script src="{{asset('UserPanel/js/custom.js')}}"></script>
<script type="text/javascript">
    // Accordion use......
    $(document).ready(function() {
        $(".contact-form").click(function() {
            $(".collapsibles-body").slideToggle("slow");
            $(".angel-icon i").toggleClass("fi-rs-angle-small-up fi-rs-angle-small-down", 1000);
        });
    });


    //initiate the plugin and pass the id of the div containing gallery images
    $("#modal_zoom").elevateZoom({
        gallery:'modal_img_zoom',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomType: "inner",
        // zoomWindowPosition: 'zoomBox',
        cursor: "crosshair"
     }); 

    //pass the images to Fancybox
    $("#modal_zoom").bind("click", function(e) {  
      var ez =   $('#modal_zoom').data('elevateZoom'); 
        $.fancybox(ez.getGalleryList());
      return false;
    });


    // Modal dismiss.....
    $(document).ready(function() {
        //$(".viewCart").click(function() {
        //    $(".viewCartModal").addClass("show");
        //});
        $(".cartClose").click(function() {
            // alert('hello');
            // $(".zoomContainer").hide();
            $(".zoomContainer").remove();
            $(".quick-modal-backdrop").hide();
            $(".viewCartModal").removeClass("show");

            $("body").removeClass("cartWrapper");
            // $(".zoomRemove").addClass('zoomContainer');
        });
    });
</script>