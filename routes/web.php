<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\FisioterapisController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TagController;
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


Route::get('/', function () {
    return redirect()->route('admin.auth.login');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.auth.login');
    Route::post('/login', [LoginController::class, 'store'])->name('admin.auth.store');
    Route::delete('/logout', [LoginController::class, 'destroy'])->name('admin.auth.logout');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

        Route::get('fisioterapis/{id}/images', [FisioterapisController::class, 'getImages'])->name('admin.fisioterapis.getImages');
        Route::resource('fisioterapis', FisioterapisController::class, ['as' => 'admin']);
        Route::resource('fisioterapis.schedule', ScheduleController::class, ['as' => 'admin'])->except('index');

        Route::resource('user', UserController::class, ['as' => 'admin']);

        Route::resource('tag', TagController::class, ['as' => 'admin']);
        // Route::resource('price', PriceController::class, ['as' => 'admin']);
        Route::resource('article', ArticleController::class, ['as' => 'admin'])->parameters(['id' => 'slug']);
        Route::resource('video', VideoController::class, ['as' => 'admin']);
    });
});

// Route::get('/email', function () {
//     return view('emails.otp', [
//         'otp' => 1023
//     ]);
// });
