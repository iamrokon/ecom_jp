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

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-header">
              メール設定
              @if($pageType == '')<button id="editButton" class="icon-btn float-right btn-edit-enable"><i class="lar la-edit mr-2"></i> 編集</button>@endif
              <button id="topEditButton" style="display:none;" class="icon-btn float-right btn-edit-enable"><i class="lar la-edit mr-2"></i> 編集</button>
            </div>
            <div class="card-body">
              <div class="custom-tab-block">
                <ul class="nav nav-pills custom-tab">
                  <li class="nav-item">
                    <a class="nav-link @if($pageType == '') active @endif" data-toggle="tab" href="#home" onclick='showEditButton()' role="tab">メール設定</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if($pageType != '') active @endif" data-toggle="tab" href="#profile" onclick='hideEditButton()' role="tab">メールリスト</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade @if($pageType == '') show active @endif"" id="home" role="tabpanel" aria-labelledby="home-tab">
                      @if ($errors->any())
                      <div style="margin-bottom: 15px;">
                        @foreach ($errors->all() as $error)
                        <span style="display:block;color: #ff4c5e;font-size: 13px;">{{ $error }}</span>
                        @endforeach
                      </div>
                    @endif
                    <div class="row">
                      <div class="col">
                        <div class="text-right mb-2" style="font-size:12px;color: #ea5455;">
                          ※ は入力必須項目です。
                        </div>
                      </div>
                    </div>
                    <form method="POST" action="{{ route('admin.mailsetup')}}" id="mailSetupForm">
                      @csrf
                      <div class="form-group row">
                        <label class="col-lg-3 col-md-4">送信元メールアドレス（From） <span style="color: #ea5455">※</span></label>
                        <div class="col-md-4">                            
                          <input type="mail" name="mail1" class="form-control enable-form-control @if(isset($err_fields['mail1'])) form-error @endif " @if(isset($err_fields) && count($err_fields) > 0) '' @else readonly="" @endif value="{{isset($mails->mail_soushin)?$mails->mail_soushin:request('mail1')}}">
                        </div>
                        <div class="col-md-4" style="font-size: .75rem;">
                          メールのFromメールアドレス
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-md-4">注文受付メールアドレス <span style="color: #ea5455">※</span></label>
                        <div class="col-md-4">                            
                          <input type="mail" name="mail3" class="form-control enable-form-control @if(isset($err_fields['mail3'])) form-error @endif " @if(isset($err_fields) && count($err_fields) > 0) '' @else readonly="" @endif value="{{isset($mails->mail_soushin_mb)?$mails->mail_soushin_mb:request('mail3')}}">
                        </div>
                        <div class="col-md-4" style="font-size: .75rem;">
                          注文時の<span style="color: #ea5455">宛先メールアドレス</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-md-4">問合せ受付メールアドレス <span style="color: #ea5455">※</span></label>
                        <div class="col-md-4">
                          <input type="mail" name="mail2" class="form-control enable-form-control @if(isset($err_fields['mail2'])) form-error @endif " @if(isset($err_fields) && count($err_fields) > 0) '' @else readonly="" @endif value="{{isset($mails->mail_toiawase)?$mails->mail_toiawase:request('mail2')}}">
                        </div>
                        <div class="col-md-4" style="font-size: .75rem;">
                          問合せ時の<span style="color: #ea5455">宛先メールアドレス</span>
                        </div>
                      </div>

                      <div class="text-sm-right send-btn-active" style="@if(!isset($err_fields['mail1']) && !isset($err_fields['mail2']) && !isset($err_fields['mail3'])) display: none; @endif">
                          <a href="{{url('admin/mail')}}" class="btn btn--primary box--shadow1"> <i class="las la-times-circle"></i> キャンセル</a>
                        <button class="btn btn--primary box--shadow1"> <i class="las la-save"></i> 更新</button>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane fade @if($pageType != '') show active @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                      <table class="table table--light style--two">
                        <thead>
                          <tr>
                            <td class="text-center">お名前</td>
                            <td style="min-width:170px;">使用</td>
                            <td>送信タイミング</td>
                            <td class="text-center">アクション</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>受注メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="{{ route('admin.mail.edit', ['mail' => 1] )}}"  class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          {{-- <tr>
                            <td>定期注文生成完了メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>発送完了メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="{{ route('admin.mail.edit', ['mail' => 3] )}}"  class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          <tr>
                            <td>アカウント本登録メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="{{ route('admin.mail.edit', ['mail' => 4] )}}"  class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          <tr>
                            <td>アカウント変更メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="{{ route('admin.mail.edit', ['mail' => 5] )}}"  class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          <tr>
                            <td>退会完了メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>パスワード再発行メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="#" class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          <tr>
                            <td>マイアカウント注文キャンセルメール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>マイアカウントお届け日・定期頻度変更メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>マイアカウントお届け先変更メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>マイアカウントお支払方法変更メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>マイアカウントお支払方法ポイント変更メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>マイアカウントクレジットカード登録・変更メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr> --}}
                          <tr>
                            <td>問合せ完了</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="{{ route('admin.mail.edit', ['mail' => 14] )}}"  class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          <tr>
                            <td>パスワード再発行メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <a href="{{ route('admin.mail.edit', ['mail' => 7] )}}"  class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</a>
                            </td>
                          </tr>
                          {{-- <tr>
                            <td>納品書表示</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>コンビニ決済受付完了メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>コンビニ決済入金完了メール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr>
                          <tr>
                            <td>コンビニ決済キャンセルメール</td>
                            <td>
                              <select class="form-control">
                                <option>使用する</option>
                                <option>使用しない</option>
                              </select>
                            </td>
                            <td></td>                            
                            <td>
                              <button class="icon-btn"><i class="la la-pencil mr-2"></i> テンプレート</button>
                            </td>
                          </tr> --}}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
  </div>

  @include('Admin.layouts.commonjs')

  <!-- Enable email send form -->
  <script>
      $('.btn-edit-enable').click(function(){
        $('.enable-form-control').prop('readonly', false);
        $(".send-btn-active").show();
      });
    
    function showEditButton(){
        $("#topEditButton").css("display","initial");
    }
    function hideEditButton(){
        $("#editButton").css("display","none");
        $("#topEditButton").css("display","none");
    }
  </script>

  @if(isset($err_fields['mail1']) || isset($err_fields['mail2']) || isset($err_fields['mail3']))
    <script type="text/javascript">
      let form = document.getElementById('mailSetupForm');
      if(document.getElementById("mailSetupForm").elements["mail1"] && document.getElementById("mailSetupForm").elements["mail1"].classList.contains('form-error')) document.getElementById("mailSetupForm").elements["mail1"].focus();
      else if(document.getElementById("mailSetupForm").elements["mail2"] && document.getElementById("mailSetupForm").elements["mail2"].classList.contains('form-error')) document.getElementById("mailSetupForm").elements["mail2"].focus();
      else if(document.getElementById("mailSetupForm").elements["mail3"] && document.getElementById("mailSetupForm").elements["mail3"].classList.contains('form-error')) document.getElementById("mailSetupForm").elements["mail3"].focus();
    </script>
  @endif


</body>
</html>
