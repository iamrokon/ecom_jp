<style>
    .subcat.open{
        display:block !important;
    }
</style>

<div class="col-lg-2 primary-sidebar d-none d-lg-block custom-col-lg-2">
    <div class="sidebar-widget price_range range mb-30 product-filter">

        <ul>

            <li > <!-- style="border-bottom: 1px solid #e2e9e1;" -->
                <a class="category iconUpDown" style="font-size: 16px;padding-bottom: 12px;display: block;position:relative;">カテゴリ <span style="position: absolute;right: 0;top: 4px;"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideDown auto-wordbrk" style="@if($cat == ''){{'display: none'}}@endif">
                    @foreach($categories as $categorie)
                    <li>
                        @php
                        $sub_categories = getSubCategoryList($categorie->bango);
                        @endphp
                        <div class="custome-checkbox">
                            <!-- <input class="form-check-input" type="checkbox" id="catCheckbox{{$categorie->bango}}" value="{{$categorie->zokusei}}" @if($categorie->zokusei == $cat){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),"{{$categorie->zokusei}}")' class="form-check-label" for="catCheckbox{{$categorie->bango}}"></label><span>{{$categorie->zokusei}}</span> -->
                            
                            <input name="cat[]" class="form-check-input" type="checkbox" id="catCheckbox{{$categorie->bango}}" value="{{$categorie->zokusei}}" @if(in_array($categorie->zokusei, $cat)){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),"{{$categorie->zokusei}}")' class="form-check-label" for="catCheckbox{{$categorie->bango}}"></label><span>{{$categorie->zokusei}}</span>
                            
                            <ul class="subcat" style="margin-left:15px; @if(in_array($categorie->zokusei, $cat)) {{'display: block'}} @else {{'display: none'}} @endif">
                                @if(count($sub_categories) > 0)
                                @foreach($sub_categories as $sub_category)
                                <li>
                                    <input name="sub_cat[]" class="form-check-input" type="checkbox" id="exampleCheckbox{{$sub_category->bango}}" value="{{$sub_category->zokusei}}" @if(in_array($sub_category->zokusei, $sub_cat)){{'checked'}}@endif>
                                    <label onclick='filterProductList($(this),null,null,null,null,null,"{{$sub_category->zokusei.'-'.$categorie->zokusei}}")' class="form-check-label" for="exampleCheckbox{{$sub_category->bango}}"><span>{{$sub_category->zokusei}}</span></label>
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
                <a class="allBrand iconUpDown2" style="font-size: 16px;margin-bottom: 10px;display: block;position:relative;margin-top:10px;">ブランド <span style="position: absolute;right: 0;top: 4px;"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideDownBrand auto-wordbrk" style="@if($brand == ''){{'display: none'}}@endif">
                    @foreach($brands as $brnd)
                    <div class="custome-checkbox">
                        <input class="form-check-input" type="checkbox" id="brandCheckbox{{$brnd->bango}}" value="" @if($brnd->zokusei == $brand){{'checked'}}@endif>
                        <label onclick='filterProductList($(this),null,"{{--$brnd->zokusei--}}")' class="form-check-label" for="brandCheckbox{{--$brnd->bango--}}"></label><span>{{--$brnd->zokusei--}}</span>
                        <br>
                    </div>
                    @endforeach
                </ul>
            </li> -->
            
            <!--
            <li style="border-bottom: 1px solid #e2e9e1;">
                <a class="gender iconUpDown3" style="font-size: 16px;margin-bottom: 10px;display: block;position:relative;margin-top:10px;">性別 <span style="position: absolute;right: 0;top: 4px;"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideGender" style="@if($type == ''){{'display: none'}}@endif">
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="catCheckbox31" value="Male" @if($type == "Male"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,"Male")' class="form-check-label" for="catCheckbox31"><span>Male</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="catCheckbox32" value="Female" @if($type == "Female"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,"Female")' class="form-check-label" for="catCheckbox32"><span>Female</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="catCheckboxKids" value="Kids" @if($type == "Kids"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,"Kids")' class="form-check-label" for="catCheckboxKids"><span>Kids</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="catCheckbox33" value="Unisex" @if($type == "Unisex"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,"Unisex")' class="form-check-label" for="catCheckbox33"><span>Unisex</span></label>
                            <br>
                        </div>
                    </li>
                </ul>
            </li>-->
            
            <!--
            <li style="border-bottom: 1px solid #e2e9e1;">
                <a class="priceDropdown iconUpDown4" style="font-size: 16px;margin-bottom: 10px;display: block;position:relative;margin-top:10px;">価格 <span style="position: absolute;right: 0;top: 4px;"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slidepriceDropdown" style="@if($price == ''){{'display: none'}}@endif">
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="priceCheckbox41_new" value="1〜999" @if($price == "1〜999"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,"1〜999")' class="form-check-label" for="priceCheckbox41_new"><span>1〜999円</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="priceCheckbox41" value="1000〜2999" @if($price == "1000〜2999"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,"1000〜2999")' class="form-check-label" for="priceCheckbox41"><span>1000〜2999円</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="priceCheckbox42" value="3000〜4999" @if($price == "3000〜4999"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,"3000〜4999")' class="form-check-label" for="priceCheckbox42"><span>3000〜4999円</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="priceCheckbox43" value="5000〜9999" @if($price == "5000〜9999"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,"5000〜9999")' class="form-check-label" for="priceCheckbox43"><span>5000〜9999円</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="priceCheckbox44" value="10000〜" @if($price == "10000〜"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,"10000〜")' class="form-check-label" for="priceCheckbox44"><span>10000円〜</span></label>
                            <br>
                        </div>
                    </li>
                </ul>
            </li>-->
            
            <!--
            <li>
                <a class="offDropdown iconUpDown5" style="font-size: 16px;margin-bottom: 10px;display: block;position:relative;margin-top:10px;">セール <span style="position: absolute;right: 0;top: 4px;"><i class="fi-rs-angle-small-up"></i></span></a>
                <ul class="slideoffDropdown" style="@if($off == ''){{'display: none'}}@endif">
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="offCheckbox51" value="80" @if($off == "80"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,null,"80")' class="form-check-label" for="offCheckbox51"><span>80％OFF〜</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="offCheckbox52" value="60〜79" @if($off == "60〜79"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,null,"60〜79")' class="form-check-label" for="offCheckbox52"><span>60〜79％OFF</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="offCheckbox53" value="50〜59" @if($off == "50〜59"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,null,"50〜59")' class="form-check-label" for="offCheckbox53"><span>50〜59％OFF</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="offCheckbox54" value="30〜49" @if($off == "30〜49"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,null,"30〜49")' class="form-check-label" for="offCheckbox54"><span>30〜49％OFF</span></label>
                            <br>
                        </div>
                    </li>
                    <li>
                        <div class="custome-checkbox">
                            <input class="form-check-input" type="checkbox" id="offCheckbox55" value="1〜29" @if($off == "1〜29"){{'checked'}}@endif>
                            <label onclick='filterProductList($(this),null,null,null,null,"1〜29")' class="form-check-label" for="offCheckbox55"><span>1〜29％OFF</span></label>
                            <br>
                        </div>
                    </li>
                </ul>
            </li>-->

        </ul>
    </div>

    <!-- <div class="sidebar-widget price_range range mb-30">
        <div class="widget-header position-relative mb-20 pb-10">
            <h5 class="widget-title mb-10">Category</h5>
            <div class="bt-1 border-color-1"></div>
        </div>
        <div class="list-group">
            <div class="list-group-item mb-10 mt-10">
                @foreach($categories as $categorie)
                <div class="custome-checkbox">
                    <input class="form-check-input" type="checkbox" id="catCheckbox{{$categorie->bango}}" value="{{$categorie->zokusei}}" @if($categorie->zokusei == $cat){{'checked'}}@endif>
                    <label onclick='filterProductList($(this),"{{$categorie->zokusei}}")' class="form-check-label" for="catCheckbox{{$categorie->bango}}"><span>{{$categorie->zokusei}}</span></label>
                    <br>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="sidebar-widget price_range range mb-30">
        <div class="widget-header position-relative mb-20 pb-10">
            <h5 class="widget-title mb-10">Brands</h5>
            <div class="bt-1 border-color-1"></div>
        </div>
        <div class="list-group">
            <div class="list-group-item mb-10 mt-10">
                @foreach($brands as $brnd)
                <div class="custome-checkbox">
                    <input class="form-check-input" type="checkbox" id="brandCheckbox{{$brnd->bango}}" value="" @if($brnd->zokusei == $brand){{'checked'}}@endif>
                    <label onclick='filterProductList($(this),null,"{{$brnd->zokusei}}")' class="form-check-label" for="brandCheckbox{{$brnd->bango}}"><span>{{$brnd->zokusei}}</span></label>
                    <br>
                </div>
                @endforeach
            </div>
        </div>
    </div> -->
</div>