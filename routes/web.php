<?php

use App\Http\Controllers\ComplimentaryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PWAController;
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

Route::get('/', [App\Http\Controllers\PWAController::class, 'index']);
Route::get('/admin',[HomeController::class,'index'])->name('admin_home')->middleware(['admin']);
Route::post('/member/login',[MemberController::class,'login'])->name('member_login');
Route::post('/generate_otp',[MemberController::class,'generate_otp'])->name('generate_otp');
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['admin']);
    Route::prefix('/members')->name('members.')->group(function () {
        Route::get('/',[MemberController::class,'index'])->name('index');
        Route::post('/store',[MemberController::class,'store'])->name('store');
        Route::put('/update',[MemberController::class,'update'])->name('update');
        Route::put('/change_status',[MemberController::class,'change_status'])->name('change_status');
        Route::get('/datatables',[MemberController::class,'datatables'])->name('datatables');
        Route::get('/detail',[MemberController::class, 'detail'])->name('detail');
        Route::get('/dashboard',[MemberController::class,'dashboard'])->name('dashboard');
    });

    Route::prefix('/complementary')->group(function () {
        Route::get('/getProvince',[ComplimentaryController::class,'getProvince'])->name('getProvince');
        Route::get('/getDistrict',[ComplimentaryController::class,'getDistrict'])->name('getDistrict');
        Route::get('/getSubDistrict',[ComplimentaryController::class,'getSubDistrict'])->name('getSubDistrict');
        Route::get('/getVillage',[ComplimentaryController::class,'getVillage'])->name('getVillage');
        Route::get('/getDashoardData',[ComplimentaryController::class,'getCountDashboard'])->name('getDashoardData');
    });
});

Route::prefix('pwa')->name('pwa.')->group(function () {
    Route::get('/',[PWAController::class,'index'])->name('index');
    Route::get('/otp/{email}',[PWAController::class,'otp'])->name('otp');
    Route::middleware(['auth.pwa'])->group(function () {
        Route::get('/register/{id}',[PWAController::class,'register'])->name('register');
        Route::get('/profile/{email}',[PWAController::class,'profile'])->name('profile');
        Route::get('/update/{id}',[PWAController::class,'update'])->name('update');
        Route::put('/store_update',[PWAController::class,'store_update'])->name('store_update');
        Route::get('/download_kta/{id}',[PWAController::class,'download_kta'])->name('download_kta');
    });
    Route::post('/logout',[PWAController::class,'logout'])->name('logout');
});



