@include('Admin.layouts.header')

<style>
    #error_list > ul > li{
        color:red;
    }  
</style>

<!-- page-wrapper start -->
<div class="page-wrapper default-version">
   @include('Admin.layouts.left_sidebar')
   <!-- sidebar end -->
   <!-- navbar-wrapper start -->
   @include('Admin.layouts.navber')
   <!-- navbar-wrapper end -->

   <div class="body-wrapper">
    <div class="bodywrapper__inner">

        <div class="row align-items-center mb-30 justify-content-between">
            <div class="col-lg-6 col-sm-6">
                <h6 class="page-title">商品登録</h6>
            </div>
            <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3">
                <a class="btn btn-sm btn--success box--shadow1 text--small"href="{{ route('admin.products.index' , ['collection' => 'restored', 'page' => 1]) }} " > <i class="fas fa-list"></i> 一覧</a>
                <!-- <a class="btn btn-sm btn--danger box--shadow1 text--small" href="{{ route('admin.products.index' , ['collection' => 'trashed', 'page' => 1]) }}"> <i class="las la-trash-alt"></i> 削除データ表示</a> -->
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="loader-container text-center d-none">
                <span class="loader">
                    <i class="fa fa-circle-notch fa-spin" aria-hidden="true"></i>
                </span>
            </div>

            <div class="col-lg-12">

                <div id="error_list" class="alert alert-danger">
                    @if ($errors->any())
                        <ul class="alert-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if (session('status'))
                    <div id="success_list" class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form id="mainForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();mainFormHandler();">
                @csrf
                <div class="card p-2 has-select2">
                    <div class="card-header">
                        <h5 class="card-title mb-0">商品情報</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                              <div class="text-right mb-3" style="font-size:12px;color: #ea5455;">
                                ※ は入力必須項目です。
                              </div>
                            </div>
                          </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">仕入先 </label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <select name="kokyaku" class="form-control">
                                    @foreach($kokyakus as $kokyaku)
                                        <option value="{{ $kokyaku->bango }}">{{ $kokyaku->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">商品名 <span style="color: #ea5455">※</span></label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" placeholder="商品名" name="jouhou" maxlength="255"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">品番 <span style="color: #ea5455">※</span></label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" name="brand_part" placeholder="品番" maxlength="100"/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card p-2 my-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">商品詳細</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">カテゴリ（親）</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <select id="parent_category" name="parent_category" class="form-control" onchange="generateChildCategory();">
                                    @foreach($parent_categories as $parent_category)
                                        <option value="{{ $parent_category->bango }}">{{ $parent_category->zokusei }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">カテゴリ（子）</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <select id="child_category" name="child_category" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">キャプション</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" placeholder="キャプション" name="mdjouhou" maxlength="10" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">SKU <span style="color: #ea5455">※</span></label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" placeholder="SKU" name="sku" maxlength="50" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">JAN/EAN コード</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control form-number" placeholder="JAN/EAN コード" name="jan_code" maxlength="50" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                    <label class="font-weight-bold">キャプション2</label>
                                </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" placeholder="キャプション2" name="data50" maxlength="10" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">サイズ</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" placeholder="サイズ" name="size" maxlength="100"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">カラー</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <input type="text" class="form-control" placeholder="カラー" name="color" maxlength="100"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">小売希望価格（税込）</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-number" placeholder="小売希望価格（税込）" name="retail_price" maxlength="8" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">サイト販売価格（税込） <span style="color: #ea5455">※</span></label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-number" placeholder="サイト販売価格（税込）" name="selling_price" maxlength="8"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">入荷原価（税抜）</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-number" placeholder="入荷原価（税抜）"name="arrival_cost" maxlength="8" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">消費税率 (%)</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-number" placeholder="消費税率" name="tax_rate" maxlength="2"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">素材表記</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <textarea rows="5" class="form-control" name="material_notation" placeholder="素材表記" maxlength="2000" style="max-height: 120px;min-height: 120px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">採寸情報</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <textarea rows="2" class="form-control" name="measuring_info" placeholder="採寸情報" maxlength="600" style="max-height: 100px;min-height: 100px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">商品購入上限数 <span style="color: #ea5455">※</span></label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-number" placeholder="商品購入上限数" name="max_purchase" maxlength="3"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">商品一覧表示フラグ</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="customRadio1" name="display_flag" value="1" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio1">表示する</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="display_flag" value="0" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">表示しない</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">出店フラグ</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="customRadio3" name="store_flag" value="1" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio3">する</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="store_flag" value="0" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio4">しない</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">おすすめ</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="custom-control custom-radio mr-3">
                                    <input type="radio" id="customRadio5" name="recommendation" value="1" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio5">する</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio6" name="recommendation" value="0" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio6">しない</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">商品コメント</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <textarea rows="5" class="form-control" name="comment" placeholder="商品コメント" maxlength="2000" style="max-height: 120px;min-height: 120px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-2 my-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">商品画像アップロード</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">メイン画像 <span style="color: #ea5455">※</span></label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="payment-method-item">
                                    <div class="payment-method-header d-flex flex-wrap">
                                        <div class="thumb" style="margin-bottom: 15px;">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" id="main-image-box"></div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" name="main_image" class="profilePicUpload" id="image" required >
                                                <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-muted mb-3"> 対応ファイル形式: <b>jpeg, jpg</b>.</small>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="photo_list" id="photo_list" value="||" class="d-none">
                    </form>
                    <form id="photosForm" action="{{ route('image') }}" enctype="multipart/formdata">
                        <div class="form-group row">
                            <div class="col-lg-3 col-md-4">
                                <label class="font-weight-bold">追加画像</label>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <label class="btn btn-dark" for="photosFileSelector" id="photosFileLabel">
                                    <input onchange="photosPreview()" type="file" id="photosFileSelector" name="photos[]" multiple class="d-none">
                                    ファイルを選択<i id="photosFileSelectorSpinner" class="la la-spinner la-spin d-none"></i>
                                </label>
                            </div>
                        </div>
                        <input type="hidden" id="uploadedImageNumber" name="uploadedImageNumber" value="0">
                    </form>
                    <div class="form-group row" id="frames"></div>
                    </div>
                </div>
                <button id="mainFormButton" type="button" onclick="mainFormHandler();" class="btn btn-block btn--primary mr-2">登  録</button>
            {{-- </form> --}}
        </div>
    </div>

    {{-- <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close ml-auto m-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body text-center">
                    <i class="las la-times-circle f-size--100 text--danger mb-15"></i>
                    <h3 class="text--danger mb-15">Error: Cannot process your entry!</h3>
                    <p class="mb-15">【追加画像】5つまで選択可能です。</p>
                    <button type="button" class="btn btn--danger" data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div> --}}



</div><!-- bodywrapper__inner end -->
</div><!-- body-wrapper end -->
</div>

<!-- jQuery library -->
@include('Admin.layouts.commonjs')
@include('Admin.Product.scripts')

<script type="text/javascript">
    generateChildCategory();
</script>
<script type="text/javascript">
    (function($){
        "use strict";
        bkLib.onDomLoaded(function() {
            $( ".nicEdit" ).each(function( index ) {
                $(this).attr("id","nicEditor"+index);
                new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
            });
        });

    })(jQuery);
</script>

</body>
</html>
