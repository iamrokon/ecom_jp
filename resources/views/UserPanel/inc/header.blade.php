<!DOCTYPE html>
<html class="no-js" lang="ja">

<head>
    <meta charset="utf-8">
    <title>{{\DB::table('kokyaku1')->where('bango',env('store'))->first()->name??""}}</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <!-- <link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/UserPanel/imgs/brand/logo_camper_900x.png')}}"> -->
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('UserPanel/css/vendors/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserPanel/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('UserPanel/css/plugins/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserPanel/css/plugins/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('UserPanel/css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!--leaflet map-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <link rel="stylesheet" href="{{asset('UserPanel/css/custom.css')}}">
    
    
</head>
<script>
    var base_url = "{{url('/')}}";
</script>

<body>
    
        <!-- category wise product filter from menu -->
        <form method="get" id="commonProductListForm" action="{{route('productList')}}">
            <input type="hidden" name="cat[]" id="c_product_cat" value=""/>
            <input type="hidden" name="sub_cat[]" id="c_product_sub_cat" value=""/>
            <!--<input type="hidden" name="brand" id="c_product_brand" value=""/>
            <input type="hidden" name="type" id="c_product_type" value=""/>
            <input type="hidden" name="price" id="c_product_price" value=""/>
            <input type="hidden" name="off" id="c_product_off" value=""/>-->
            <input type="hidden" name="pagi" id="c_product_pagi" value="50"/>
        </form>