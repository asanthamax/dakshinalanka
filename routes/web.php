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

Route::get('/', 'AuthenticateController@show');




Auth::routes();

Route::group(['middleware' => ['login']],function(){

    Route::get('/home', 'HomeController@index');

    Route::get('/registeruser','AddUserController@index');

    Route::get('/logout','AuthenticateController@logoutuser');

    Route::get('/customers','CustomerController@index');

    Route::get('/addcustomers','CustomerController@add_user');

    Route::get('/addstock', 'StockController@addStock');

    Route::get('/stocks', 'StockController@index');

    Route::get('/jobs','JobsController@index');

    Route::get('/newjob','JobsController@addJob');

    Route::post('/savejob','JobsController@savejob');

    Route::get('/editjob/{jobID}','JobsController@edit_job');

    Route::get('/viewjob/{jobID}','JobsController@view_job');

    Route::get('/removejob/{jobID}','JobsController@remove_job');

    Route::post('/updatejob','JobsController@updatejob');

    Route::post('/deletejob','JobsController@deletejob');

    Route::get('/invoices','InvoiceController@index');

    Route::get('/invoice','InvoiceController@createInvoice');

    Route::get('/editcustomer/{customerID}','CustomerController@edit_customer');

    Route::get('/viewcustomer/{customerID}','CustomerController@view_customer');

    Route::get('/removecustomer/{customerID}','CustomerController@remove_customer');

    Route::post('/savecustomer','CustomerController@save_customer');

    Route::post('/updatecustomer','CustomerController@update_customer');

    Route::post('/deletecustomer','CustomerController@delete_customer');

    Route::get('/viewstock/{stockID}','StockController@view_stock');

    Route::get('/editstock/{stockID}','StockController@edit_stock');

    Route::get('/removestock/{stockID}','StockController@remove_stock');

    Route::post('/savestock','StockController@saveStock');

    Route::post('/updatestock','StockController@updateStock');

    Route::post('/deletestock','StockController@deleteStock');

    Route::post('/addcredit','CreditController@addCreditPayment');

    Route::post('/updatecredit','CreditController@updateCreditPayment');

    Route::post('/deletecredit','CreditController@deleteCreditPayment');

    Route::get('/savecredit','CreditController@saveCreditPayment');

    Route::get('/editcredit/{creditID}','CreditController@editCreditPayment');

    Route::get('/removecredit/{creditID}','CreditController@removeCreditPayment');

    Route::get('/viewcredit/{creditID}','CreditController@viewCreditPayment');

    Route::get('/credits','CreditController@index');

    Route::post('/getprice','InvoiceController@getPrice');

    Route::post('/gethickness','InvoiceController@getThickness');
});
