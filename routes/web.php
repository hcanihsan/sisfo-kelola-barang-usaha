<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dashboardAdminController;
use App\Http\Controllers\productController;
use App\Http\Controllers\historySellController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::group(['middleware'=> ['auth']],function(){
    Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
    Route::resource('dashboard', dashboardController::class);
    Route::resource('manageproduct', productController::class);
    Route::resource('historysell', historySellController::class);
});
// Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
//Route::post('dashboard', [dashboardController::class, 'index'])->name('dashboard')->middleware('auth');
//Route::post('dashboard/addnote', [dashboardController::class, 'create'])->name('addnote')->middleware('auth');