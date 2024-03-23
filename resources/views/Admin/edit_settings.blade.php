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
              <a href="#" class="icon-btn float-right"><i class="la la-pencil mr-2"></i> 編集</a>
            </div>
            <div class="card-body">
              <div class="custom-tab-block">
                <ul class="nav nav-pills custom-tab">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">メールリスト</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                      <div class="col-md-6">
                        <form>
                          <div class="form-group">
                            <input type="text" name="" class="form-control" placeholder="Order Mail" readonly="">
                          </div>
                          <div class="form-group">
                            <label>件名</label>
                            <input type="text" name="" class="form-control">
                          </div>

                          <div class="form-group">
                            <label>ヘッダー</label>
                            <textarea id="ckeditor1" name=""></textarea>
                          </div>

                          <div class="form-group">
                            <label>固定文章</label>
                            <textarea name="" class="form-control" rows="5"></textarea>
                          </div>

                          <div class="form-group">
                            <label>フッター</label>
                            <textarea id="ckeditor2" name=""></textarea>
                          </div>

                          <div class="mt-4">
                            <button type="button" class="btn btn--primary mb-xl-0 mb-2 box--shadow1">編集</button>
                            <button type="button" class="btn btn--primary mb-xl-0 mb-2 box--shadow1">更新</button>
                          </div>
                        </form>
                      </div>

                      <div class="col-md-4 ml-auto">
                        <table class="table table--light style--two">
                          <thead>
                            <tr>
                              <th colspan="2" class="text-center">タグ一覧</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>氏</td>
                              <td>@@last_name @@</td>
                            </tr>
                            <tr>
                              <td>名</td>
                              <td>@@ first_name@@</td>
                            </tr>
                            <tr>
                              <td>ショップ名</td>
                              <td>@@ shop_name @@</td>
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

      </div><!-- bodywrapper__inner end -->
    </div><!-- body-wrapper end -->
  </div>

  @include('Admin.layouts.commonjs')


<script type="text/javascript">
    //ckEditor v4........
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
</script>
</body>
</html>
