@include('Admin.layouts.header')

<style>
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

  <div class="body-wrapper">
    <div class="bodywrapper__inner">

      <div class="row align-items-center mb-30 justify-content-between">
        <div class="col-lg-6 col-sm-6">
          <h6 class="page-title">ショップ設定</h6>
        </div>
      </div>
      @if (session('status'))
      <div class="alert alert-success" id="success_list">
        {{ session('status') }}
      </div>
      @endif

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-body">
              <div class="table-responsive" id="category-table">
                <table class="table table--light style--two">
                  <thead>
                    <tr>
                      <th>ショップ名</th>
                      <th>郵便番号</th>
                      <th>住所</th>
                      <th>電話番号</th>
                      <th>FAX番号</th>
                      <th>会社名</th>
                      <th>アクション</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <tr>
                      <td>{{ $kokyaku->name }}</td>
                      <td>{{ $kokyaku->yubinbango }}</td>
                      <td>{{ $kokyaku->address }}</td>
                      <td>{{ $kokyaku->tel }}</td>
                      <td>{{ $kokyaku->fax }}</td>
                      <td>{{ $kokyaku1_name }}</td>
                      <td>
                        <button class="icon-btn" onclick="showEditModal({{ env('store') }});" data-toggle="tooltip" title="編集"> <i class="la la-pencil"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>


            </div>
          </div>
        </div>
      </div>


      {{-- EDIT MODAL --}}
      <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
          <div class="modal-content ">
            <div class="modal-header">
              <h5 class="modal-title">ショップ設定</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-danger invisible" id="warning-message">更新はまだ完了していません。内容をご確認後、もう一度「更新」をお願いします。</p>
              <div class="row">
                <div id="edit_error_list" class="alert alert-danger" style="margin: 0 15px 15px 15px;">
                </div>
              </div>
              <form action="#" enctype="multipart/form-data" id="editForm" onsubmit="event.preventDefault();editFormHandler();">
                @method('PATCH')
                <input type="hidden" name="will_insert" id="will_insert" value="0">
                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>ショップ名 <span>※</span></label>
                  </div>
                  <div class="col-lg-5 col-md-7 col-sm-9">
                    <table>
                      <tr>
                        <td>
                          <input type="text" class="form-control" placeholder="ショップ名" name="name" maxlength="50" />
                        </td>
                        <td class="mode">(全半角)</td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>郵便番号 <span>※</span></label>
                  </div>
                  <div class="col-lg-5 col-md-8 col-sm-9">
                    <table>
                      <tr>
                        <td>
                          <input type="text" class="form-control form-number" id="zip1" name="zip1" maxlength="3" />
                        </td>
                        <td>-</td>
                        <td>
                          <input type="text" class="form-control form-number" id="zip2" name="zip2" maxlength="4" />
                        </td>
                        <td class="mode" width="58px">(半角数字)</td>
                        <td width="84px">
                          <button type="button" class="btn btn--primary" onclick="zipSearch();">住所検索</button>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>住所(都道府県) <span>※</span></label>
                  </div>
                  <div class="col-lg-5 col-md-7 col-sm-9">
                    <select class="form-control" name="prefecture" id="prefecture-select">
                      <option value="北海道">北海道</option>
                      <option value="青森県">青森県</option>
                      <option value="岩手県">岩手県</option>
                      <option value="宮城県">宮城県</option>
                      <option value="秋田県">秋田県</option>
                      <option value="山形県">山形県</option>
                      <option value="福島県">福島県</option>
                      <option value="茨城県">茨城県</option>
                      <option value="栃木県">栃木県</option>
                      <option value="群馬県">群馬県</option>
                      <option value="埼玉県">埼玉県</option>
                      <option value="千葉県">千葉県</option>
                      <option value="東京都">東京都</option>
                      <option value="神奈川県">神奈川県</option>
                      <option value="新潟県">新潟県</option>
                      <option value="富山県">富山県</option>
                      <option value="石川県">石川県</option>
                      <option value="福井県">福井県</option>
                      <option value="山梨県">山梨県</option>
                      <option value="長野県">長野県</option>
                      <option value="岐阜県">岐阜県</option>
                      <option value="静岡県">静岡県</option>
                      <option value="愛知県">愛知県</option>
                      <option value="三重県">三重県</option>
                      <option value="滋賀県">滋賀県</option>
                      <option value="京都府">京都府</option>
                      <option value="大阪府">大阪府</option>
                      <option value="兵庫県">兵庫県</option>
                      <option value="奈良県">奈良県</option>
                      <option value="和歌山県">和歌山県</option>
                      <option value="鳥取県">鳥取県</option>
                      <option value="島根県">島根県</option>
                      <option value="岡山県">岡山県</option>
                      <option value="広島県">広島県</option>
                      <option value="山口県">山口県</option>
                      <option value="徳島県">徳島県</option>
                      <option value="香川県">香川県</option>
                      <option value="愛媛県">愛媛県</option>
                      <option value="高知県">高知県</option>
                      <option value="福岡県">福岡県</option>
                      <option value="佐賀県">佐賀県</option>
                      <option value="長崎県">長崎県</option>
                      <option value="熊本県">熊本県</option>
                      <option value="大分県">大分県</option>
                      <option value="宮崎県">宮崎県</option>
                      <option value="鹿児島県">鹿児島県</option>
                      <option value="沖縄県">沖縄県</option>
                    </select>
                    <table class="mt-2">
                      <tr>
                        <td>
                          <input type="text" class="form-control" placeholder="住所" name="address" maxlength="100" id="address-text" />
                        </td>
                        <td class="mode">(全半角)</td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>電話番号 <span>※</span></label>
                  </div>
                  <div class="col-md-4 col-sm-9">
                    <table>
                      <tr>
                        <td>
                          <input type="text" class="form-control form-number" name="tel" maxlength="11" />
                        </td>
                        <td class="mode" width="70px">(半角数字)</td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>FAX番号 <span>※</span></label>
                  </div>
                  <div class="col-md-4 col-sm-9">
                    <table>
                      <tr>
                        <td>
                          <input type="text" class="form-control form-number" name="fax" maxlength="11" />
                        </td>
                        <td class="mode" width="70px">(半角数字)</td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                    <label class="m-0">会社名 <span>※</span></label>
                  </div>
                  <div class="col-md-4 col-sm-9">
                    <div class="mode mt-1" id="shop-name">

                    </div>
                  </div>
                </div>

                <div class="moddal-button float-right my-4">
                  <button type="button" class="btn btn--danger add-parent mb-xl-0 mb-2 box--shadow1" data-dismiss="modal"><i class="las la-times-circle"></i> キャンセル</button>
                  <button type="submit" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" id="editFormButton">更新</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


    </div><!-- bodywrapper__inner end -->
  </div><!-- body-wrapper end -->
</div>

<script>
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
      clearError();
      
      if(response.substring(0, 2) === 'ok')
      {
        if(document.getElementById('will_insert').value == '0')
        {
          document.getElementById('will_insert').value = '1';
          document.getElementById('warning-message').classList.remove("invisible");
          document.getElementById('editFormButton').disabled = false;
        }
        else window.location.reload(true);
      }
      else
      {
        var errors = JSON.parse(response);
        let ul = document.createElement('UL');
        document.getElementById('edit_error_list').appendChild(ul);
        let focused = false;
        for (var field in errors)
        {
          let li = document.createElement('LI');
          li.innerText = errors[field][0];
          ul.appendChild(li);
          if(document.getElementById('editForm').elements.namedItem(field))
          {
            document.getElementById('editForm').elements.namedItem(field).classList.add('form-error');
            if(!focused)
            {
              document.getElementById('editForm').elements.namedItem(field).focus();
              focused = true;
            }

          }
        }
        document.getElementById('editFormButton').disabled = false;
      }
    };
    let formData = new FormData(document.getElementById('editForm'));
    xhr.setRequestHeader('X-CSRF-TOKEN', csrf);
    xhr.send(formData);
  }

  function showEditModal(bango)
  {
    let xhr = new XMLHttpRequest();
    let route = "{{ route('admin.shop.edit', ['shop' => '::shop::']) }}".replace('::shop::', bango);
    xhr.open("GET",route,true);
    xhr.onload = function(event)
    {
      let shopObject = JSON.parse(event.target.response);
      let modal = $('#editModal');
      document.getElementById('warning-message').classList.add("invisible");
      document.getElementById('will_insert').value = '0';

      document.getElementById('editForm').action = "{{ route('admin.shop.update', ['shop' => '::shop::']) }}".replace('::shop::',bango);

      clearError();

      modal.find('input[name=name]').val(shopObject['name']);

      let zip = shopObject['yubinbango'].split('-');
      modal.find('input[name=zip1]').val(zip[0]);
      modal.find('input[name=zip2]').val(zip[1]);

      let address = shopObject['address'];
      modal.find("select[name=prefecture] option[value='"+address.substr(0,address.indexOf(' '))+"']").attr('selected','selected');
      modal.find('input[name=address]').val(address.substr(address.indexOf(' ')+1));

      modal.find('input[name=tel]').val(shopObject['tel']);

      modal.find('input[name=fax]').val(shopObject['fax']);

      modal.find('#shop-name').html('{{ $kokyaku1_name }}');

      modal.modal('show');
    };
    xhr.send();
  }

  function clearError()
  {
    document.getElementById('edit_error_list').innerHTML = '';

    let elements = document.forms["editForm"].elements;
    for (i=0; i<elements.length; i++){
      elements[i].classList.remove('form-error');
    }
  }

  async function zipSearch()
  {
    var zip = document.getElementById('zip1').value + document.getElementById('zip2').value;
    var address = await zipFinder(zip);
    
    if(address!='' && typeof address !== "undefined")
    {
      var i = address.indexOf(' ');
      var [prefecture , others] = [address.slice(0,i), address.slice(i+1)];
      document.getElementById('prefecture-select').value = prefecture;
      document.getElementById('address-text').value = others.replace(' ','');
    }
    else
    {
      document.getElementById('prefecture-select').value = '';
      document.getElementById('address-text').value = '';
    }
  }
</script>

@include('Admin.layouts.commonjs')
<script src="{{ asset('js/zip.js') }}"></script>

</body>
</html>
