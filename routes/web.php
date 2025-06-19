<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VoteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SuaraController;
use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\KandidatController;
use App\Http\Controllers\Admin\VisimisiController;
use App\Http\Controllers\Admin\CountdownController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'welcome')->name('login');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
        
    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.user.home')->name('home');

        Route::get('/home', [VoteController::class, 'index'])->name('home');
        Route::post('/vote', [VoteController::class, 'updateStatus'])->name('updateStatus');

        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.admin.home')->name('home');

        Route::get('/home', [HalamanController::class, 'index'])->name('home');
        Route::get('halaman', [HalamanController::class, 'index'])->name('halaman.index');
        Route::resource('kelas', KelasController::class);
        Route::resource('kandidat', KandidatController::class);
        Route::resource('visimisi', VisimisiController::class);
        Route::get('suara', [SuaraController::class, 'index'])->name('suara.index');
        Route::delete('suara/delete', [SuaraController::class, 'delete'])->name('suara.delete');
        Route::resource('siswa', SiswaController::class);
        Route::post('siswa/deleteAll', [SiswaController::class, 'deleteAllUsers'])->name('siswa.deleteAll');
        Route::post('siswa/SiswaImport', [SiswaController::class, 'SiswaImport'])->name('siswa.SiswaImport');
        Route::get('countdown', [CountdownController::class, 'index'])->name('countdown.index');
        Route::put('countdown/updateTime', [CountdownController::class, 'updateTime'])->name('countdown.updateTime');
        Route::post('countdown/store', [CountdownController::class, 'store'])->name('countdown.store');


        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
