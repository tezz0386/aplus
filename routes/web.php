<?php
use App\Cart;
use Stripe\Stripe;
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
Auth::routes();
// Route::get('/', function () {
//     return view('pages.index');
// });
Route::get('/', [
      'uses'=>'ViewController@index',
      'as'=>'/'
]);
Route::get('shoping-cart/show-cart-section', [
      'uses'=>'ViewController@getShowCartSection',
      'as'=>'user.showCartSection'
]);

Route::group(['prefix'=>'admin'], function(){
                 Route::get('/login',[
                  'uses'=>'Auth\AdminLoginController@getLogin',
                  'as'=>'admin.login'
                  ]);
                  Route::post('/login',[
                         'uses'=>'Auth\AdminLoginController@postLogin',
                         'as'=>'admin.login'
                  ]);
                  Route::get('/',[
                        'uses'=>'AdminController@dashBoard',
                        'as'=>'dashboard'
                  ]);
                  Route::get('/dashboard',[
                        'uses'=>'AdminController@dashBoard',
                        'as'=>'dash'
                  ]);
                  Route::get('/logout',[
                        'uses'=>'Auth\AdminLogincontroller@getLogout',
                        'as'=>'admin.logout'
                  ]);
                   Route::get('/account',[
                        'uses'=>'AdminController@getAccount',
                        'as'=>'admin.account'
                  ]);
                    Route::post('/account',[
                        'uses'=>'AdminController@postAccount',
                        'as'=>'admin.account'
                  ]);
});


Route::group(['prefix'=>'admin/dashboard/parent'], function(){
	        Route::get('/list',[
              'uses'=>'ParentCategoryController@index',
              'as'=>'list'
	      	]);
	      	 Route::get('/',[
              'uses'=>'ParentCategoryController@create',
              'as'=>'addparent'
	      	]);
	      	  Route::post('/',[
              'uses'=>'ParentCategoryController@store',
              'as'=>'storeparent'
	      	]);
	      	   Route::get('/{parent}/show',[
              'uses'=>'ParentCategoryController@show',
              'as'=>'showparent'
	      	  ]);
	         
	      	   Route::patch('/{parent?}',[
              'uses'=>'ParentCategoryController@update',
              'as'=>'updateparent'
	      	   ]);
              

                // for delete but now i has could not deleted
	      	   Route::delete('/{parent}/deleted',[
                    'uses'=>'ParentCategoryController@destroy',
                     'as'=>'deleteparent'
	      	  ]);
});
Route::group(['prefix'=>'admin/dashboard/child'], function(){

                     Route::get('/list',[
                           'uses'=>'CategoryController@index',
                           'as'=>'allchild'
                     	]);
                      Route::get('/',[
                           'uses'=>'CategoryController@create',
                           'as'=>'addchild'
                     	]);
                      Route::post('/',[
                           'uses'=>'CategoryController@store',
                           'as'=>'storechild'
                     	]);
                      Route::get('/{category}/show',[
                           'uses'=>'CategoryController@show',
                           'as'=>'childshow'
                     	]);
                      Route::patch('/{category?}',[
                           'uses'=>'CategoryController@update',
                           'as'=>'updatechild'
                     	]);

                      // fo delete but now could not working
                      Route::delete('/category/deleted', [
                            'uses'=>'CategoryController@destroy',
                            'as'=>'deletechild'
                      	]);
                           
});
Route::group(['prefix'=>'admin/dashboard/product'], function(){
	       Route::get('/list',[
                     'uses'=>'ProductController@index',
                     'as'=>'allproduct'
              ]);
            Route::post('/',[
               'uses'=>'ProductController@store',
               'as'=>'storeproduct'
           	]);
           	 Route::get('/{product}/show',[
               'uses'=>'ProductController@show',
               'as'=>'showproduct'
           	]);
           	 Route::patch('/{product?}',[
               'uses'=>'ProductController@update',
               'as'=>'updateproduct'
           	]);
            
           	 // for remove but now it is not working
           	

});

Route::group(['prefix'=>'/admin/dashboard/'], function(){
            Route::get('/order',[
                 'uses'=>'OrderController@index',
                 'as'=>'admin.order'
            ]);
            Route::get('/order/{id?}',[
                  'uses'=>'OrderController@orderDetails',
                  'as'=>'admin.order.details'
             ]);
             Route::get('/order/delivery/{id?}',[
                  'uses'=>'OrderController@orderDeliver',
                  'as'=>'admin.order.deliver'
             ]);
             Route::get('/order/trash/{id?}',[
                  'uses'=>'OrderController@orderTrash',
                  'as'=>'admin.order.trash'
             ]);
             Route::get('/order/trash/now/{id?}',[
                  'uses'=>'OrderController@orderTrashNow',
                  'as'=>'admin.order.trash.now'
             ]);
             Route::get('/order/trashed/view',[
                  'uses'=>'OrderController@orderTrashView',
                  'as'=>'admin.order.trash.view'
             ]);
             Route::get('/transaction', [
                       'uses'=>'TransactionController@index',
                       'as'=>'admin.transaction'
             ]);
             Route::get('/transaction/details/{id?}', [
                  'uses'=>'TransactionController@viewDetails',
                  'as'=>'admin.transaction.view.details'
        ]);
});


Route::group(['prefix'=>'user'], function(){
      Route::get('/information/{name}/',[
                'uses'=>'viewController@viewInformation',
                'as'=>'viewInformation'
       ]);
       Route::post('/cart',[
         'uses'=>'viewController@cart',
         'as'=>'addToCart'
        ]);
        Route::get('/shoping-cart/show',[
          'uses'=>'viewController@shopingCart',
          'as'=>'shoping-cart'
        ]);
        Route::get('/shoping-cart/update',[
            'uses'=>'viewController@shopingCartUpdate',
            'as'=>'shoping-cart.update'
          ]);
        Route::get('/login',[
          'uses'=>'Auth\UserLoginController@getLogin',
          'as'=>'login'
        ]);
         Route::post('/login',[
          'uses'=>'Auth\UserLoginController@postLogin',
          'as'=>'login'
        ]);
        Route::post('/shoping-cart/login',[
            'uses'=>'Auth\UserLoginController@cartLogin',
            'as'=>'user.login'
       ]);
         Route::get('/signup',[
          'uses'=>'UserController@getSignup',
          'as'=>'signup'
        ]);
         Route::post('/signup',[
          'uses'=>'UserController@postSignup',
          'as'=>'signup'
        ]);
         Route::get('/verification/{verification?}',[
              'uses'=>'UserController@getVerification',
              'as'=>'verification',
         ]);
          Route::post('/verification',[
              'uses'=>'UserController@postVerification',
              'as'=>'postVerification',
         ]);
         Route::get('/shoping-cart/getcheckout',[
            'uses'=>'ViewController@getCheckout',
            'as'=>'checkout'  
           ]);   
         Route::get('/shoping-cart/checkout',[
               'uses'=>'CheckoutController@getCheckout',
               'as'=>'user.checkout'   
         ]);
         Route::post('/shoping-cart/checkout/cash-on-delivery',[
            'uses'=>'CheckoutController@postCheckoutCash',
            'as'=>'user.checkout.cash'  
           ]); 
           Route::post('/shoping-cart/update',[
            'uses'=>'ViewController@updateCart',
            'as'=>'user.updateCart'  
           ]); 
});
    Route::group(['prefix'=>'/user'], function(){
       Route::group(['middleware'=>'auth'], function(){
              Route::get('/profile',[
              'uses'=>'UserController@getProfile',
              'as'=>'user.profile',
               ]);
               Route::get('/profile/transaction',[
                  'uses'=>'UserController@getTransaction',
                  'as'=>'user.transaction',
                   ]);
              Route::get('/logout',[
                     'uses'=>'Auth\UserLoginController@logout',
                    'as'=>'logout',
               ]);
         });
         Route::post('/shoping-cart/checkout', [
            'uses'=>'CheckoutController@postCheckout',
            'as'=>'user.checkout'   
         ]);
    });

    
//now not working
Route::post('/',[
  'uses'=>'viewController@showCart',
  'as'=>'showCart'
]);


// for check checkout  checkout.blade.php //
Route::get('/checkout/show', 'CheckoutController@showForm')->name('show.checkout');
Route::post('/checkout', 'CheckoutController@postForm')->name('post.checkout');

