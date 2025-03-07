<?php

Route::get('/', function () {
    return view('welcome');
});
/* Ajax Requests */
Route::get('sales/product_info', 'Admin\SaleOrderController@getProductById')->name('sales.product_info');
Route::get('serials/getProducts', 'Admin\SerialController@getProductByOrderId')->name('serials.getProducts');


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

    /* Multi Authentication From Client Table Routes*/
    Route::get('client/login','Auth\LoginClientController@login')->name('client.login');
    Route::post('client/loginPost','Auth\LoginClientController@loginPost')->name('client.loginPost');

    Route::prefix('client')->middleware('AuthClient:client')->name('client.')->group(function (){
        Route::get('index','Auth\LoginClientController@index')->name('index');
    });
    /* Multi Authentication From Client Table Routes*/

    /* Admin Routes */
    Route::prefix('admin')->middleware(['auth', 'CheckRole:admin'])->namespace('Admin')->name('admin.')->group(function (){

        /* Dashboard Routes */
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        /* Products Routes */
        Route::resource('products', 'ProductController')->except(['destroy']);
        Route::delete('products/destroy', 'ProductController@destroy')->name('products.destroy');

        /* Serials Routes */
        Route::resource('serials', 'SerialController')->except(['destroy']);
        Route::delete('serials/destroy', 'SerialController@destroy')->name('serials.destroy');

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
        Route::get('purchases/order/{id}', 'PurchaseOrderController@fullOrder')->name('purchases.order');


        /* Sales Routes */
        Route::resource('sales', 'SaleOrderController')->except(['destroy']);
        Route::delete('sales/destroy', 'SaleOrderController@destroy')->name('sales.destroy');
        Route::get('sales/order/{id}', 'SaleOrderController@fullOrder')->name('sales.order');


        /* Expenses Routes */
        Route::resource('expenses', 'ExpensesController')->except(['destroy']);
        Route::delete('expenses/destroy', 'ExpensesController@destroy')->name('expenses.destroy');

        /* Expenses Types Routes */
        Route::resource('expensesTypes', 'ExpensesTypeController')->except(['destroy']);
        Route::delete('expensesTypes/destroy', 'ExpensesTypeController@destroy')->name('expensesTypes.destroy');

        /* Clients Payments Routes */
        Route::resource('clientPayments', 'ClientPaymentController')->except(['destroy']);
        Route::delete('clientPayments/destroy', 'ClientPaymentController@destroy')->name('clientPayments.destroy');

        /* Clients Collecting Routes */
        Route::resource('clientCollecting', 'ClientCollectingController')->except(['destroy']);
        Route::delete('clientCollecting/destroy', 'ClientCollectingController@destroy')->name('clientCollecting.destroy');

        /* supplierPayments Routes */
        Route::resource('supplierPayments', 'SupplierPaymentController')->except(['destroy']);
        Route::delete('supplierPayments/destroy', 'SupplierPaymentController@destroy')->name('supplierPayments.destroy');

        /* supplierPayments Routes */
        Route::resource('supplierCollecting', 'SupplierCollectingController')->except(['destroy']);
        Route::delete('supplierCollecting/destroy', 'SupplierCollectingController@destroy')->name('supplierCollecting.destroy');

        /* theSafe Routes */
        Route::get('safe', 'SafeController@index')->name('safe.index');
        Route::get('safe/operations', 'SafeController@operations')->name('safe.operations');
        Route::post('safe/store', 'SafeController@store')->name('safe.store');

        /* Equity Capital Routes */
        Route::get('equityCapital', 'EquityCapitalController@index')->name('equityCapital.index');
        Route::get('equityCapital/operations', 'EquityCapitalController@operations')->name('equityCapital.operations');
        Route::post('equityCapital/store', 'EquityCapitalController@store')->name('equityCapital.store');

        /* reports Routes */
        Route::get('reports', 'ReportsController@index')->name('reports.index');
        Route::get('reports/dayBook', 'ReportsController@dayBook')->name('reports.dayBook');
        Route::get('reports/dayBook/ajax', 'ReportsController@dayBookByAjax')->name('reports.dayBook.ajax');
        Route::get('reports/dayBook/ajax', 'ReportsController@dayBookByAjax')->name('reports.dayBook.ajax');
        Route::get('reports/reportDay', 'ReportsController@reportDay')->name('reports.reportDay');
        Route::get('reports/reportDay/ajax', 'ReportsController@reportDayAjax')->name('reports.reportDay.ajax');
        Route::get('reports/reportMonth', 'ReportsController@reportMonth')->name('reports.reportMonth');
        Route::get('reports/reportMonth/ajax', 'ReportsController@reportMonthAjax')->name('reports.reportMonth.ajax');
        Route::get('reports/reportYear', 'ReportsController@reportYear')->name('reports.reportYear');
        Route::get('reports/reportYear/ajax', 'ReportsController@reportYearAjax')->name('reports.reportYear.ajax');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
