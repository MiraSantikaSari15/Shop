<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', function () {
		return redirect('/home');
	});
	
	/* === PRODUCTS ===  */
	Route::resource('products', 'ProductController');
	Route::get('products-table', 'ProductController@datatable')->name('products.table');

	/* === COSTUMERS ===  */
	Route::resource('customers', 'CustomerController');
	Route::get('customers-table', 'CustomerController@datatable')->name('customers.table');

	/* === SALES ORDER ===  */
	Route::resource('sales-order', 'SalesOrderController');
	Route::get('sales-order-table', 'SalesOrderController@datatable')->name('sales.order.table');
	Route::get('sales-order/detail/{id}', 'SalesOrderController@detailCustomer')->name('sales.order.detail');
});
