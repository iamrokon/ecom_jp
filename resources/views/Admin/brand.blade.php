@include('Admin.layouts.header')
{{-- @extends('admin.layouts.app')
--}}
{{-- @section('panel') --}}

<style>
    .details-table tr th,
    .details-table tr td{
        padding: 10px 0;
    }
    
    #add_error_list > ul > li{
        color:red;
    }
    #edit_error_list > ul > li{
        color:red;
    }
</style>
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
                <h6 class="page-title">ブランドマスタ</h6>
                <button class="btn btn-sm btn--success box--shadow1 text--small" onclick="document.getElementById('tableForm').submit();" id="search-button"><i class="la la-search" ></i>検索</button>
                <button class="btn btn-sm btn--info box--shadow1 text--small" onclick="refresh();"><i class="la la-broom" ></i>一覧</button>
            </div>
            <div class="col-lg-6 col-sm-6 text-sm-right mt-sm-0 mt-3">
                <button data-toggle="modal" data-target="#addModal" class="btn btn-sm btn--success box--shadow1 text--small"> <i class="las la-plus"></i> 新規登録</button>

                @if(request('collection')!='trashed')
                    <a href="{{ route('admin.brand.index' , ['collection' => 'trashed', 'page' => 1]) }} " class="btn btn-sm btn--danger box--shadow1 text--small"><i class="las la-trash-alt"></i>削除データ表示</a>
                @else
                    <a href="{{ route('admin.brand.index' , ['collection' => 'restored', 'page' => 1]) }} " class="btn btn-sm btn--secondary box--shadow1 text--small"><i class="las la-redo-alt"></i>有効データ</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if (session('status'))
                <div class="alert alert-success" style="margin-left: 15px;">
                    {{ session('status') }}
                </div>
                @endif
                <div class="card b-radius--10 ">
                    <div class="card-body">

                        <div class="row justify-content-start">
                            
                            @if (session('problem'))
                              <div class="alert alert-danger">
                                {{ session('problem') }}
                              </div>
                            @endif
                            <div class="col-lg-4 mb-3">
                            </div>
                        </div>
                        <form action="{{ request()->url() }}" method="GET" id="tableForm">
                            <input type="hidden" name="collection" value="{{ request('collection') }}">
                            <input type="hidden" id="sort_column" name="sort_column" value="{{ request('sort_column') }}">
                            <input type="hidden" id="sort_dir" name="sort_dir" value="{{ request('sort_dir') }}">
                            <div class="table-responsive">
                                <table class="table table--light style--two">
                                    <thead>
                                        <tr>
                                            <th>@lang('No.')</th>
                                            <th>@lang('画像')</th>
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
                                            <th>@lang('アクション')</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <tr class="table-search-form">
                                            <td></td>
                                            <td></td>
                                            @foreach($sortable_headers as $field)
                                                <td>
                                                    <input type="text" name="search[{{ $field }}]" class="form-control table-input" value={{ request('search.'.$field) }}>
                                                </td>
                                            @endforeach
                                            <td></td>
                                        </tr>
                                        @foreach($brands as $brand)
                                        <tr>
                                            <td>
                                                {{ $brand->bango }}
                                            </td>
                                            <td data-label="@lang('Logo')">
                                                <div class="thumbnails d-inline-block">
                                                    <div class="thumb">
                                                        <img src="{{ route('homepage').'/storage/category/images/'.$brand->image1 }}" alt="@lang('image')">
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach($sortable_headers as $field)
                                                @if($field=='patternsub1')
                                                    <td style="text-align: left;">
                                                        {{ strlen($brand->patternsub1)>50 ? substr($brand->patternsub1,0,50).'...' : $brand->patternsub1 }}
                                                    </td>
                                                @else
                                                    <td>{{ $brand->$field }}</td>
                                                @endif
                                            @endforeach
                                            <td data-label="@lang('Action')">
                                                @if(request('collection')!='trashed')
                                                    <button type="button" onclick="showEditModal('{{ $brand->bango }}')" class="icon-btn" data-toggle="tooltip" title="編集"> <i class="la la-pencil"></i></button>
                                                    <button type="button" onclick="showDeleteModal('{{ $brand->bango }}')" class="icon-btn btn--danger ml-1" data-toggle="tooltip" title="削除"> <i class="las la-trash"></i></button>
                                                @endif
                                                <button type="button" class="icon-btn btn--success ml-1" onclick="showDetailsModal('{{ $brand->bango }}')" data-toggle="tooltip" title="詳細"> <i class="las la-eye"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <!-- Pagination start here -->
                        <div class="custom-pageination-right">
                            {{ $brands->withQueryString()->links() }}
                        </div>
                        <!-- Pagination start here -->

            </div>
            <div class="card-footer py-4">
                {{-- {{ $brands->appends(['search'=>request()->search ?? null])->links('admin.partials.paginate') }} --}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@include('Admin.layouts.commonjs')

<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">@lang('登録　ブランド')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.brand.store') }}" enctype="multipart/form-data" id="addForm" method="POST" onsubmit="event.preventDefault();addFormHandler();">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div id="add_error_list" class="alert alert-danger">
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
                        <div class="col-md-6">
                            <div class="payment-method-item">
                                <label>@lang('画像') <span style="color: #ea5455">※</span></label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" id="addFormImage">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" onchange="addFormPhotoPreview(event);">
                                            <label for="profilePicUpload1" class="bg--primary">@lang('画像アップロード')</label>
                                            <small class="form-text text-muted mb-3"> @lang('対応ファイル形式:')
                                                <b>@lang('jpeg, jpg')</b>.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>@lang('ブランド名') <span style="color: #ea5455">※</span></label>
                                <input type="text" class="form-control" placeholder="@lang('ブランド名を入力してください')"  name="name"/>
                            </div>


                            <div class="form-group">
                                <label>@lang('説明') <span style="color: #ea5455">※</span></label>
                                <textarea name="description" rows="5" class="form-control" placeholder="説明を入力してください"></textarea>
                            </div>

                        </div>
                    </div>
                    <button type="submit" id="addFormButton" class="btn btn-block btn--primary mr-2">@lang('登録')</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">@lang('編集　ブランド')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" enctype="multipart/form-data" id="editForm" onsubmit="event.preventDefault();editFormHandler();">
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <div id="edit_error_list" class="alert alert-danger">
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
                        <div class="col-md-6">
                            <div class="payment-method-item">
                                <label>@lang('画像') <span style="color: #ea5455">※</span></label>
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" id="editFormImage">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload2"onchange="editFormPhotoPreview(event);">
                                            <label for="profilePicUpload2" class="bg--primary">@lang('画像アップロード')</label>
                                            <small class="form-text text-muted mb-3"> @lang('対応ファイル形式:')
                                                <b>@lang('jpeg, jpg')</b>.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>@lang('ブランド名') <span style="color: #ea5455">※</span></label>
                                <input type="text" class="form-control" placeholder="@lang('ブランド名を入力してください')" name="name"/>
                            </div>


                            <div class="form-group">
                                <label>@lang('説明') <span style="color: #ea5455">※</span></label>
                                <textarea name="description" rows="5" class="form-control" placeholder="説明を入力してください"></textarea>
                            </div>

                        </div>
                    </div>
                    <button type="button" id="editFormButton" onclick="editFormHandler()" class="btn btn-block btn--primary mr-2">@lang('更新')</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div id="detailsModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">@lang('ブランド詳細')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <table class="details-table">
                            <tbody>
                                <tr>
                                    <th width="31%">ブランド名</th>
                                    <th width="5%">:</th>
                                    <td width="64%" class="text-left" id="brand-details-name">adfaf</td>
                                </tr>
                                <tr>
                                    <th>説明</th>
                                    <th>:</th>
                                    <td class="text-left" id="brand-details-desc">adfaf</td>
                                </tr>
                                <tr>
                                    <th>画像</th>
                                    <th>:</th>
                                    <td class="text-left">
                                        <img src="logo.png" width="150px" id="brand-details-logo">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- REMOVE METHOD MODAL --}}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="#" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">ブランド削除</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">このブランドを削除してもよろしいですか？</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn--dark" data-dismiss="modal">@lang('しない')</button>
                    <button type="submit" class="btn btn-sm btn--danger">@lang('削除する')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.brand.restore') }}" method="POST" >
                @csrf
                <input type="hidden" name="bango" id="restoreBango">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize">Restore Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure to restore this brand?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn--dark" data-dismiss="modal">@lang('No')</button>
                    <button type="submit" class="btn btn-sm btn--danger">@lang('Yes')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}">

<script type="text/javascript">
    var editImageUrl = '';
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
                document.getElementById('add_error_list').innerHTML = '';
                var errors = JSON.parse(response);
                let ul = document.createElement('UL');
                document.getElementById('add_error_list').appendChild(ul);
                for (var field in errors)
                {
                    let li = document.createElement('LI');
                    li.innerText = errors[field][0];
                    ul.appendChild(li);
                }
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
                document.getElementById('edit_error_list').innerHTML = '';
                var errors = JSON.parse(response);
                let ul = document.createElement('UL');
                document.getElementById('edit_error_list').appendChild(ul);
                for (var field in errors)
                {
                    let li = document.createElement('LI');
                    li.innerText = errors[field][0];
                    ul.appendChild(li);
                }
                document.getElementById('editFormButton').disabled = false;
            }
        };
        let formData = new FormData(document.getElementById("editForm"));
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
        xhr.send(formData);
    }

    function addFormPhotoPreview(event)
    {
        var output = document.getElementById('addFormImage');
        if(event.target.files.length>0) output.setAttribute("style", "background-image: url('"+URL.createObjectURL(event.target.files[0])+"')");
        else output.setAttribute("style", "background-image: none)");
    }

    function editFormPhotoPreview(event)
    {
        var output = document.getElementById('editFormImage');
        if(event.target.files.length>0) output.setAttribute("style", "background-image: url('"+URL.createObjectURL(event.target.files[0])+"')");
        else output.setAttribute("style", "background-image: url('"+editImageUrl+"')");
    }

    $('#addModal').on('hidden.bs.modal', function () {
        $('#addFormImage').css("background-image", "none");
        $('#add_error_list').html("");
        $(this).find('form').trigger('reset');
    })

    function showDeleteModal(bango)
    {
        document.getElementById('deleteForm').action = "{{ route('admin.brand.destroy', ['brand' => '::brand::']) }}".replace('::brand::',bango);
        $('#deleteModal').modal('show');
    }

    function showRestoreModal(bango)
    {
        document.getElementById('restoreBango').value = bango;
        $('#restoreModal').modal('show');
    }

    function showEditModal(bango)
    {
        let xhr = new XMLHttpRequest();
        let route = "{{ route('admin.brand.edit', ['brand' => '::brand::']) }}".replace('::brand::', bango);
        xhr.open("GET",route,true);
        xhr.onload = function(event)
        {
            let brandObject = JSON.parse(event.target.response);
            let modal = $('#editModal');
            let imageRoute = "{{ route('homepage')}}" + "/storage/category/images/" + brandObject['image1'];
            editImageUrl = imageRoute;

            document.getElementById('editForm').action = "{{ route('admin.brand.update', ['brand' => '::brand::']) }}".replace('::brand::',brandObject['bango']);

            $('#edit_error_list').html("");
            modal.find('input[name=bango]').val(brandObject['bango']);
            $('#editFormImage').css('background-image', `url(${imageRoute})`);
            modal.find('input[name=name]').val(brandObject['zokusei']);
            modal.find('textarea[name=description]').val(brandObject['patternsub1']);
            modal.modal('show');
        };
        xhr.send();
    }

    function showDetailsModal(bango)
    {
        let xhr = new XMLHttpRequest();
        let route = "{{ route('admin.brand.edit', ['brand' => '::brand::']) }}".replace('::brand::', bango);
        xhr.open("GET",route,true);
        xhr.onload = function(event)
        {
            let brandObject = JSON.parse(event.target.response);
            let modal = $('#detailsModal');
            let imageRoute = "{{ route('homepage')}}" + "/storage/category/images/" + brandObject['image1'];

            document.getElementById('brand-details-name').innerText = brandObject['zokusei'];
            document.getElementById('brand-details-desc').innerText = brandObject['patternsub1'];
            document.getElementById('brand-details-logo').src = imageRoute;

            modal.modal('show');
        };
        xhr.send();
    }
</script>


<script>
    'use strict';
    (function($){

        $('.image-popup').magnificPopup({
            type: 'image'
        });

    })(jQuery)
</script>


