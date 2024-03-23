<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/sstest','Admin.shipping_settings');
Route::view('/mailseting','Admin.email_settings');
Route::view('/editmailseting','Admin.edit_email_settings');
Route::view('/edit','Admin.edit_settings');
Route::view('/aResetPassword','Admin.resetPassword');
Route::view('/aReset','Admin.reset');
Route::view('/tablePage','Admin.tablePage');

//Route::view('/paymentMethod','UserPanel.paymentMethod');
Route::view('/confirmation','UserPanel.confirmation');
Route::view('/orderCompleted','UserPanel.orderCompleted');
Route::get('/completedAuthen','UserPanel\LoginController@gotosucess');


Route::view('/product','products.product');

Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'as' => 'admin.'
], function() {

	Route::group([ 'middleware' => 'admin.guest'], function() {
		Route::get('login','LoginController@show')->name('login');
		Route::post('login','LoginController@authenticate');
	});

	Route::get('logout','LoginController@logout')->name('logout');
    Route::get('from_perl','LoginController@from_perl');
	Route::group([ 'middleware' => 'admin.auth'], function() {
		// dashboard
		Route::view('/', 'Admin.dashboard')->name('dashboard');

		//brand
		Route::post('brand/restore','BrandController@restore')->name('brand.restore');
		Route::resource('brand', 'BrandController')->only(['index','store','edit','update','destroy']);

		//products
		Route::resource('products', 'ProductController')->only(['index','create','store','edit','update']);

		//category
		Route::post('category/restore','CategoryController@restore')->name('category.restore');
		Route::resource('category', 'CategoryController')->only(['index','store','show','edit','update','destroy']);

		//shipping
		Route::get('shipping','ShippingController@index')->name('shipping.index');
		Route::get('shipping/{company}','ShippingController@read_detail');
		Route::post('shipping/insert','ShippingController@insert')->name('shipping.insert');

		//shop settings
		Route::resource('shop', 'ShopController')->only(['index','edit','update']);

		//payment settings
		Route::resource('payment', 'PaymentController')->only(['index','update']);

		//customer
		Route::resource('customer', 'CustomerController')->only(['index']);

        //mail
      Route::resource('mail', 'MailController')->only(['index','edit','update','mailsetup']);

	});

});
Route::post('mail/mailsetup', 'Admin\MailController@mailsetup')->name('admin.mailsetup');
Route::get('mail/testMail/{format_id}', 'Admin\MailController@testMail')->name('admin.testMail');
Route::post('mail/sendMail', 'Admin\MailController@sendMail')->name('admin.sendMail');

Route::post('imageroute','Admin\ProductController@image')->name('image')->middleware('admin.auth');

//====================== User Panel ======================//
Route::get('/','UserPanel\HomeController@index')->name('homepage');
Route::get('/loadAuthenticationPage','UserPanel\HomeController@loadAuthenticationPage')->name('loadAuthenticationPage');
Route::get('/about','UserPanel\HomeController@loadAboutPage')->name('about');
Route::get('/companyProfile','UserPanel\HomeController@companyProfile')->name('companyProfile');
Route::get('/companyProfileOne','UserPanel\HomeController@companyProfileOne')->name('companyProfileOne');
Route::get('/contact','UserPanel\HomeController@loadContactPage')->name('contact');
Route::get('/privacyPolicy','UserPanel\HomeController@loadPrivacyPolicyPage')->name('privacyPolicy');
Route::get('/fprivacyPolicy','UserPanel\HomeController@fPrivacyPolicy')->name('fPrivacyPolicy');
Route::get('/terms','UserPanel\HomeController@loadTermsPage')->name('terms');
Route::get('/termsService','UserPanel\HomeController@termsService')->name('termsService');
Route::get('/brandList','UserPanel\HomeController@loadBrandList')->name('brandList');
Route::post('/contactMail','UserPanel\HomeController@contactMail')->name('contactMail');
Route::get('/quickAddToShopCart/{product_id}','UserPanel\ShoppingController@quickAddToShopCart')->name('quickAddToShopCart');
Route::get('/addToShopCart/{product_id}','UserPanel\ShoppingController@addToShopCart')->name('addToShopCart');
Route::post('/addToShopCart/{product_id}','UserPanel\ShoppingController@addToShopCart')->name('addToShopCart');
Route::get('/cartItemList','UserPanel\ShoppingController@cartItemList')->name('cartItemList');
Route::get('/removeCartItem/{row_id}','UserPanel\ShoppingController@removeCartItem')->name('removeCartItem');
Route::get('/clearCart','UserPanel\ShoppingController@clearCart')->name('clearCart');
Route::get('/checkout','UserPanel\ShoppingController@checkout')->name('checkout');
Route::get('/updateCartList','UserPanel\ShoppingController@updateCartList')->name('updateCartList');
Route::post('/updateCartData','UserPanel\ShoppingController@updateCartData')->name('updateCartData');
Route::get('/productDetails/{product_id}/{product_name}','UserPanel\ProductController@productDetails')->name('productDetails');
Route::get('/quickViewProduct','UserPanel\ProductController@quickViewProductDetails')->name('quickViewProduct');
Route::get('/productList','UserPanel\ProductController@productList')->name('productList');
Route::get('/search','UserPanel\ProductController@searchProduct')->name('search');
Route::post('/registerUser','UserPanel\LoginController@registerUser')->name('registerUser');
Route::post('/loginUser','UserPanel\LoginController@loginUser')->name('loginUser');
Route::get('/logoutUser','UserPanel\LoginController@logoutUser')->name('logoutUser');
Route::post('/placeOrder','UserPanel\PlaceOrderController@placeOrder')->name('placeOrder');
Route::any('/payment','UserPanel\PlaceOrderController@payment')->name('payment');
Route::any('/createOrder','UserPanel\PlaceOrderController@orderCreate')->name('createOrder');
Route::any('/paymentMethod','UserPanel\PlaceOrderController@paymentMethod')->name('paymentMethod');
Route::any('/paymentHistory','UserPanel\PlaceOrderController@paymentHistory')->name('paymentHistory');
Route::any('/orderComplete','UserPanel\PlaceOrderController@orderComplete')->name('orderComplete');
Route::any('/orderkakunin','UserPanel\PlaceOrderController@orderkakunin_fun')->name('orderkakunin');
Route::any('/orderConfirmation','UserPanel\PlaceOrderController@orderConfirmation')->name('orderConfirmation');
Route::get('/checkout_final_page','UserPanel\PlaceOrderController@checkout_final_page')->name('checkout_final_page');

Route::any('/calculateCharge','UserPanel\PlaceOrderController@calculateDeliveryAndSettlementCharge')->name('calculateCharge');
Route::get('/user','UserPanel\UserController@index')->name('user')->middleware('userLogin');
Route::get('/getSenderAddress/{id}','UserPanel\ShoppingController@getSenderAddress')->name('getSenderAddress');
Route::post('/updateUser','UserPanel\UserController@updateUser')->name('updateUser')->middleware('userLogin');
Route::post('/updateHaisouData','UserPanel\UserController@updateHaisouData')->name('updateHaisouData')->middleware('userLogin');
Route::post('/updateUserPassword','UserPanel\UserController@updateUserPassword')->name('updateUserPassword')->middleware('userLogin');
Route::get('/orderDetails/{order_no}','UserPanel\UserController@orderDetails')->name('orderDetails')->middleware('userLogin');
Route::post('/validateMemberCancellation','UserPanel\UserController@validateMemberCancellation')->name('validateMemberCancellation')->middleware('userLogin');
Route::post('/memberCancellation','UserPanel\UserController@memberCancellation')->name('memberCancellation')->middleware('userLogin');
Route::get('/checkStock/{qty}/{product_id}','UserPanel\ProductController@checkStock')->name('checkStock');
Route::any('/resetPassword','UserPanel\UserController@resetPassword')->name('resetPassword');
Route::any('/reset/{email}','UserPanel\UserController@reset')->name('reset');

Route::get('/session/clear',function(){
   
  
   dd(session()->all());
});