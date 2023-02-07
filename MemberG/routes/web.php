<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\jabatan\JabatanController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\transaksi\TransaksiController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
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


Route::get('/admin', function () {
    return view('dashboard.login.login-admin');
});
Route::get('utama', [DashboardController::class, 'dashboard'])->name('dasboard');

Route::post('login-admin', [AuthController::class, 'loginAdmin'])->name('login-admin.action');
Route::get('logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout-admin');

Route::get('/', function () {
    return view('dashboard.login.login-member');
})->name('view-member');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::post('login-member', [AuthController::class, 'loginMember'])->name('login-member.action');
Route::get('logout-member', [AuthController::class, 'logoutMember'])->name('logout-member');

Route::get('/register', [MemberController::class, 'register'])->name('member-register');
Route::get('/data-member', [MemberController::class, 'all'])->name('data-member.all');
Route::Resource('/members', MemberController::class);

Route::put('/account-active/{id}', [UserController::class, 'activate'])->name('account-active.activate');
Route::put('/account-ban/{id}', [UserController::class, 'ban'])->name('account-ban.ban');

Route::Resource('/account', UserController::class);

Route::get('/kabupaten', [MemberController::class, 'kabupaten'])->name('kabupaten.kabupaten');
Route::get('/kecamatan', [MemberController::class, 'kecamatan'])->name('kecamatan.kecamatan');
