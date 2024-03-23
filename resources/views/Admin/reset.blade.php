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
                <h4 class="logo-text mb-15">パスワード再発行</h4>
                <form action="{{ route('admin.login') }}" method="POST" class="cmn-form mt-30">
                    <div class="form-group">
                        <label for="">新しいパスワード</label>
                        <input type="password" name="" class="form-control b-radius--capsule" placeholder="">
                        <i class="las la-lock input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="">もう一度パスワードを入力してください</label>
                        <input type="password" name="" class="form-control b-radius--capsule" placeholder="">
                        <i class="las la-lock input-icon"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">
                            保存 <i class="las la-sign-in-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- login-area end -->
    </div>



    <!-- jQuery library -->
    <script src="{{asset('assets/admin/js/vendor/jquery-3.5.1.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('assets/admin/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <!-- main js -->
    <script src="{{asset('assets/admin/js/app.js')}}"></script>



</body>
</html>
