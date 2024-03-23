@include('Admin.layouts.header')

<style>
    #error_list > ul > li{
        color:red;
    }
    #edit_error_list > ul > li{
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

  @php
    if(Route::is('admin.category.show')) $child_page = true;
    else $child_page = false;
  @endphp

  <div class="body-wrapper">
    <div class="bodywrapper__inner">

      <div class="row align-items-center mb-30 justify-content-between">
        <div class="col-lg-5 col-sm-4">
          @if($child_page)
            <h6 class="page-title">{{ $parent_name }} カテゴリ (子)一覧</h6>
          @else
            <h6 class="page-title">カテゴリ一覧</h6>
          @endif
          <button class="btn btn-sm btn--success box--shadow1 text--small" onclick="document.getElementById('tableForm').submit();" id="search-button"><i class="la la-search" ></i>検索</button>
          <button class="btn btn-sm btn--info box--shadow1 text--small" onclick="refresh();" id="refresh-button"><i class="la la-broom" ></i>一覧</button>
        </div>
        <div class="col-lg-7 col-sm-8 text-sm-right mt-sm-0 mt-3">
          <a class="btn btn-sm btn--success add-parent mb-xl-0 mb-2 box--shadow1 text--small" href="{{ route('admin.category.index' , ['collection' => 'restored', 'page' => 1]) }}" id="index-show-button" @if(!$child_page) style="display: none;" @endif> <i class="las la-list-ul"></i> カテゴリ一覧</a>
          <button class="btn btn-sm btn--primary add-parent mb-xl-0 mb-2 box--shadow1 text--small" id="add-parent-button" onclick="showParentForm()"> <i class="las la-plus"></i> 登録　カテゴリ(親)</button>
          <button class="btn btn-sm btn--success add-chlid mb-xl-0 mb-2 box--shadow1 text--small" id="add-child-button" onclick="showChildForm()"> <i class="las la-plus"></i> 登録　カテゴリ(子)</button>

          @if(request('collection')!='trashed')
            <a href="{{ route('admin.category.index' , ['collection' => 'trashed', 'page' => 1]) }} " class="btn btn-sm btn--danger mb-xl-0 mb-2 box--shadow1 text--small"><i class="las la-trash-alt"></i>@lang('削除データ表示')</a>
          @else
            <a href="{{ route('admin.category.index' , ['collection' => 'restored', 'page' => 1]) }} " class="btn btn-sm btn--secondary mb-xl-0 mb-2 box--shadow1 text--small"><i class="las la-redo-alt"></i>@lang('有効データ')</a>
          @endif
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-body" >
              <div class="alert alert-danger" id="error_list" style="margin: 0 1rem 1rem 1rem;">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @if (session('status'))
              <div class="alert alert-success" id="success_list">
                {{ session('status') }}
              </div>
              @endif
              @if (session('problem'))
              <div class="alert alert-danger" id="problem_list">
                {{ session('problem') }}
              </div>
              @endif
              <form action="{{ request()->url() }}" method="GET" id="tableForm">
                <input type="hidden" name="collection" value="{{ request('collection') }}">
                <input type="hidden" id="sort_column" name="sort_column" value="{{ request('sort_column') }}">
                <input type="hidden" id="sort_dir" name="sort_dir" value="{{ request('sort_dir') }}">
                <div class="table-responsive fixed-table-header" id="category-table">
                  <table class="table table--light style--two" width="100%">
                    <thead>
                      <tr>
                        <th>No.</th>
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
                        @if(request('collection')!='trashed')
                          <th>アクション</th>
                        @endif
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
                        @if(request('collection')!='trashed')
                          <td></td>
                        @endif
                      </tr>
                      @foreach($show_categories as $show_category)
                      <tr>
                        <td>{{ $show_category->bango }}</td>
                        @foreach($sortable_headers as $field)
                          <td>{{ $show_category->$field }}</td>
                        @endforeach
                        @if(request('collection')!='trashed')
                          <td>
                            <div class="d-flex justify-content-end">
                              <button type="button" class="icon-btn" onclick="showEditModal('{{ $show_category->bango }}')" data-toggle="tooltip" title="編集"> <i class="la la-pencil"></i></button>
                              <button type="button" class="icon-btn btn--danger ml-1" onclick="showDeleteModal('{{ $show_category->bango }}')" data-toggle="tooltip" title="削除"> <i class="las la-trash"></i></button>
                              @if(!$child_page)
                                <a class="icon-btn btn--success ml-1" href="{{ route('admin.category.show',['category' => $show_category->bango]) }}" data-toggle="tooltip" title="カテゴリ(子)"> <i class="las la-eye"></i></a>
                              @endif
                            </div>
                          </td>
                        @endif
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </form>
              <!-- Pagination start here -->
              <div class="custom-pageination-right" id="pagination-links">
                {{ $show_categories->withQueryString()->links() }}
              </div>
              <!-- Pagination end here -->

              <form style="display:none;" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" id="addForm" onsubmit="event.preventDefault();addFormHandler();">
                <div class="modal-body">
                  <h5 class="mb-3" id="add-form-child-header" style="display:none;">登録　カテゴリ(子)</h5>
                  <h5 class="mb-3" id="add-form-parent-header" style="display:none;">登録　カテゴリ(親)</h5>
                  <div class="row">
                    <div class="col">
                      <div class="text-right mb-3" style="font-size:12px;color: #ea5455;">
                        ※ は入力必須項目です。
                      </div>
                    </div>
                  </div>
                  @csrf
                  <div class="form-group row" id="parent-category-div">
                    <div class="col-lg-2 col-md-3">
                      <label class="font-weight-bold">カテゴリ(親)</label>
                    </div>

                    <div class="col-lg-10 col-md-9">
                      <select name="parent_id" class="form-control" id="parent-select-box">
                        @foreach($parent_categories as $parent_category)
                        <option value="{{ $parent_category->bango }}">{{ $parent_category->zokusei }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-2 col-md-3">
                      <label class="font-weight-bold">カテゴリ名  <span style="color: #ea5455">※</span></label>
                    </div>

                    <div class="col-lg-10 col-md-9">
                      <input type="text" class="form-control" placeholder="カテゴリ名を入力してください" name="name" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-2 col-md-3">
                      <label class="font-weight-bold">フロント表示</label>
                    </div>

                    <div class="col-lg-10 col-md-9">
                      <select name="will_display" class="form-control">
                        <option value="1">表示</option>
                        <option value="0">非表示</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-2 col-md-3">
                      <label class="font-weight-bold">表示順</label>
                    </div>

                    <div class="col-lg-10 col-md-9">
                      <input type="text" class="form-control" name="serial" autocomplete="off"/>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-block btn--primary" id="addFormButton">登録</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        {{-- EDIT MODAL --}}
        <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
              <div class="modal-header">
                @if(!$child_page)
                  <h5 class="modal-title">@lang('編集　カテゴリ(親)')</h5>
                @else
                  <h5 class="modal-title">@lang('編集　カテゴリ(子)')</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="#" enctype="multipart/form-data" id="editForm" onsubmit="event.preventDefault();editFormHandler();">
                @method('PATCH')
                <div class="modal-body">
                  <div class="row">
                    <div id="edit_error_list" class="alert alert-danger" style="margin: 0 15px 15px 15px;">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="text-right mb-2" style="font-size:12px;color: #ea5455;">
                        ※ は入力必須項目です。
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>@lang('カテゴリ名') <span style="color: #ea5455">※</span></label>
                        <input type="text" class="form-control" placeholder="@lang('カテゴリ名を入力してください')" name="name" />
                      </div>

                      <div class="form-group">
                        <label>フロント表示</label>
                        <select name="will_display" class="form-control">
                          <option value="1">表示</option>
                          <option value="0">非表示</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>表示順</label>
                        <input type="text" class="form-control" name="serial" autocomplete="off"/>
                      </div>
                    </div>
                  </div>
                  <button type="submit" id="editFormButton" class="btn btn-block btn--primary mr-2">@lang('更新')</button>
                </div>
              </form>
            </div>

          </div>
        </div>

        {{-- REMOVE METHOD MODAL --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <form action="#" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                  <h5 class="modal-title text-capitalize">カテゴリ削除</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @if($child_page)
                  <div class="modal-body">このカテゴリ(子)を削除してもよろしいですか？</div>
                @else
                  <div class="modal-body">このカテゴリ(親)を削除してもよろしいですか？</div>
                @endif
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn--dark" data-dismiss="modal">@lang('しない')</button>
                  <button type="submit" class="btn btn-sm btn--danger">@lang('削除する')</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <form action="{{ route('admin.category.restore') }}" method="POST" >
                @csrf
                <input type="hidden" name="bango" id="restoreBango">
                <div class="modal-header">
                  <h5 class="modal-title text-capitalize">Restore Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">Are you sure to restore this category?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn--dark" data-dismiss="modal">@lang('No')</button>
                    <button type="submit" class="btn btn-sm btn--danger">@lang('Yes')</button>
                </div>
              </form>
            </div>
          </div>
        </div>


      </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
  </div>






  @include('Admin.layouts.commonjs')

  <script type="text/javascript">
    function showCommon()
    {
      clearAddError();
      document.getElementById('addForm').style.display = "block";
      document.getElementById('search-button').style.display = "none";
      document.getElementById('refresh-button').style.display = "none";
      document.getElementById('index-show-button').style.display = "inline-block";
      document.getElementById('category-table').style.display = "none";
      document.getElementById('pagination-links').style.display = "none";
    }
    function showParentForm()
    {
      showCommon();
      document.getElementById('add-form-parent-header').style.display = "block";
      document.getElementById('add-form-child-header').style.display = "none";
      document.getElementById('add-child-button').style.display = "inline-block";
      document.getElementById('add-parent-button').style.display = "none";
      document.getElementById('parent-category-div').style.display = "none";
      document.getElementById('parent-select-box').selectedIndex = -1;
    }

    function showChildForm()
    {
      showCommon();
      
      document.getElementById('add-form-parent-header').style.display = "none";
      document.getElementById('add-form-child-header').style.display = "block";
      document.getElementById('add-child-button').style.display = "none";
      document.getElementById('add-parent-button').style.display = "inline-block";
      document.getElementById('parent-category-div').style.display = "flex";
      document.getElementById('parent-select-box').selectedIndex = 0;
    }


    function addFormHandler()
    {
      document.getElementById('addFormButton').disabled = true;
      let csrf = '{{ csrf_token() }}';
      let xhr = new XMLHttpRequest();
      let route = document.getElementById('addForm').action;
      xhr.open("POST",route,true);
      xhr.onload = function(event)
      {
        var response = event.target.response;

        if(response.substring(0, 2) === 'ok')
        {
          window.location.reload(true);
        }
        else
        {
          clearAddError();

          var errors = JSON.parse(response);
          let ul = document.createElement('UL');
          let isfocused = false;
          for (var field in errors)
          {
            let li = document.createElement('LI');
            li.innerText = errors[field][0];
            ul.appendChild(li);
            if(document.getElementById("addForm").elements.namedItem(field))
            {
              document.getElementById("addForm").elements.namedItem(field).classList.add('form-error');
              if(!isfocused)
              {
                document.getElementById("addForm").elements.namedItem(field).focus();
                isfocused = true;
              }
            }
          }
          document.getElementById('error_list').appendChild(ul);
          document.getElementById('addFormButton').disabled = false;
        }
      };
      let formData = new FormData(document.getElementById("addForm"));
      xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
      xhr.send(formData);
    }

    function editFormHandler()
    {
      document.getElementById('editFormButton').disabled = true;
      let csrf = '{{ csrf_token() }}';
      let xhr = new XMLHttpRequest();
      let route = document.getElementById('editForm').action;
      xhr.open("POST",route,true);
      xhr.onload = function(event)
      {
        var response = event.target.response;

        if(response.substring(0, 2) === 'ok')
        {
          window.location.reload(true);
        }
        else
        {
          clearEditError();
          var errors = JSON.parse(response);
          let ul = document.createElement('UL');
          document.getElementById('edit_error_list').appendChild(ul);
          let isfocused = false;
          for (var field in errors)
          {
            let li = document.createElement('LI');
            li.innerText = errors[field][0];
            ul.appendChild(li);
            if(document.getElementById("editForm").elements.namedItem(field))
            {
              document.getElementById("editForm").elements.namedItem(field).classList.add('form-error');
              if(!isfocused)
              {
                document.getElementById("editForm").elements.namedItem(field).focus();
                isfocused = true;
              }   
            }
          }
          document.getElementById('editFormButton').disabled = false;
        }
      };
      let formData = new FormData(document.getElementById("editForm"));
      xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
      xhr.send(formData);
    }

    function showEditModal(bango)
    {
      let xhr = new XMLHttpRequest();
      let route = "{{ route('admin.category.edit', ['category' => '::category::']) }}".replace('::category::',bango);
      xhr.open("GET",route,true);
      xhr.onload = function(event)
      {
        let categoryObject = JSON.parse(event.target.response);
        let modal = $('#editModal');

        document.getElementById('editForm').action = "{{ route('admin.category.update', ['category' => '::category::']) }}".replace('::category::',categoryObject['bango']);

        clearEditError();

        modal.find('input[name=name]').val(categoryObject['zokusei']);
        modal.find("select[name=will_display] option[value='"+categoryObject['category2']+"']").attr('selected','selected');
        modal.find('input[name=serial]').val(categoryObject['suchi1']);
        modal.modal('show');
      };
      xhr.send();
    }


    function showDeleteModal(bango)
    {
      document.getElementById('deleteForm').action = "{{ route('admin.category.destroy', ['category' => '::category::']) }}".replace('::category::',bango);
      $('#deleteModal').modal('show');
    }

    function showRestoreModal(bango)
    {
        document.getElementById('restoreBango').value = bango;
        $('#restoreModal').modal('show');
    }

    function clearAddError()
    {
      if(document.getElementById('success_list'))
      {
        document.getElementById('success_list').style.display = "none";
      }
      if(document.getElementById('problem_list'))
      {
        document.getElementById('problem_list').style.display = "none";
      }
      document.getElementById('error_list').innerHTML = "";
      
      let elements = document.forms["addForm"].elements;
      for (i=0; i<elements.length; i++)
      {
        elements[i].classList.remove('form-error');
      }
    }

    function clearEditError()
    {
      document.getElementById('edit_error_list').innerHTML = '';

      let elements = document.forms["editForm"].elements;
    
      for (i=0; i<elements.length; i++)
      {
        elements[i].classList.remove('form-error');
      }
    }
  </script>


  <script>
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
