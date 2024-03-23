@include('Admin.layouts.header')

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
        <h6 class="page-title">商品マスタ</h6>
        <button class="btn btn-sm btn--success box--shadow1 text--small" onclick="document.getElementById('tableForm').submit();" id="search-button"><i class="la la-search" ></i>検索</button>
        <button class="btn btn-sm btn--info box--shadow1 text--small" onclick="refresh();"><i class="la la-broom" ></i>一　覧</button>
      </div>
      <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn--success box--shadow1 text--small"><i class="la la-plus"></i>新規登録</a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card b-radius--10">
          <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" id="success_list">
              {{ session('status') }}
            </div>
            @endif
            <form action="{{ request()->url() }}" method="GET" id="tableForm">
              <input type="hidden" name="collection" value="{{ request('collection') }}">
              <input type="hidden" id="sort_column" name="sort_column" value="{{ request('sort_column') }}">
              <input type="hidden" id="sort_dir" name="sort_dir" value="{{ request('sort_dir') }}">
              <div class="table-responsive fixed-table-header">
                <table class="table table--light style--two">
                  <thead>
                    <tr>
                      <th>S.N</th>
                      <th>画像</th>
                      @foreach($sortable_headers as $heading => $db)
                        <th @if($db=='jouhou')class="text-left"@endif class="text-left">{{ $heading }}
                          <a
                            role="button"
                            class="text-white top-arrow @if(request('sort_column')==$db && request('sort_dir')=='asc') {{ ' invisible' }} @endif"
                            onclick="sort('{{ $db }}', 'asc')">
                              <i class="las la-sort-up"></i>
                          </a>
                          <a
                            role="button"
                            class="text-white bottom-arrow @if(request('sort_column')==$db && request('sort_dir')=='desc') {{ ' invisible' }} @endif"
                            onclick="sort('{{ $db }}', 'desc')">
                              <i class="las la-sort-down"></i>
                          </a>
                        </th>
                      @endforeach
                      <th>アクション</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table-search-form">
                      <td>
                        <input type="text" name="search[bango]" style="min-width: 60px;" class="form-control table-input" value={{ request('search.bango') }}>
                      </td>
                      <td>
                      </td>
                      @foreach($sortable_headers as $field)
                        <td>
                          <input type="text" name="search[{{ $field }}]" class="form-control table-input" value={{ request('search.'.$field) }}>
                        </td>
                      @endforeach
                      <td></td>
                    </tr>
                    @foreach($products as $product)
                    <tr>
                      <td>{{ $product->bango }}</td>
                      <td>
                        <div class="thumbnails d-inline-block">
                          <div class="thumb">
                            <!-- <a href="{{ route('homepage').'/storage/product/images/'.$product->picture }}">
                              <img src="{{ route('homepage').'/storage/product/images/'.$product->picture }}" alt="image">
                            </a> -->
                            <img src="{{ route('homepage').'/storage/product/images/'.$product->picture }}" alt="image">
                          </div>
                        </div>
                      </td>
                      @foreach($sortable_headers as $field)
                      	@if(in_array($field, [ 'datatxt0106' , 'datatxt0107', 'datatxt0108']))
                      		<td>{!! nl2br(e($product->$field)) !!}</td>
                      	@else
                        	<td class="text-left">{{ $product->$field }}</td>
                        @endif
                      @endforeach
                      <td data-label="Action">
                        <a href="{{ route('admin.products.edit', ['product' => $product->bango]) }}" class="icon-btn btn--primary  mr-1" data-toggle="tooltip" data-placement="top" title="編集">
                          <i class="la la-pencil"></i>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </form>
            <div class="custom-pageination-right">
              {{ $products->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- bodywrapper__inner end -->
</div><!-- body-wrapper end -->
</div>


@include('Admin.layouts.commonjs')


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
