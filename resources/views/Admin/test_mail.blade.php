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
          <h6 class="page-title">テストメール</h6>
        </div>
        <div class="col-lg-6 col-sm-6 text-right">
          <!-- <button style="padding: 2px 12px;" class="icon-btn" onclick="openModel('insert')">新規登録</button> -->
        </div> 
      </div>
     
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card b-radius--10 ">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                    <!-- Success Message -->
                    @if(Session::has('success_mail'))
                    <div class="alert alert-primary alert-dismissible">
                      <!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
                      <strong>{{session()->get('success_mail')}}</strong>
                    </div>
                    @endif
                    
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <span style="display:block;color: #ff4c5e;">{{ $error }}</span>
                        @endforeach
                    @endif

                            
                    <form method="post" action="{{route('admin.sendMail')}}" id="testMailForm">
                    @csrf
                    <input name="format_id" value="{{$format_id}}" type="hidden" />
                    <div class="form-group">
                      <label>姓</label>
                      <input type="text" name="fname" id="fname" class="form-control clear-field" value=" {{ old('fname') }} ">
                    </div>
                    <div class="form-group">
                      <label>名</label>
                      <input type="text" name="lname" id="lname" class="form-control clear-field" value="{{ old('lname') }}">
                    </div>
                    <div class="form-group">
                      <label>メールアドレス</label>
                      <input type="text" name="email" id="email" class="form-control clear-field @if($errors->has('email')) form-error @endif" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                      <label>ショップ名</label>
                      <input type="text" name="company" class="form-control" value="{{$kokyaku1->name}}" readonly>
                    </div>
                    <div class="mt-4 text-right">
                      <a href="{{ route('admin.mail.edit', ['mail' => $format_id] )}}" class="btn btn--primary mb-xl-0 mb-2 box--shadow1"><i class="las la-times-circle"></i> キャンセル</a>
                      <button type="button" onclick="resetMailTest()" class="btn btn--primary mb-xl-0 mb-2 box--shadow1 reset-input"><i class="las la-times-circle"></i> リセット</button>
                      <button type="submit" class="btn btn--primary mb-xl-0 mb-2 box--shadow1"><i class="las la-save"></i> メールを送る</button>
                    </div>
                  </form>
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

<script>
  // reset input field...
  $(".reset-input").click(function() {
    $(this).closest('form').find(".clear-field").val("");
  });
  
  function resetMailTest(){
      $(".alert-primary").css("display","none");
      $("#testMailForm").reset();
  }
</script>

</body>
</html>
