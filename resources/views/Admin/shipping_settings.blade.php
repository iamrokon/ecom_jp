@include('Admin.layouts.header')
<!-- page-wrapper start -->
<div class="page-wrapper default-version">
  @include('Admin.layouts.left_sidebar')
  <!-- sidebar end -->
  <!-- navbar-wrapper start -->
  @include('Admin.layouts.navber')
  <!-- navbar-wrapper end -->

<style>

.modalOverflow .modal {
    overflow: auto;
}
</style>
  <div class="body-wrapper">
    <div class="bodywrapper__inner">

      <div class="row align-items-center mb-30 justify-content-between">
        <div class="col-lg-6 col-sm-6">
          <h6 class="page-title">配送設定</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right">
          <button style="padding: 2px 12px;" class="icon-btn" data-toggle="modal" data-target="#editModal">新規登録</button>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-body">
              <div class="table-responsive--md table-responsive" id="category-table">
                <table class="table table--light style--two">
                  <thead>
                    <tr>
                      <th>配送会社名</th>
                      <th>常温送料選択一律/都道府</th>
                      <th>常温送料</th>
                      <th>冷凍使用有無</th>
                      <th>冷凍送料選択一律/都道府県別</th>
                      <th>冷凍送料</th>
                      <th>冷蔵使用有無</th>
                      <th>冷蔵送料選択一律/都道府県別</th>
                      <th>冷蔵送料</th>
                      <th>送料無料基準値</th>
                      <th>着日指定</th>
                      <th>時間帯指定使用有無</th>
                      <th>時間帯指定</th>
                      <th>アクション</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <tr>
                      <td>ヤマト運輸</td>
                      <td>一律</td>
                      <td>500円</td>
                      <td>する</td>
                      <td>一律</td>
                      <td>600円</td>
                      <td>する</td>
                      <td>一律</td>
                      <td>600円</td>
                      <td>6000円</td>
                      <td>1日後～10日後</td>
                      <td>する</td>
                      <td>午前中/12時～14時/14時～16時/16時～18時/18時～20時/19時～21時</td>
                      <td>
                        <button class="icon-btn" data-toggle="modal" data-target="#editModal"> <i class="la la-pencil"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>ネコポス</td>
                      <td>一律</td>
                      <td>500円</td>
                      <td>する</td>
                      <td>一律</td>
                      <td>600円</td>
                      <td>する</td>
                      <td>一律</td>
                      <td>600円</td>
                      <td>6000円</td>
                      <td>1日後～10日後</td>
                      <td>する</td>
                      <td>午前中/12時～14時/14時～16時/16時～18時/18時～20時/19時～21時</td>
                      <td>
                        <button class="icon-btn" data-toggle="modal" data-target="#editModal"> <i class="la la-pencil"></i></button>
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
                <h5 class="modal-title">配送設定</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Close')">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="#" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group row">
                    <label class="col-lg-1 mode">配送会社名</label>
                    <div class="col-lg-11">
                      <table class="custom-table">
                        <tr>
                          <td>
                            <input type="text" class="form-control" placeholder="配送会社名" name="" maxlength="20" />
                          </td>
                          <td class="mode">例：ヤマト運輸　ヤマト運輸コンパクト　ヤマト運輸ネコポス　ヤマトメール便　佐川急便　佐川急便メール　ゆうパック　レターパック　etc.</td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-1 mt-0 mode">お届け方法</label>
                    <div class="col-lg-6">
                      <table class="custom-table">
                        <tr>
                          <td class="mode align-top" width="80px">
                            常温
                          </td>
                          <td class="mode align-top" width="35px">
                            使用
                          </td>
                          <td class="mode align-top" width="80px">
                            する
                          </td>
                          <td class="mode text-right pr-2 align-top" width="80px">
                           <div style="margin-top:3px"> 送料</div>
                          </td>
                          <td>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radio11" name="radio1" class="custom-control-input input-radio">
                              <label class="custom-control-label" for="radio11" style="margin-top: 3px;">一律</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radio12" name="radio1" class="custom-control-input button-radio">
                              <label class="custom-control-label" for="radio12" style="margin-top: 3px;">都道府県</label>
                            </div>

                            <div class="check-active-input w-25">
                              <input type="text" name="" class="form-control">
                              <div class="tag">円</div>
                            </div>
                            <div class="check-active-button w-75">
                              <button type="button" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" data-toggle="modal" data-target="#radioModal">都道府県別の場合</button>
                            </div>
                          </td>
                        </tr>
                        <!-- Modal -->

                        <tr>
                          <td class="mode align-top" width="80px">
                            常温
                          </td>
                          <td class="mode align-top" width="35px">
                            使用
                          </td>
                          <td width="100px" class="align-top">
                            <select class="form-control option-use">
                              <option value="1">する</option>
                              <option value="0">しない</option>
                            </select>
                          </td>
                          <td class="mode text-right pr-2 align-top" width="80px">
                            <div class="active-mode" style="margin-top:-1px;">送料</div>
                          </td>
                          <td class="align-top">
                            <div class="active-radio">
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radio21" name="radio2" class="custom-control-input input-radio1">
                                <label class="custom-control-label mt-0" for="radio21" style="margin-top: 3px;">一律</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radio22" name="radio2" class="custom-control-input button-radio1">
                                <label class="custom-control-label mt-0" for="radio22" style="margin-top: 3px;">都道府県</label>
                              </div>

                              <div class="check-active-input1 w-25">
                                <input type="text" name="" class="form-control">
                                <div class="tag">円</div>
                              </div>
                              <div class="check-active-button1 w-75">
                                <button type="button" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" data-toggle="modal" data-target="#radioModal">都道府県別の場合</button>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td class="mode align-top" width="80px">
                            常温
                          </td>
                          <td class="mode align-top" width="35px">
                            使用
                          </td>
                          <td width="100px" class="align-top">
                            <select class="form-control option-use1">
                              <option value="1">する</option>
                              <option value="0">しない</option>
                            </select>
                          </td>
                          <td class="mode text-right pr-2 align-top" width="80px">
                            <span class="active-mode1" style="margin-top:1px;">送料</span>
                          </td>
                          <td class="align-top">
                            <div class="active-radio1">
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radio31" name="radio3" class="custom-control-input input-radio2">
                                <label class="custom-control-label mt-0" for="radio31" style="margin-top: 3px;">一律</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radio32" name="radio3" class="custom-control-input button-radio2">
                                <label class="custom-control-label mt-0" for="radio32" style="margin-top: 3px;">都道府県</label>
                              </div>

                              <div class="check-active-input2 w-25">
                                <input type="text" name="" class="form-control">
                                <div class="tag">円</div>
                              </div>
                              <div class="check-active-button2 w-75">
                                <button type="button" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" data-toggle="modal" data-target="#radioModal">都道府県別の場合</button>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </table>
                      <table class="custom-table">
                        <tr>
                          <td class="mode" width="115px">送料無料基準値</td>
                          <td width="100px">
                            <input type="text" name="" class="form-control">
                          </td>
                          <td class="mode">円</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group row" style="padding-top:20px;border-top:1px solid #ced4da;">
                    <label class="col-lg-1 mode">着日指定</label>
                    <div class="col-lg-6">
                      <table class="custom-table">
                          <tbody><tr>
                            <td width="60" class="mode">使用</td>
                            <td width="80px">
                              <select class="form-control option-use3">
                                <option value="1">する</option>
                                <option value="0">しない</option>
                              </select>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                      </tbody></table>
                    </div>
                  </div>
                  <div class="form-group row active-mode3">
                    <label class="col-lg-1 mode"></label>
                    <div class="col-lg-3">
                      <table class="custom-table">
                        <tr>
                          <td class="mode">選択可能開始 </td>
                          <td class="mode">日</td>
                          <td width="60px"><input type="text" name="" maxlength="3" class="form-control form-number"></td>
                          <td class="mode">日後から選択可能</td>
                        </tr>
                        <tr>
                          <td class="mode">選択可能最終 <br>注文日より</td>
                          <td class="mode">日</td>
                          <td width="60px"><input type="text" name="" maxlength="3" class="form-control form-number"></td>
                          <td class="mode">日後まで選択可能</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group row" style="border-top:1px solid #ced4da;padding-top:20px">
                    <label class="col-lg-1 mode">時間帯指定</label>
                    <div class="col-lg-6">
                      <table class="custom-table">
                          <tr>
                            <td width="60" class="mode">使用</td>
                            <td width="80px">
                              <select class="form-control option-use2">
                                <option value="1">する</option>
                                <option value="0">しない</option>
                              </select>
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group row">
                  <label class="col-lg-1 mode"></label>
                    <div class="col-lg-3">
                      <table class="custom-table active-mode2">
                          <tr>
                          <td class="mode">午前中</td>
                          </tr>
                          <tr>

                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                          </tr>
                          <tr>

                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                          </tr>
                          <tr>

                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                          </tr>
                          <tr>

                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                          </tr>
                          <tr>

                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                          </tr>
                          <tr>

                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="40"><input type="text" name="" maxlength="2" class="form-control form-number"></td>
                            <td width="10" class="mode">時</td>
                          </tr>
                      </table>
                    </div>
                  </div>
                  <div class="moddal-button float-right my-4">
                    <button type="button" class="btn btn--danger add-parent mb-xl-0 mb-2 box--shadow1" data-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1">更新</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div id="radioModal" class="modal fade radio-modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content ">
              <div class="modal-header">
                <h5 class="modal-title">都道府県別送料設定</h5>
                <button type="button" class="close radio-m-close" aria-label="@lang('Close')">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="#" enctype="multipart/form-data">
                <div class="modal-body">

                  <div class="row">
                    <div class="col-lg-4">
                      <table class="custom-table">
                        <thead class="text-center">
                          <tr>
                            <th width="80px"></th>
                            <th class="mode">常温送料<br>(税込)</th>
                            <th class="mode">冷凍料<br>(税込)</th>
                            <th class="mode">冷蔵送</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="mode">北海道</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">青森県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">岩手県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">宮城県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">秋田県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">山形県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">福島県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">茨木県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">栃木県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">群馬県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">埼玉県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">千葉県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">東京都</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">神奈川県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">新潟県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">富山県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-lg-4">
                      <table class="custom-table">
                        <thead class="text-center">
                          <tr>
                            <th width="80px"></th>
                            <th class="mode">常温送料<br>(税込)</th>
                            <th class="mode">冷凍料<br>(税込)</th>
                            <th class="mode">冷蔵送</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="mode">石川県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">福井県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">山梨県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">長野県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">岐阜県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">静岡県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">愛知県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">三重県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">滋賀県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">京都府</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">大阪府</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">兵庫県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">奈良県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">和歌山県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">鳥取県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">島根県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-lg-4">
                      <table class="custom-table">
                        <thead class="text-center">
                          <tr>
                            <th width="80px"></th>
                            <th class="mode">常温送料<br>(税込)</th>
                            <th class="mode">冷凍料<br>(税込)</th>
                            <th class="mode">冷蔵送</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="mode">岡山県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">広島県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">山口県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">徳島県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">香川県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">愛媛県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">高知県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">福岡県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">佐賀県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">長崎県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">熊本県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">大分県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">宮崎県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">鹿児島県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                          <tr>
                            <th class="mode">沖縄県</th>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                            <td>
                              <input type="text" name="" maxlength="8" class="form-control form-number" placeholder="500円">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="moddal-button float-right my-4">
                    <button type="button" class="btn btn--danger add-parent mb-xl-0 mb-2 box--shadow1 radio-m-close">キャンセル</button>
                    <button type="submit" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1">更新</button>
                  </div>
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

    // Active Inactive input and bitton........
    $(document).on("click", '.input-radio', function () {
      if ($(this).is(":checked")) {
        $('.check-active-input').addClass('d-block');
        $(".check-active-button").removeClass("d-block");
      }
    });

    $(document).on("click", '.button-radio', function () {
      if ($(this).is(":checked")) {
        $(".check-active-button").addClass("d-block");
        $('.check-active-input').removeClass('d-block');
      }
    });

    $(document).on("click", '.input-radio1', function () {
      if ($(this).is(":checked")) {
        $('.check-active-input1').addClass('d-block');
        $(".check-active-button1").removeClass("d-block");
      }
    });

    $(document).on("click", '.button-radio1', function () {
      if ($(this).is(":checked")) {
        $(".check-active-button1").addClass("d-block");
        $('.check-active-input1').removeClass('d-block');
      }
    });

    $(document).on("click", '.input-radio2', function () {
      if ($(this).is(":checked")) {
        $('.check-active-input2').addClass('d-block');
        $(".check-active-button2").removeClass("d-block");
      }
    });

    $(document).on("click", '.button-radio2', function () {
      if ($(this).is(":checked")) {
        $(".check-active-button2").addClass("d-block");
        $('.check-active-input2').removeClass('d-block');
      }
    });

    // Active Input & button section......
    $('.option-use').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode").removeClass("d-none");
        $(".active-radio").removeClass("d-none");
      }if($(this).val() == '0') {
        $(".active-mode").addClass("d-none");
        $(".active-radio").addClass("d-none");
      }
    });

    $('.option-use1').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode1").removeClass("d-none");
        $(".active-radio1").removeClass("d-none");
      }if($(this).val() == '0') {
        $(".active-mode1").addClass("d-none");
        $(".active-radio1").addClass("d-none");
      }
    });
    $('.option-use2').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode2").removeClass("d-none");

      }if($(this).val() == '0') {
        $(".active-mode2").addClass("d-none");

      }
    });
    $('.option-use3').on("change",function() {
      if($(this).val() == '1') {
        $(".active-mode3").removeClass("d-none");

      }if($(this).val() == '0') {
        $(".active-mode3").addClass("d-none");

      }
    });
  </script>


  <script>
    $('.radio-m-close').click(function() {
      $('.radio-modal').modal('hide');
    });
  </script>
  <script type="text/javascript">
    $("#radioModal").on("show.bs.modal", function (e) {
      $("body").addClass("modalOverflow");
    });
</script>

</body>
</html>
