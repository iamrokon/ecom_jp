<div id="radioModal" class="modal fade radio-modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content ">
              <div class="modal-header">
                <h5 class="modal-title">県別送料設定</h5>
                <button type="button" class="close radio-m-close" aria-label="@lang('Close')">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="#" enctype="multipart/form-data">
                <div class="modal-body">

                  <div class="row">
                    <div class="col-lg-12">
                      <span class=" text-danger"><strong>※税込価格での設定をお願いします。</strong></span>
                    </div>
                    <div class="col-lg-4">
                      <table class="custom-table">
                        <thead class="text-center">
                          <tr>
                            <th width="80px"></th>
                            <th class="mode">常温送料<br>(税込)</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($kens['ken_1'] as $key=>$value)
                          <tr>
                            <th class="mode">{{$value}}</th>
                            <td>
                              <input type="text" name="normal[{{$value}}]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="5"  class="form-control form-number kingaku normal" placeholder="500円">
                            </td>
                           
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <div class="col-lg-4">
                      <table class="custom-table">
                        <thead class="text-center">
                          <tr>
                            <th width="80px"></th>
                            <th class="mode">常温送料<br>(税込)</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($kens['ken_2'] as $key=>$value)
                          <tr>
                            <th class="mode">{{$value}}</th>
                            <td>
                              <input type="text" name="normal[{{$value}}]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" maxlength="5" class="form-control form-number kingaku normal" placeholder="500円">
                            </td>
                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <div class="col-lg-4">
                      <table class="custom-table">
                        <thead class="text-center">
                          <tr>
                            <th width="80px"></th>
                            <th class="mode">常温送料<br>(税込)</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($kens['ken_3'] as $key=>$value)
                          <tr>
                            <th class="mode">{{$value}}</th>
                            <td>
                              <input type="text" name="normal[{{$value}}]" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')"  maxlength="5" class="form-control form-number kingaku normal" placeholder="500円">
                            </td>
                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                  <div class="moddal-button float-right my-4">
                    <button type="button" class="btn btn--danger add-parent mb-xl-0 mb-2 box--shadow1 radio-m-close"><i class="las la-times-circle"></i> キャンセル</button>
                    <a type="button" id="ken_submit" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1 text-white">更新</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          function validate_ken(type){
            var j=0;
            $('.'+type).each(function(i, obj) {
                if(!$(this).val()){
                  j++;
                  $(this).addClass('border-danger')
                }else{
                  $(this).removeClass('border-danger')
                }
            });

            if (j==0) {
              $('#radioModal').modal('hide');
            }
          }
        </script>