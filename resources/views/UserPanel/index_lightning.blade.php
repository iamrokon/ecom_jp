
<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
	<link rel="shortcut icon" href="{{ asset('LightningBolt/images/favicon.png') }}">
	<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<!-- <link rel="alternate" hreflang="en" href="https://en.fontworks.co.jp/fontsearch/tsukuaoldminpr6-r/">
	<link rel="alternate" hreflang="ja" href="https://fontworks.co.jp/fontsearch/tsukuaoldminpr6-r/"> -->
	<link href="{{ asset('LightningBolt/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/bootstrap-icons.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/owl.carousel.min.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/owl.theme.default.min.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/subtle-slideshow.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/stellarnav.min.css') }}" rel="stylesheet">
	<link href="{{ asset('LightningBolt/css/main.css') }}" rel="stylesheet">
    <title>LightningBolt</title>
  </head>
  	<body>
  		<form method="get" id="commonProductListForm" action="{{route('productList')}}">
            <input type="hidden" name="cat[]" id="c_product_cat" value=""/>
            <input type="hidden" name="sub_cat[]" id="c_product_sub_cat" value=""/>
            <input type="hidden" name="pagi" id="c_product_pagi" value="50"/>
        </form>
		
		<div class="customburn-effect">
			<div id="slides" style="height:500px;">
			  <a class="slide" href="#">
				<span class="animate in" style="background-image: url({{ asset('LightningBolt/images/LB_bn01.jpg') }})"></span>
				<!-- <div class="static-content"><h1>Kenburn-1</h1></div> -->
			  </a>
			  <a class="slide" href="#">
				<span class="animate out" style="background-image: url({{ asset('LightningBolt/images/LB_bn02.jpg') }})"></span>
				<!-- <div class="static-content"><h1>Kenburn-2</h1></div> -->
			  </a>
			  <a class="slide" href="#">
				<span class="animate in" style="background-image: url({{ asset('LightningBolt/images/LB_bn03.jpg') }})"></span>
				<!-- <div class="static-content"><h1>Kenburn-3</h1></div> -->
			  </a>
			   <a class="slide" href="#">
				<span class="animate out" style="background-image: url({{ asset('LightningBolt/images/LB_bn04.jpg') }})"></span>
				<!-- <div class="static-content"><h1>Kenburn-4</h1></div> -->
			  </a>
			</div>
		</div>
		<div class="custom-menu">
			<div id="h3-main-nav" class="h3-navigation-area">
				<nav class="container contianer-res position-relative">
				  <div class="row">
					<div class="col-lg-12">
						  <div class="logo">
							<a href="#">
								<div class="d-flex parent-header-logo">
									<div class="logo">
										<span><img src="{{ asset('LightningBolt/images/logo.png') }}" alt=""></span>
									</div>
									<div class="logo-text">
										<span>SURFBOARD <br>
											ONLINESHOP</span>
									</div>
								</div>
							</a>
						  </div>
						  <div class="main-nav-area">
							<div class="stellarnav">
								<div class="close-toggle d-none">
									<i class="bi bi-x-lg close-menu"></i>
								</div>
								<ul>
									<li>
									<a href="{{ route('homepage') }}">LIGHTNINGBOLT</a>
									</li>
									<li><a href="{{ route('productList') }}">PRODUCT</a></li>
									<li><a href="{{ route('contact') }}">CONTACT US</a></li>
									<li><a href="{{ route('cartItemList')}} ">CART</a></li>

									@if(Session::has('userlogin'))
                  <li>
                      <a href="{{route('user')}}">MY PAGE</a>
                  </li>
                  @endif 

									@if(Session::has('userlogin'))
										<li><a href="{{ route('logoutUser') }}">LOGOUT</a></li>
									@else
										<li><a href="{{ route('loadAuthenticationPage') }}">LOGIN</a></li>
									@endif
									<li>
										<a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
									</li>
									<li>
										<a class="facebook" href="#"><i class="fab fa-facebook-square"></i></a>
									</li>
								</ul>
							</div>
						  </div>
					</div>
				  </div>
				</nav>
			</div>
		</div>
		<section class="position-relative">
			
			<div class="product-section">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-head">
								<h2 class="section-title text-center">Product</h2>
							</div>
						</div>
					</div>

					<div class="row">
						@if(isset($categories[0]))
						<div class="col-md-3 col-sm-6">
							<div onclick='categoryWiseProductFilter($(this),"{{  $categories[0]->zokusei }}")'>
								<div class="product-info">
									<h4 class="h4-title text-white">{{  $categories[0]->zokusei }}</h4>
									<img src="{{ asset('LightningBolt/images/AQN_0097.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						@endif
						@if(isset($categories[1]))
						<div class="col-md-3 col-sm-6">
							<div onclick='categoryWiseProductFilter($(this),"{{ $categories[1]->zokusei }}")'>
								<div class="product-info">
									<h4 class="h4-title text-white">{{ $categories[1]->zokusei }}</h4>
									<img src="{{ asset('LightningBolt/images/AQN_0104.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						@endif
						@if(isset($categories[2]))
						<div class="col-md-3 col-sm-6">
							<div onclick='categoryWiseProductFilter($(this),"{{ $categories[2]->zokusei }}")'>
								<div class="product-info">
									<h4 class="h4-title text-white">{{ $categories[2]->zokusei }}</h4>
									<img src="{{ asset('LightningBolt/images/AQN_0119.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						@endif
						@if(isset($categories[3]))
						<div class="col-md-3 col-sm-6">
							<div onclick='categoryWiseProductFilter($(this),"{{ $categories[3]->zokusei }}")'>
								<div class="product-info">
									<h4 class="h4-title text-white">{{ $categories[3]->zokusei }}</h4>
									<img src="{{ asset('LightningBolt/images/AQN_0125.jpg') }}" alt="" class="img-fluid">
								</div>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</section>

		<section class="product-slider-section">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="section-head">
							<h2 class="section-title text-center">Recommend</h2>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="product-slider owl-carousel owl-theme ">
							@foreach($recommended_products as $recommended_product)
								<div class="item">
									<a href="{{ route('productDetails', ['product_id' => $recommended_product->bango, 'product_name' => $recommended_product->jouhou]) }}">
										<img src="{{ route('homepage').'/storage/product/images/'.$recommended_product->url }}" alt="" class="img-fluid">
										<div class="pro-details text-center">
											<h4 class="h4-title link-light">{{ $recommended_product->jouhou }}</h4>
											<h5 class="h5-title link-light">{{ $recommended_product->mdjouhou }}</h5>
											<span class="link-light">¥{{ number_format($recommended_product->data23) }}</span>
										</div>
									</a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="footer-section">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer-top text-center">
							<p>Lightingbolt Surfboard 2021 M CO.,LTD</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="footer-menu text-center mt-1">
							<ul>
								<li><a href="#">特定商取引法に基づく表示</a></li>
								<li><a href="{{ route('fPrivacyPolicy') }}">プライバシーポリシー</a></li>
								<li><a href="#">返金について</a></li>
								<li><a href="{{ route('companyProfileOne') }}">配送について</a></li>
								<li><a href="{{ route('termsService') }}">ご利用規約</a></li>
							</ul>
						</div>
						<div class="copyright text-center">
							<p>Copyright &copy; Colgis BD Ltd. All rights reserved.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	<!-- <a href="#"><div class="scroll-to-top"><i class="fas fa-angle-up"></i></div></a> -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="{{ asset('LightningBolt/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('LightningBolt/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('LightningBolt/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('LightningBolt/js/plugins/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('LightningBolt/js/stellarnav.min.js') }}"></script>
  <script src="{{ asset('LightningBolt/js/jquery.subtle-slideshow.js') }}"></script>
	<script src="{{ asset('LightningBolt/js/main.js') }}"></script>
	<script src="{{ asset('UserPanel/js/custom.js') }}"></script>

  </body>
</html>