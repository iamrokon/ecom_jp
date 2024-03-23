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
          <h6 class="page-title">支払設定</h6>
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
                      <th>代金引換利用有無</th>
                      <th>代引手数料<br>(10,000円未満)</th>
                      <th>代引手数料<br>(10,000～30,000円)</th>
                      <th>代引手数料<br>(30,000円～100,000円)</th>
                      <th>代引手数料<br>(100,000円以上)</th>
                      <th>手数料一律</th>
                      <th>代引利用限度額</th>
                      <th>手数料無料基準値</th>
                      <th>クレジットカード<br>利用有無</th>
                      <th>クロネコ後払い<br>利用有無</th>
                      <th>手数料</th>
                      <th>利用限度額</th>
                      <th>手数料無料基準値</th>
                      <th>アクション</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <tr>
                      <td>{{ ($kokyaku->point3=='1') ? 'する' : 'しない' }}</td>
                      <td class="commafy">{{ $charges[0] . ($charges[0]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $charges[1] . ($charges[1]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $charges[2] . ($charges[2]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $charges[3] . ($charges[3]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $charges[4] . ($charges[4]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $charges[5] . ($charges[5]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $kokyaku->daibikigenkai . ($kokyaku->daibikigenkai!=NULL ? '円' : '') }}</td>
                      <td>{{ ($kokyaku->black1=='1') ? 'する' : 'しない' }}</td>
                      <td>{{ ($kokyaku->black2=='1') ? 'する' : 'しない' }}</td>
                      <td class="commafy">{{ $kuroneko_charges[0] . ($kuroneko_charges[0]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $kuroneko_charges[1] . ($kuroneko_charges[1]!=NULL ? '円' : '') }}</td>
                      <td class="commafy">{{ $kokyaku->kakakutaibango1 . ($kokyaku->kakakutaibango1!=NULL ? '円' : '') }}</td>
                      <td>
                        <button class="icon-btn" onclick="showEditModal();" data-toggle="tooltip" title="編集"> <i class="la la-pencil"></i></button>
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
              <h5 class="modal-title">支払設定</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

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
              <form action="#" id="editForm" onsubmit="event.preventDefault();editFormHandler();">
                @method('PATCH')
                <div class="form-group row">
                  <label class="col-lg-2 flexwidth mode">代金引換</label>
                  <div class="col-lg-3">
                    <table class="custom-table">
                      <tr>
                        <td width="30" class="mode">利用 </td>
                        <td class="mode"></td>
                        <td width="100px">
                          <select class="form-control" id="cash-on-delivery-select" name="cod" onchange="chargeToggle()">
                            <option value="1" @if($kokyaku->point3=="1") {{ "selected" }} @endif>する</option>
                            <option value="0" @if($kokyaku->point3=="0") {{ "selected" }} @endif>しない</option>
                          </select>
                        </td>
                        <td class="mode"></td>
                      </tr>

                    </table>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 flexwidth"></label>
                  <div class="col-lg-10">
                    <table class="custom-table cash-on-delivery-data">
                      <tr>
                        <td colspan="5" class="mode">手数料を設定する場合は、代引手数料（購入金額別）または手数料一律のどちらかに入力してください。</td>
                      </tr>
                      <tr>
                        <td class="mode line-icon" width="78">代引手数料</td>
                        <td width="20"></td>
                        <td class="mode" width="170px">10,000円未満</td>
                        <td width="120px"><input type="text" name="charge_~10k" maxlength="8" class="form-control form-number text-right" value="{{ $charges[0] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="mode" >10,000円以上30,000円未満</td>
                        <td><input type="text" name="charge_10k~30k" maxlength="8" class="form-control form-number text-right" value="{{ $charges[1] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="mode">30,000円以上100,000円未満</td>
                        <td><input type="text" name="charge_30k~100k" maxlength="8" class="form-control form-number text-right" value="{{ $charges[2] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td class="mode">100,000円以上</td>
                        <td><input type="text" name="charge_100k~" maxlength="8" class="form-control form-number text-right" value="{{ $charges[3] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 flexwidth"></label>
                  <div class="col-lg-6">
                    <table class="custom-table cash-on-delivery-data">

                      <tr>
                        <td width="105px" class="mode line-icon">手数料一律</td>
                        <td width="120px"><input type="text" name="flat_charge" maxlength="8" class="form-control form-number text-right" value="{{ $charges[4] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td class="mode">代引利用限度額 <span style="color: #ea5455">※</span></td>
                        <td><input type="text" name="cod_limit" maxlength="8" class="form-control form-number text-right" value="{{ $charges[5] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td class="mode">手数料無料基準値</td>
                        <td ><input type="text" name="free_value" maxlength="8" class="form-control form-number text-right" value="{{ $kokyaku->daibikigenkai }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="form-group row" style="    padding-top: 20px;padding-bottom: 20px;border-top: 1px solid #ced4da;border-bottom: 1px solid #ced4da">
                  <label class="col-lg-2 flexwidth mode">クレジットカード</label>
                  <div class="col-lg-3">
                    <table class="custom-table">

                      <tr>
                        <td width="40" class="mode">利用</td>
                        <td width="100">
                          <select class="form-control" name="credit">
                            <option value="1" @if($kokyaku->black1=="1") {{ "selected" }} @endif>する</option>
                            <option value="0" @if($kokyaku->black1=="0") {{ "selected" }} @endif>しない</option>
                          </select>
                        </td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 flexwidth mode">クロネコ後払い</label>
                  <div class="col-lg-3">
                    <table class="custom-table">
                      <tr>
                        <td width="40" class="mode">利用</td>
                        <td width="100">
                          <select class="form-control" id="kuroneko-deferred-payment-select" name="kuroneko_payment" onchange="kuronekoToggle();">
                            <option value="1" @if($kokyaku->black2=="1") {{ "selected" }} @endif>する</option>
                            <option value="0" @if($kokyaku->black2=="0") {{ "selected" }} @endif>しない</option>
                          </select>
                        </td>
                        <td></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-2 flexwidth"></label>
                  <div class="col-lg-4">
                    <table class="custom-table kuroneko-deferred-payment-data">
                      <tr>
                        <td width="136px" class="mode">手数料 <span style="color: #ea5455">※</span></td>
                        <td width="120px"><input type="text" name="kuroneko_fee" maxlength="8" class="form-control form-number text-right" value="{{ $kuroneko_charges[0] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td class="mode">利用限度額 <span style="color: #ea5455">※</span></td>
                        <td><input type="text" name="kuroneko_limit" maxlength="8" class="form-control form-number text-right" value="{{ $kuroneko_charges[1] }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                      <tr>
                        <td class="mode">手数料無料基準値</td>
                        <td><input type="text" name="kuroneko_free_value" maxlength="8" class="form-control form-number text-right" value="{{ $kokyaku->kakakutaibango1 }}"></td>
                        <td class="mode" style="padding-left:3px;">円</td>
                      </tr>
                    </table>
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

@include('Admin.layouts.commonjs')

<script type="text/javascript">

  function chargeToggle()
  {
    if($('#cash-on-delivery-select').val() == '1')
    {
      $(".cash-on-delivery-data").removeClass("d-none");
    }
    else
    {
      $(".cash-on-delivery-data").addClass("d-none");
    }
  }

  function kuronekoToggle()
  {
    if($('#kuroneko-deferred-payment-select').val() == '1')
    {
      $(".kuroneko-deferred-payment-data").removeClass("d-none");
    }
    else
    {
      $(".kuroneko-deferred-payment-data").addClass("d-none");
    }
  }
  chargeToggle();
  kuronekoToggle();
</script>


<script type="text/javascript">
  function showEditModal(bango = {{ env('store') }})
  {
    let modal = $('#editModal');
    clearError();
    document.getElementById('editForm').action = "{{ route('admin.payment.update', ['payment' => '::payment::']) }}".replace('::payment::',bango);
    
    modal.find('select[name=cod]').val("{{ $kokyaku->point3 }}").change();
    modal.find('input[name="charge_~10k"]').val("{{ $charges[0] }}");
    modal.find('input[name="charge_10k~30k"]').val("{{ $charges[1] }}");
    modal.find('input[name="charge_30k~100k"]').val("{{ $charges[2] }}");
    modal.find('input[name="charge_100k~"]').val("{{ $charges[3] }}");
    modal.find('input[name=flat_charge]').val("{{ $charges[4] }}");
    modal.find('input[name=cod_limit]').val("{{ $charges[5] }}");
    modal.find('input[name=free_value]').val("{{ $kokyaku->daibikigenkai }}");

    modal.find('select[name=credit]').val("{{ $kokyaku->black1 }}").change();

    modal.find('select[name=kuroneko_payment]').val("{{ $kokyaku->black2 }}").change();
    modal.find('input[name=kuroneko_fee]').val("{{ $kuroneko_charges[0] }}");
    modal.find('input[name=kuroneko_limit]').val("{{ $kuroneko_charges[1] }}");
    modal.find('input[name=kuroneko_free_value]').val("{{ $kokyaku->kakakutaibango1 }}");

    modal.modal('show');
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
        clearError();
        var errors = JSON.parse(response);
        let ul = document.createElement('UL');
        document.getElementById('edit_error_list').appendChild(ul);
        let isfocused = false;
        for (var field in errors)
        {
          if(errors[field][0]!=='')
          {
            let li = document.createElement('LI');
            li.innerText = errors[field][0];
            ul.appendChild(li);
          }
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

  function clearError()
  {
    document.getElementById('edit_error_list').innerHTML = '';

    let elements = document.forms["editForm"].elements;
    for (i=0; i<elements.length; i++){
      elements[i].classList.remove('form-error');
    }
  }
</script>


</body>
</html>
