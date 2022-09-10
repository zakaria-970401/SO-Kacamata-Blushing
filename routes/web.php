<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\KedatanganController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\StokOpnameController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::prefix('master')->group(function () {
    Route::get('/masterUser', [SuperAdminController::class, 'masterUser']);
    Route::get('/deleteUser/{id}', [SuperAdminController::class, 'deleteUser']);
    Route::POST('/post_user', [SuperAdminController::class, 'postUser']);
    Route::get('/showUser/{id}', [SuperAdminController::class, 'showUser']);
    Route::get('/resetPassword/{id}', [SuperAdminController::class, 'resetPassword']);
    Route::POST('/updateUser', [SuperAdminController::class, 'updateUser']);

    Route::get('/item', [SuperAdminController::class, 'masterItem']);
    Route::POST('/postItem', [SuperAdminController::class, 'postItem']);
    Route::get('/deleteItem/{id}', [SuperAdminController::class, 'deleteItem']);
    Route::get('/showItem/{id}', [SuperAdminController::class, 'showItem']);
    Route::POST('/updateItem', [SuperAdminController::class, 'updateItem']);

    Route::get('/stok', [SuperAdminController::class, 'masterStok']);
    Route::GET('/updateStok/{qty}/{id}', [SuperAdminController::class, 'updateStok']);
});

Route::prefix('kedatangan/')->group(function () {
    Route::get('/', [KedatanganController::class, 'index']);
    Route::POST('postKedatangan', [KedatanganController::class, 'postKedatangan']);
    Route::POST('checkInputan', [KedatanganController::class, 'checkInputan']);
    Route::get('/getUpdateQty', [KedatanganController::class, 'getUpdateQty']);
    Route::POST('postUpdateQty', [KedatanganController::class, 'postUpdateQty']);
});

Route::prefix('pengeluaran/')->group(function () {
    Route::get('/', [PengeluaranController::class, 'index']);
    Route::POST('postPengeluaran', [PengeluaranController::class, 'postPengeluaran']);
    Route::POST('checkInputan', [PengeluaranController::class, 'checkInputan']);
    // Route::get('/getUpdateQty', [PengeluaranController::class, 'getUpdateQty']);
    // Route::POST('postUpdateQty', [PengeluaranController::class, 'postUpdateQty']);
});

Route::prefix('so/')->group(function () {
    Route::get('/', [StokOpnameController::class, 'index']);
    Route::get('start', [StokOpnameController::class, 'start']);
    Route::get('stop', [StokOpnameController::class, 'stop']);
    Route::get('getList', [StokOpnameController::class, 'getList']);
    Route::POST('compareQty', [StokOpnameController::class, 'compareQty']);
    Route::POST('postQty', [StokOpnameController::class, 'postQty']);
    Route::get('cariData/{tgl_mulai}/{tgl_selesai}', [StokOpnameController::class, 'cariData']);
});

Route::POST('change-password', [SuperAdminController::class, 'change_password']);
