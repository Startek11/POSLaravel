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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');





//CHANGE LANGUAJE
Route::get('/locale/{lang}','AppController@switchLang')->name('app.lang');

//ONLY AUTHENTICATE USERS
Route::middleware(['auth'])->group(function(){
    //LOGOUT
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    //HOME DASHBOARD
    Route::get('/home',function(){
        return view('dashboard.dashboard');
    })->name('dashboard');
    //SUPPLY ROUTES
    Route::get('/supplies','SupplyController@index')->name('supply.index');
    Route::get('/supply/{id}','SupplyController@show')->name('supply.show');
    Route::get('/supplyCreate','SupplyController@create')->name('supply.create');
    Route::post('/supply/new','SupplyController@store')->name('supply.store');
    Route::get('/supply/edit/{id}','SupplyController@edit')->name('supply.edit');
    Route::put('/supply/{id}','SupplyController@update')->name('supply.update');
    Route::delete('/supply/{id}','SupplyController@delete')->name('supply.delete');
    Route::get('supplies/search','SupplyController@instaSearch')->name('supply.search');

    //CLIENT ROUTES
    Route::get('/clients','ClientController@index')->name('client.index');
    Route::get('/client/{id}','ClientController@show')->name('client.show');
    Route::get('/clientCreate','ClientController@create')->name('client.create');
    Route::post('/client/new','ClientController@store')->name('client.store');
    Route::get('/client/edit/{id}','ClientController@edit')->name('client.edit');
    Route::put('/client/{id}','ClientController@update')->name('client.update');
    Route::delete('/client/{id}','ClientController@delete')->name('client.delete');
    Route::get('clients/search','ClientController@instaSearch')->name('client.search');

    //PROVIDER ROUTES
    Route::get('/providers','ProviderController@index')->name('provider.index');
    Route::get('/provider/{id}','ProviderController@show')->name('provider.show');
    Route::get('/providerCreate','ProviderController@create')->name('provider.create');
    Route::post('/provider/new','ProviderController@store')->name('provider.store');
    Route::get('/provider/edit/{id}','ProviderController@edit')->name('provider.edit');
    Route::put('/provider/{id}','ProviderController@update')->name('provider.update');
    Route::delete('/provider/{id}','ProviderController@delete')->name('provider.delete');
    Route::get('providers/search','ProviderController@instaSearch')->name('provider.search');

    //USER ROUTES
    
    Route::get('/users','UserController@index')->name('user.index');
    Route::get('/user/{id}','UserController@show')->name('user.show');
    Route::get('/userCreate','UserController@create')->name('user.create');
    Route::post('/user/create','UserController@store')->name('user.store');
    Route::get('/user/edit/{id}','UserController@edit')->name('user.edit');
    Route::put('/user/edit/{id}','UserController@update')->name('user.update');
    Route::get('/user/changeP/{id}','UserController@editPassword')->name('user.editpass');
    Route::put('/user/changeP/{id}','UserController@updatePassword')->name('user.updatepass'); 
    Route::get('/user/points/{id}','UserController@points')->name('user.points');
    Route::put('/user/points/{id}','UserController@setPoints')->name('user.setpoints');
    Route::put('/user/disable/{id}','UserController@disableUser')->name('user.disable');
    Route::put('/user/enable/{id}','UserController@enableUser')->name('user.enable');
    Route::get('/users/search','UserController@instaSearch')->name('user.search');
    
    //PRODUCT ROUTES
    Route::get('/products', 'ProductController@index')->name('product.index');
    Route::get('/product/{id}','ProductController@show')->name('product.show');
    Route::put('/product/{id}','ProductController@update')->name('product.update');
    Route::delete('/product/{id}','ProductController@delete')->name('product.delete');
    Route::post('/product/create','ProductController@store')->name('product.store');
    Route::get('/productNew','ProductController@create')->name('product.create');
    Route::get('/product/edit/{id}','ProductController@edit')->name('product.edit');
    Route::get('products/search','ProductController@instaSearch')->name('product.search');

    //PRODUCT ROUTES
    Route::get('/expenses', 'ExpenseController@index')->name('expense.index');
    Route::get('/expense/{id}','ExpenseController@show')->name('expense.show');
    Route::post('/expense/create','ExpenseController@store')->name('expense.store');
    Route::get('/expenseNew','ExpenseController@create')->name('expense.create');
    Route::get('expenses/search','ExpenseController@instaSearch')->name('expense.search');


    //TYPE PRODUCT ROUTES
    Route::post('/typeP/create','TypeProductController@store')->name('typeP.store');
    Route::delete('/typeP/{id}','TypeProductController@delete')->name('typeP.delete');

    //SALES ROOM
    Route::get('/salesRoom','SaleRoomController@index')->name('salesroom.index');
    Route::get('/table/{id}','SaleRoomController@showTable')->name('salesroom.table');

    //TICKET ROUTES
    Route::get('/ticket/new/{id}','TicketController@create')->name('ticket.create');
    Route::post('/ticketCancel/{id}','TicketController@delete')->name('ticket.cancel');
    Route::post('/ticket/{id}','TicketController@addProduct')->name('ticket.addProduct');
    Route::post('/ticket/{idTicket}/{idProduct}','TicketController@removeProduct')->name('ticket.removeProduct');
    Route::get('/ticket/{code}','TicketController@show')->name('ticket.show');
    Route::get('/ticket/summary/{id}','TicketController@summary')->name('ticket.summary');

    //SALE ROUTES
    Route::post('sale/new/{id}','SaleController@makeSale')->name('sale.make');
    Route::get('sale/{id}','SaleController@show')->name('sale.show');

    //REPORT ROUTES
    Route::get('/reports','ReportController@index')->name('report.index');
    Route::get('/reportSearch','ReportController@instaSearch')->name('report.search');

});

Route::get('/', function () {
    return view('LandingPage.landing');
});

//Auth::routes();


