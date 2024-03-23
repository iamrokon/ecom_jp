@include('Admin.layouts.header')
<style>
  @media (max-width: 1024px){
    .offset-lg-2 {
        margin-left: 0;
    }
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

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-header">
              メール設定
            </div>
            <div class="card-body">
              <div class="custom-tab-block">
                <ul class="nav nav-pills custom-tab">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">メール内容変更</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                      <div class="col-lg-6">
                        @if (session('status'))
                          <div id="success_list" class="alert alert-success">
                            {{ session('status') }}
                          </div>
                        @endif
                        <form id="mainForm" method="POST" action="{{ route('admin.mail.update', ['mail' => $mail_id ] )}}">
                          @csrf
                          @method('PATCH')
                          <div class="form-group">
                            <p>{{ $mail_array[$mail_id] }}</p>
                          </div>
                          <div class="form-group">
                            <div class="mb-10">
                              <label>件名</label>
                              <button type="button" onclick="resetField('subject',0)" class="btn btn--primary box--shadow1 float-right">リセット</button>
                            </div>
                            <input type="text" name="subject" class="form-control" value="{{ $mail_data[0] }}">
                          </div>

                          <div class="form-group">
                            <div class="mb-10">
                              <label>ヘッダー</label>
                              <button type="button" onclick="resetField('header',1)" class="btn btn--primary box--shadow1 float-right">リセット</button>
                            </div>
                            <textarea id="ckeditor1" name="header" class="mt-10">{{ $mail_data[1] }}</textarea>
                          </div>

                          <div class="form-group">
                            <label>固定文章</label>
                            <textarea name="fixed_text" class="form-control" rows="5" readonly="readonly">{{ $mail_data[2] }}</textarea>
                          </div>

                          <div class="form-group">
                            <div class="mb-10">
                              <label>フッター</label>
                              <button type="button" onclick="resetField('footer',3)"  class="btn btn--primary box--shadow1 float-right">リセット</button>
                            </div>
                            <textarea id="ckeditor2" name="footer">{{ $mail_data[3] }}</textarea>
                          </div>

                          <div class="mt-4">
                            <a href="#" onclick="goBack()" class="btn btn--danger mb-xl-0 mb-2 box--shadow1"><i class="las la-times-circle"></i> キャンセル</a>
                            <a href="{{url('/mail/testMail')}}/{{$mail_id}}" type="button" class="btn btn--primary mb-xl-0 mb-2 box--shadow1">テストメール</a>
                            <button type="button" onclick="document.getElementById('mainForm').submit()" class="btn btn--primary mb-xl-0 mb-2 box--shadow1"><i class="la la-pencil mr-2"></i> 更新</button>
                          </div>
                        </form>
                      </div>

                      <div class="col-lg-5 col-md-6 offset-lg-1">
                        <div class="table-responsive">
                          <table class="table table--light style--two">
                            <thead>
                              <tr>
                                <th colspan="2">メールの編集について</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="2" style="border: 0;">
                                  ヘッダーとフッターの編集が可能です。<br>
                                  以下の項目はシステムからの自動表示です。<br>
                                  この表記は必ず維持してください。
                                </td>
                              </tr>
                              <tr>
                                  <td>氏名</td>
                                  <td style="text-align:left">
                                    @{{username}}
                                  </td>
                              </tr>
                              <tr>
                                  <td>TEL</td>
                                  <td style="text-align:left">
                                    @{{shop_phone}}
                                  </td>
                              </tr>
                              <tr>
                                  <td>ショップ名</td>
                                  <td style="text-align:left">
                                    @{{shop_title}}
                                  </td>
                              </tr>
                              <tr>
                                  <td>サイトURL</td>
                                  <td style="text-align:left">
                                    @{{site_url}}
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
            </div>
          </div>
        </div>
      </div>

      </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
  </div>


  @include('Admin.layouts.commonjs')

  <form method="get" action='{{route('admin.mail.index')}}' id='goBackForm'>
      <input name="pageType" value="back" type="hidden" />
  </form>

<script type="text/javascript">
    //ckEditor v4........
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
    
    function goBack(){
      $("#goBackForm").submit();  
    }
</script>
<script type="text/javascript">
  function resetField(mailField, arrayField)
  {
    let resetArray = @json($reset_mail_data);
    if(arrayField == 0) document.getElementsByName(mailField)[0].value = resetArray[arrayField];
    else if(arrayField == 1) CKEDITOR.instances['ckeditor1'].setData(resetArray[arrayField]);
    else if(arrayField == 3) CKEDITOR.instances['ckeditor2'].setData(resetArray[arrayField]);
  }
</script>
</body>
</html>
