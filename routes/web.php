<?php

Route::get('/', function () {
    return view('welcome');
});

/* User Routes */

Route::prefix('user')->name('user.')->group(function (){

    /* User Profile*/
    Route::get('profile/{id}','UserController@profile')->name('profile');

    /* User Dashboard */
    Route::get('dashboard','UserController@dashboard')->name('dashboard');

    /* User Comments*/
    Route::get('comments','UserController@comments')->name('comments');


});

/* Dealer Routes */

Route::prefix('dealer')->name('dealer.')->group(function (){
    /* Dealer Dashboard */
    Route::get('dashboard','DealerController@dashboard')->name('dashboard');

    /* Dealer Comments*/
    Route::get('comments','DealerController@comments')->name('comments');

    /* Dealer Products*/
    Route::get('products','DealerController@products')->name('products');
    Route::get('createProduct','DealerController@createProduct')->name('createProduct');
    Route::post('storeProduct','DealerController@storeProduct')->name('storeProduct');

});

/* Admin Routes */

Route::prefix('admin')->name('admin.')->group(function (){
    /* Admin Dashboard */
    Route::get('dashboard','AdminController@dashboard')->name('dashboard');

    /* Admin Categories*/
    Route::get('categories','AdminController@categories')->name('categories');
    Route::get('createCategory','AdminController@createCategory')->name('createCategory');
    Route::post('storeCategory','AdminController@storeCategory')->name('storeCategory');
    Route::get('category/{id}/edit','AdminController@editCategory')->name('editCategory');
    Route::post('category/{id}/update','AdminController@updateCategory')->name('updateCategory');
    Route::delete('category/destroy','AdminController@destroyCategory')->name('destroyCategory');

    /* Admin Products*/
    Route::get('products','AdminController@products')->name('products');
    Route::get('createProduct','AdminController@createProduct')->name('createProduct');
    Route::post('storeProduct','AdminController@storeProduct')->name('storeProduct');
    Route::get('product/{id}/edit','AdminController@editProduct')->name('editProduct');
    Route::post('product/{id}/update','AdminController@updateProduct')->name('updateProduct');
    Route::delete('product/destroy','AdminController@destroyProduct')->name('destroyProduct');

    /* Admin Stores*/
    Route::get('stores','AdminController@stores')->name('stores');
    Route::get('createStore','AdminController@createStore')->name('createStore');
    Route::post('storeStore','AdminController@storeStore')->name('storeStore');
    Route::get('store/{id}/edit','AdminController@editStore')->name('editStore');
    Route::post('store/{id}/update','AdminController@updateStore')->name('updateStore');
    Route::delete('store/destroy','AdminController@destroyStore')->name('destroyStore');

    /* Admin Suppliers*/
    Route::get('suppliers','AdminController@suppliers')->name('suppliers');
    Route::get('createSupplier','AdminController@createSupplier')->name('createSupplier');
    Route::post('storeSupplier','AdminController@storeSupplier')->name('storeSupplier');
    Route::get('supplier/{id}/edit','AdminController@editSupplier')->name('editSupplier');
    Route::post('supplier/{id}/update','AdminController@updateSupplier')->name('updateSupplier');
    Route::delete('supplier/destroy','AdminController@destroySupplier')->name('destroySupplier');

    /* Admin Clients*/
    Route::get('clients','AdminController@clients')->name('clients');
    Route::get('createClient','AdminController@createClient')->name('createClient');
    Route::post('storeClient','AdminController@storeClient')->name('storeClient');
    Route::get('client/{id}/edit','AdminController@editClient')->name('editClient');
    Route::post('client/{id}/update','AdminController@updateClient')->name('updateClient');
    Route::delete('client/destroy','AdminController@destroyClient')->name('destroyClient');

    /* Admin Users*/
    Route::get('users','AdminController@users')->name('users');
    Route::get('createUser','AdminController@createUser')->name('createUser');
    Route::post('storeUser','AdminController@storeUser')->name('storeUser');
    Route::get('user/{id}/edit','AdminController@editUser')->name('editUser');
    Route::post('user/{id}/update','AdminController@updateUser')->name('updateUser');
    Route::delete('user/destroy','AdminController@destroyUser')->name('destroyUser');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
