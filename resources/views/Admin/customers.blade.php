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
        <h6 class="page-title">会員一覧 </h6>
        <button class="btn btn-sm btn--success box--shadow1 text--small" onclick="document.getElementById('tableForm').submit();" id="search-button"><i class="la la-search" ></i>検索</button>
        <button class="btn btn-sm btn--info box--shadow1 text--small" onclick="refresh();"><i class="la la-broom" ></i>一覧</button>
      </div>
    </div>

    <div class="row justify-content-center">

      <div class="loader-container text-center d-none">
        <span class="loader">
          <i class="fa fa-circle-notch fa-spin" aria-hidden="true"></i>
        </span>
      </div>

      <div class="col-lg-12">
        <div class="card b-radius--10 ">
          <div class="card-body">
            <form action="{{ request()->url() }}" method="GET" id="tableForm">
              <input type="hidden" name="collection" value="{{ request('collection') }}">
              <input type="hidden" id="sort_column" name="sort_column" value="{{ request('sort_column') }}">
              <input type="hidden" id="sort_dir" name="sort_dir" value="{{ request('sort_dir') }}">
              <div class="table-responsive" id="category-table"><!-- table-responsive--md -->
                <table class="table table--light style--two">
                  <thead>
                    <tr>
                      <th>S.N</th>
                      @foreach($sortable_headers as $heading => $db)
                        <th>{{ $heading }}
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
                    </tr>
                  </thead>
                  <tbody class="list">
                    <tr class="table-search-form">
                      <td></td>
                      @foreach($sortable_headers as $field)
                        <td>
                          <input type="text" name="search[{{ $field }}]" class="form-control table-input" value={{ request('search.'.$field) }}>
                        </td>
                      @endforeach
                    </tr>
                    @foreach($kaiins as $kaiin)
                    <tr>
                      <td>{{ ($kaiins->currentPage() - 1) * $kaiins->perPage() + $loop->iteration }}</td>
                      @foreach($sortable_headers as $field)
                        <td>{{ $kaiin->$field }}</td>
                      @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </form>
            <div class="custom-pageination-right">
              {{ $kaiins->withQueryString()->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- bodywrapper__inner end -->
</div><!-- body-wrapper end -->
</div>


<!-- jQuery library -->
@include('Admin.layouts.commonjs')




</body>
</html>
