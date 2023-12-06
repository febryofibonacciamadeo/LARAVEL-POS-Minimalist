<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\DashboardController as Dashboard;
use App\Http\Controllers\SupplierController as Supplier;
use App\Http\Controllers\ProdukController as Produk;
use App\Http\Controllers\CustomerController as Customer;
use App\Http\Controllers\TransactionController as Transaction;

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

Route::controller(Authentication::class)->group(function() {
	Route::get('/Login', 'viewLogin');
	Route::get('/Register', 'viewRegister');
	Route::get('/Register_Toko', 'viewRegisterToko');
	Route::post('/Register', 'handleRegister');
	Route::post('/Login', 'handleLogin');
});

Route::middleware('AuthSecurity')->group(function() {
	Route::controller(Dashboard::class)->group(function() {
		Route::get('/', 'Dashboard');
		Route::get('/data-penjualan', 'data_penjualan');
	});
	Route::controller(Supplier::class)->group(function() {
		Route::get('/Supplier', 'index');
		Route::get('/Supplier/Add', 'form_add');
		Route::post('/Supplier/Add', 'handle_add');
		Route::get('/Supplier/Edit/{suplier_id}', 'form_edit');
		Route::put('/Supplier/Edit/{suplier_id}', 'handle_edit');
		Route::delete('/Supplier/Delete/{suplier_id}', 'handle_delete');
	});
	Route::controller(Produk::class)->group(function() {
		Route::get('/Produk', 'index');
		Route::get('/Produk/Add', 'form_add');
		Route::post('/Produk/Add', 'handle_add');
		Route::get('/Produk/Edit/{product_id}', 'form_edit');
		Route::put('/Produk/Edit/{product_id}', 'handle_edit');
		Route::delete('/Produk/Delete/{product_id}', 'handle_delete');
	});
	Route::controller(Customer::class)->group(function() {
		Route::get('/Customer', 'index');
		Route::get('/Customer/Add', 'form_add');
		Route::post('/Customer/Add', 'handle_add');
		Route::get('/Customer/Edit/{customer_id}', 'form_edit');
		Route::put('/Customer/Edit/{customer_id}', 'handle_edit');
		Route::delete('/Customer/Delete/{customer_id}', 'handle_delete');
	});
	Route::controller(Transaction::class)->group(function() {
		Route::get('/Sales', 'index');
		Route::post('/Sales/Incoming', 'incoming');
		Route::delete('/Sales/Cancel/{transaction_id}/{product_code}/{qty_count}', 'cancel');
		Route::post('/Sales/Save/{invoice}', 'checkout');
	});
	Route::get('/Logout', [Authentication::class, 'Logout']);
});
