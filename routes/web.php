<?php

//auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home'); 


Route::get('/', 'UserPagesController@getIndex');
Route::get('index', 'UserPagesController@getIndex');

Route::get('/food-menu', 'UserPagesController@getFoodMenu');
Route::post('/add-food-type', 'UserPagesController@store_food_type');

//gallery
Route::get('/gallery', 'UserPagesController@gallery');

//food
Route::resource('food', 'FoodController');
Route::get('/admin/food/details/{id}', 'FoodController@getFoodDetails');

//ingridient
Route::resource('ingridient', 'IngridientController');
Route::post('/ingridient/update', 'IngridientController@update');
Route::get('/all_ingridient', 'IngridientController@allIngridient');
Route::post('/admin/ingridient_log', 'IngridientController@ingridientLog');
Route::post('/admin/add_ingridient_stock', 'IngridientController@addIngridientStock');
Route::post('/admin/remove_ingridient_stock', 'IngridientController@removeIngridientStock');


//kot
Route::get('/kot', 'KotController@index');
Route::get('/kot/dinning-orders', 'KotController@getDinningOrder');
Route::get('/kot/takeAway-orders', 'KotController@getTakeAwayOrder');
Route::post('/kot/update-cook-and-serve-status', 'KotController@updateCookAndServeStatus');
Route::get('kot/invoice/order/{id}', 'KotController@invoice');


// admin
Route::get('/admin', 'UserPagesController@getAdminIdex');
Route::get('/admin/foods', 'UserPagesController@getAllFoods');
Route::post('/admin/checkout/table/{id}', 'UserPagesController@checkout');
Route::get('/admin/invoice/order/{id}', 'UserPagesController@invoice');
Route::get('/food/chnage-visible-status/{id}', 'UserPagesController@changeFoodVisibleStatus');

//report
Route::get('/report', 'ReportController@dashboard');

Route::post('/admin/table', 'UserPagesController@storeTable');
Route::post('/admin/order-details', 'UserPagesController@order_details');
Route::post('/admin/table-orders', 'UserPagesController@get_table_order');

//take away
Route::get('/take-away', 'UserPagesController@take_away');


//commnet
Route::post('/comment', 'UserPagesController@storeComment');


//cart
Route::resource('/cart', 'CartController');
Route::post('/cart/add', 'CartController@store');
Route::post('/cart/remove', 'CartController@removeFromCart');
Route::post('/cart/item/qtyplus', 'CartController@qtyPlus');
Route::post('/cart/item/qtyminus', 'CartController@qtyMinus');
Route::post('/cart/confirm-order', 'CartController@confirmOrder');

//order
Route::get('/order-history', 'OrderController@userOrderList');
Route::post('/cancel-order-item', 'OrderController@cancelOrderItemFromOrder');
Route::get('/cancel-order-item', 'OrderController@cancelOrderItemFromOrder');


//start tab route section
Route::get('/tab/{tblId}', 'TabController@getIndex');
Route::get('/tab/food/{id}', 'TabController@foodDetails');
Route::get('/tab/dining/cart', 'TabController@cart');
Route::get('/tab/order/{tblId}', 'TabController@order');
Route::post('tab/order/item/cancel', 'TabController@cancelOrderItem');
Route::post('tab/cart/confirm-order', 'TabController@confirmOrder');
Route::post('/tab/cart/add-item', 'TabController@addToCart');
Route::post('/tab/cart/remove-item', 'TabController@removeFromCart');
Route::post('/tab/cart/add-qty', 'TabController@incrementQty');
Route::post('/tab/cart/remove-qty', 'TabController@decrementQty');
Route::get('/tab/checkout', 'TabController@checkout');
Route::post('/tab/checkout-with-ratting', 'TabController@checkoutWithRating');


//end tab route section






//test
Route::get('/tests', function(){

	
	return view('test');
});

