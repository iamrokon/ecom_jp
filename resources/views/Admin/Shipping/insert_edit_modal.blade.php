<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content ">
              <div class="modal-header">
                <h5 class="modal-title" id="heading">新規登録</h5>
                <button type="button" class="close" onclick="refresh()"  aria-label="@lang('Close')">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <!-- <form action="#" enctype="multipart/form-data"> -->
                <div class="modal-body">

                  {{-- <div class="form-group row">
                    <label class="col-lg-1">配送会社名</label>
                    <div class="col-lg-11">
                      <table class="custom-table">
                        <tr>
                          <td>
                            <!-- <input type="text" class="form-control" placeholder="配送会社名" name="name" maxlength="20" /> -->

                            <select class="form-control" name="name">
                              @foreach($companies as $key=>$value)
                              <option value="{{$value->address}}">{{$value->address}}</option>
                              @endforeach
                            </select>
                            <input type="hidden" name="alt_name" value="">
                          </td>
                          <td class="mode">例：ヤマト運輸　ヤマト運輸コンパクト　ヤマト運輸ネコポス　ヤマトメール便　佐川急便　佐川急便メール　ゆうパック　レターパック　etc.</td>
                        </tr>
                      </table>
                    </div>
                  </div> --}}

                  <div class="row">
                    <div class="col">
                      <div class="text-right mb-2" style="font-size:12px;color: #ea5455;">
                        ※ は入力必須項目です。
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-1 mt-0"> 送料 <span style="color: #ea5455">※</label>
                    <div class="col-lg-8">
                      <table class="custom-table mb-3">
                        <tr>
                          <!-- <td class="mode align-top" width="80px">
                            常温
                          </td>
                          <td class="mode align-top" width="35px">
                            使用
                          </td>
                          <td class="mode align-top" width="80px">
                            する
                            <input type="hidden" name="opt_normal" value="1">
                          </td>
                          <td class="mode text-right pr-2 align-top" width="80px">
                           <div style="margin-top:3px"> 送料 <span style="color: #ea5455">※</span></div>
                          </td> -->
                          <td>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radio11" name="normal_temp" class="custom-control-input input-radio" value="一律">
                              <label class="custom-control-label" for="radio11" style="margin-top: 3px;">一律</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" id="radio12" name="normal_temp" class="custom-control-input button-radio" value="都道府県">
                              <label class="custom-control-label" for="radio12" style="margin-top: 3px;">都道府県別</label>
                            </div>
                            <span style="color:red;font-size:14px;" id="check_msg_1"></span>

                            <div class="check-active-input" style="width: 100%;">
                             <div class="d-flex">
                              <div style="width: 20%;">
                                  <input type="text" name="normal_temp_price" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" class="form-control" style="padding: 5px;">
                                </div>
                                <!-- <div class="tag">円</div> -->
                                <div style="width: 30px;padding:8px;">円</div>
                                <div>
                                  <p style="color:red;padding:8px;font-size:14px;" id='normal_err'></p>
                                </div>
                             </div>
                            </div>
                            <div class="check-active-button w-75">
                              <button type="button" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" onclick="open_kenModel('normal')">都道府県別送料</button>
                            </div>
                          </td>
                        </tr>
                        <!-- Modal -->
                         
                        <!-- <tr>
                          <td class="mode align-top" width="80px">
                            冷凍
                          </td>
                          <td class="mode align-top" width="35px">
                            使用
                          </td>
                          <td width="100px" class="align-top">
                            <select class="form-control option-use" name="opt_frozen">
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
                                <input type="radio" id="radio21" name="frozen_temp" class="custom-control-input input-radio1" value="一律">
                                <label class="custom-control-label mt-0" for="radio21" style="margin-top: 3px;">一律</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radio22" name="frozen_temp" class="custom-control-input button-radio1" value="都道府県">
                                <label class="custom-control-label mt-0" for="radio22" style="margin-top: 3px;">都道府県別</label>
                              </div>
                              <span style="color:red;font-size:14px;" id="check_msg_2"></span>

                              <div class="check-active-input1" style="width: 100%;">
                                <div class="d-flex">
                                  <div style="width:20%">
                                    <input type="text" name="frozen_temp_price" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" style="padding: 5px;" class="form-control">
                                  </div>
                                  <div style="padding: 8px;">円</div>
                                  <div style="padding: 8px;"><p style="color:red;font-size:14px;" id='frozen_err'></p></div>
                                </div>
                              </div>
                              <div class="check-active-button1 w-75">
                                <button type="button" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" onclick="open_kenModel('frozen')">都道府県別送料</button>
                              </div>
                            </div>
                            
                          </td>
                        </tr>

                        <tr>
                          <td class="mode align-top" width="80px">
                            冷凍
                          </td>
                          <td class="mode align-top" width="35px">
                            使用
                          </td>
                          <td width="100px" class="align-top">
                            <select class="form-control option-use1" name="opt_cold">
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
                                <input type="radio" id="radio31" name="cold_temp" class="custom-control-input input-radio2" value="一律">
                                <label class="custom-control-label mt-0" for="radio31" style="margin-top: 3px;">一律</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="radio32" name="cold_temp" class="custom-control-input button-radio2" value="都道府県">
                                <label class="custom-control-label mt-0" for="radio32" style="margin-top: 3px;">都道府県別</label>
                              </div>
                              <span style="color:red;font-size:14px;" id="check_msg_3"></span>

                              <div class="check-active-input2 " style="width: 100%;">
                                <div class="d-flex">
                                <div style="width: 20%;"><input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" name="cold_temp_price" maxlength="5" class="form-control" style="padding: 5px;"></div>
                                <div style="padding: 8px;">円</div>
                                  <div style="padding: 8px;"><p style="color:red;font-size:14px;" id='cold_err'></p></div>
                                </div>
                              </div>
                              <div class="check-active-button2 w-75">
                                <button type="button" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1" onclick="open_kenModel('cold')">都道府県別送料</button>
                              </div>
                            </div>
                            
                          </td>
                        </tr> -->
                      </table>
                      <table class="custom-table">
                        <tr>
                          <td class="mode" width="115px">送料無料基準値 <span style="color: #ea5455">※</span></td>
                          <td width="100px">
                              <input type="text" name="cash_on_delivery_fee" maxlength="8" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1')" class="form-control" style="padding: 5px;">
                          </td>
                          <td width="20px" class="mode">円</td>
                          <td> <div style="color:red;font-size:14px;" id="cash_on_msg" class="ml-3"></div></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-lg-1">着日指定</label>
                    <div class="col-lg-6">
                      <table class="custom-table">
                          <tbody><tr>
                            <td width="60" class="mode">使用</td>
                            <td width="100px">
                              <select class="form-control option-use3" name="duration_date">
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
                    <label class="col-lg-1"></label>
                    <div class="col-lg-6">
                      <table class="custom-table">
                        <tr>
                          <td width="110px" class="mode">選択可能開始日 <span style="color: #ea5455">※</span></td>
                          <!-- <td width="20px" class="mode">日</td> -->
                          <td width="80px"><input type="text" name="day_from" maxlength="3" class="form-control form-number" style="padding: 5px;"></td>
                          <td width="120px" class="mode">
                            日後から選択可能
                          </td>
                          <td> <div  style="color:red;font-size:14px;" id="from_day_msg" class="ml-3"></div></td>
                        </tr>
                        <tr>
                          <td width="90px" class="mode">選択可能最終日 <br>注文日より</td>
                          <!-- <td width="20px" class="mode">日</td> -->
                          <td width="80px"><input type="text" name="day_to" maxlength="3" class="form-control form-number" style="padding: 5px;" readonly="readonly" value="10"></td>
                          <td width="100px" class="mode">日後まで選択可能</td>
                          <td> <div  style="color:red;font-size:14px;" id="to_day_msg" class="ml-3"></div></td>
                        </tr>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-lg-1">時間帯指定</label>
                    <div class="col-lg-6">
                      <table class="custom-table">
                          <tr>
                            <td width="60" class="mode">使用</td>
                            <td width="100px">
                              <select class="form-control option-use2" name="delivery_time">
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
                  <label class="col-lg-1"></label>
                    <div class="col-lg-5">
                      <table class="custom-table active-mode2">
                          <tr>
                          <td class="mode">午前中</td>
                          </tr>
                          <tr>
                           
                            <td width="60"><input type="text" id="from_1" name="from[]" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td width="10" class="mode">時</td>
                            <td width="10">～</td>
                            <td width="60"><input type="text" id="to_1" name="to[]" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td width="40" class="mode">時 <span style="color: #ea5455">※</span></td>
                            <td> <div  style="color:red;font-size:14px;" id="time_msg_1" id="time_msg_1" class="ml-3"></div></td>
                          </tr>
                          <tr>

                            <td><input type="text" id="from_2" name="from[]" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td class="mode">時</td>
                            <td>～</td>
                            <td><input type="text" name="to[]" id="to_2" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>

                            <td class="mode">時</td>
                            <td> <div  style="color:red;font-size:14px;" id="time_msg_2" class="ml-3"></div></td>
                          </tr>
                          <tr>
                           

                            <td><input type="text" name="from[]" id="from_3" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td class="mode">時</td>
                            <td>～</td>
                            <td><input type="text" name="to[]" id="to_3" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>

                            <td class="mode">時</td>
                            <td> <div  style="color:red;font-size:14px;" id="time_msg_3" class="ml-3"></div></td>
                          </tr>
                          <tr>
                           

                            <td><input type="text" name="from[]" id="from_4" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td class="mode">時</td>
                            <td>～</td>
                            <td><input type="text" name="to[]" id="to_4" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>

                            <td class="mode">時</td>
                            <td> <div  style="color:red;font-size:14px;" id="time_msg_4" class="ml-3"></div></td>
                          </tr>
                          <tr>
                           

                            <td><input type="text" name="from[]" id="from_5" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td class="mode">時</td>
                            <td>～</td>
                            <td><input type="text" name="to[]" id="to_5" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>

                            <td class="mode">時</td>
                            <td> <div  style="color:red;font-size:14px;" id="time_msg_5" class="ml-3"></div></td>
                          </tr>
                          <tr>
                           

                            <td><input type="text" name="from[]" id="from_6" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>
                            <td class="mode">時</td>
                            <td>～</td>
                            <td><input type="text" name="to[]" id="to_6" maxlength="2" class="form-control form-number" style="padding: 5px;"></td>

                            <td class="mode">時</td>
                            <td> <div  style="color:red;font-size:14px;" id="time_msg_6" class="ml-3"></div></td>
                          </tr>
                      </table>
                    </div>
                    
                  </div>
                  <div class="moddal-button float-right my-4">
                    <button type="button" class="btn btn--danger add-parent mb-xl-0 mb-2 box--shadow1" onclick="refresh()"><i class="las la-times-circle"></i> キャンセル</button>
                    <a type=""  id="submit_btn" class="btn btn--primary add-parent mb-xl-0 mb-2 box--shadow1 text-white">登録</a>
                  </div>
                </div>
              <!-- </form> -->
            </div>
          </div>
        </div>