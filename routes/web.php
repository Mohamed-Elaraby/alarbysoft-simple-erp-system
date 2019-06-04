<?php

Route::get('/', function () {
    return view('welcome');
});

/* User Routes */

//Route::prefix('user')->name('user.')->group(function (){
//
//    /* User Profile*/
//    Route::get('profile/{id}','UserController@profile')->name('profile');
//
//    /* User Dashboard */
//    Route::get('dashboard','UserController@dashboard')->name('dashboard');
//
//    /* User Comments*/
//    Route::get('comments','UserController@comments')->name('comments');
//
//
//});

/* Dealer Routes */

//Route::prefix('dealer')->name('dealer.')->group(function (){
//    /* Dealer Dashboard */
//    Route::get('dashboard','DealerController@dashboard')->name('dashboard');
//
//    /* Dealer Comments*/
//    Route::get('comments','DealerController@comments')->name('comments');
//
//    /* Dealer Products*/
//    Route::get('products','DealerController@products')->name('products');
//    Route::get('createProduct','DealerController@createProduct')->name('createProduct');
//    Route::post('storeProduct','DealerController@storeProduct')->name('storeProduct');
//
//});

    /* Admin Routes */
    Route::prefix('admin')->middleware(['auth', 'CheckRole:admin'])->namespace('Admin')->name('admin.')->group(function (){

        /* Dashboard Routes */
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        /* Products Routes */
        Route::resource('products', 'ProductController')->except(['destroy']);
        Route::delete('products/destroy', 'ProductController@destroy')->name('products.destroy');

        /* Categories Routes */
        Route::resource('categories', 'CategoryController')->except(['destroy']);
        Route::delete('categories/destroy', 'CategoryController@destroy')->name('categories.destroy');

        /* Stores Routes */
        Route::resource('stores', 'StoreController')->except(['destroy']);
        Route::delete('stores/destroy', 'StoreController@destroy')->name('stores.destroy');

        /* Suppliers Routes */
        Route::resource('suppliers', 'SupplierController')->except(['destroy']);
        Route::delete('suppliers/destroy', 'SupplierController@destroy')->name('suppliers.destroy');

        /* Clients Routes */
        Route::resource('clients', 'ClientController')->except(['destroy']);
        Route::delete('clients/destroy', 'ClientController@destroy')->name('clients.destroy');

        /* Purchases Routes */
        Route::resource('purchases', 'PurchaseOrderController')->except(['destroy']);
        Route::delete('purchases/destroy', 'PurchaseOrderController@destroy')->name('purchases.destroy');

        /* Sales Routes */
        Route::resource('sales', 'SaleOrderController')->except(['destroy']);
        Route::delete('sales/destroy', 'SaleOrderController@destroy')->name('sales.destroy');

        /* Expenses Routes */
        Route::resource('expenses', 'ExpensesController')->except(['destroy']);
        Route::delete('expenses/destroy', 'ExpensesController@destroy')->name('expenses.destroy');

        /* Expenses Types Routes */
        Route::resource('expensesTypes', 'ExpensesTypeController')->except(['destroy']);
        Route::delete('expensesTypes/destroy', 'ExpensesTypeController@destroy')->name('expensesTypes.destroy');

    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
