<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta tags and other links -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logoIcon/favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/bootstrap.min.css') }}">

    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/all.min.css')}}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/line-awesome.min.css')}}">



    <!-- custom select box css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/nice-select.css')}}">
    <!-- select 2 css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/select2.min.css')}}">
    <!-- data table css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/datatables.min.css')}}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/vendor/datepicker.min.css')}}">
    <!-- bootstrap-clockpicker css -->

    <!-- Magnipic Popup-->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/magnific-popup.css') }}">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/custom.css')}}">

</head>
<body>
    <div class="page-wrapper default-version">
        <div class="form-area bg_img" data-background="{{asset('assets/admin/images/1.jpg')}}">
            <div class="form-wrapper">
                {{-- <div id="error_list" class="alert alert-danger">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div> --}}
                <h4 class="logo-text mb-15">@lang("管理者 ログイン")</h4>
                <form action="{{ route('admin.login') }}" method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group">
                        <label for="email">@lang('ユーザーID')</label>
                        <input type="text" name="username" class="form-control b-radius--capsule" id="username" value="{{ old('username') }}"
                        placeholder="@lang('ユーザーID')">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="pass">@lang('パスワード')</label>
                        <input type="password" name="password" class="form-control b-radius--capsule" id="pass" placeholder="@lang('パスワード')">
                        <i class="las la-lock input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">
                            @lang('ログイン') <i class="las la-sign-in-alt"></i>
                        </button>
                    </div>
                </form>

                <!-- <div class="text-right">
                    <a href="">パスワードを忘れた方はこちら</a>
                </div> -->
            </div>
        </div><!-- login-area end -->
    </div>



    <!-- jQuery library -->
    <script src="{{asset('assets/admin/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('assets/admin/js/vendor/bootstrap.bundle.min.js')}}"></script>

    <!-- slimscroll js for custom scrollbar -->
    <script src="{{asset('assets/admin/js/vendor/jquery.slimscroll.min.js')}}"></script>
    <!-- custom select box js -->
    <script src="{{asset('assets/admin/js/vendor/jquery.nice-select.min.js')}}"></script>


    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>

    @if(session()->has('notify'))
    @foreach(session('notify') as $msg)
    <script>
        "use strict";
        iziToast.{{ $msg[0] }}({message:"{{ trans($msg[1]) }}", position: "topRight"});
    </script>
    @endforeach
    @endif

    @if ($errors->any())
    <script>
       "use strict";
       @foreach ($errors->all() as $error)
       iziToast.error({
        message: '@lang($error)',
        position: "topRight"
    });
       @endforeach
   </script>

   @endif
   <script>
    "use strict";
    function notify(status, message) {
        if(typeof message == 'string'){
            iziToast[status]({
                message: message,
                position: "topRight"
            });
        }else{
            $.each(message, function(i, val) {
                iziToast[status]({
                    message: val,
                    position: "topRight"
                });
            });
        }

    }

    function notifyOne(status, message) {
       iziToast[status]({
           message: message,
           position: "topRight"
       });
   }
</script>


<script src="{{ asset('assets/admin/js/nicEdit.js') }}"></script>

<!-- code preview js -->
<!-- seldct 2 js -->
<script src="{{asset('assets/admin/js/vendor/select2.min.js')}}"></script>
<!-- data-table js -->
<script src="{{asset('assets/admin/js/vendor/datatables.min.js')}}"></script>
<!-- Magnigfic js -->
<script src="{{ asset('assets/admin/js/jquery.magnific-popup.min.js') }}"></script>
<!-- main js -->
<script src="{{asset('assets/admin/js/app.js')}}"></script>

{{-- LOAD NIC EDIT --}}
<script>
    (function($){
        "use strict";
        bkLib.onDomLoaded(function() {
            $( ".nicEdit" ).each(function( index ) {
                $(this).attr("id","nicEditor"+index);
                new nicEditor({fullPanel : true}).panelInstance('nicEditor'+index,{hasPanel : true});
            });
        });
    })(jQuery);
</script>




</body>
</html>
