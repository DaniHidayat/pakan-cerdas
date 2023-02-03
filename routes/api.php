<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//API route for register new user

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::post('/forgot', [App\Http\Controllers\API\ForgotPasswordController::class, 'forgot']);
Route::post('/otp', [App\Http\Controllers\API\ForgotPasswordController::class, 'otp']);
Route::post('/reset', [App\Http\Controllers\API\ForgotPasswordController::class, 'reset']);

Route::get('/token', [App\Http\Controllers\API\TokenAgoraController::class, 'index']);
Route::post('/token/update', [App\Http\Controllers\API\TokenAgoraController::class, 'update']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::get('/accounts', [\App\Http\Controllers\API\AccountController::class, 'index']);

    Route::get('/profile', [App\Http\Controllers\API\ProfileController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\API\ProfileController::class, 'update']);
    Route::post('/profile/upload', [App\Http\Controllers\API\ProfileController::class, 'upload']);

    Route::post('/save-token', [App\Http\Controllers\API\FCMController::class, 'store']);

    Route::get('/articles', [App\Http\Controllers\API\ArticleController::class, 'index']);
    Route::get('/articles/hot', [App\Http\Controllers\API\ArticleController::class, 'hot']);
    Route::get('/articles/{slug}', [App\Http\Controllers\API\ArticleController::class, 'show']);
    Route::post('/articles/{slug}/comment', [App\Http\Controllers\API\ArticleController::class, 'comment']);

    Route::get('/videos', [App\Http\Controllers\API\VideoController::class, 'index']);

    // Route::get('/booking', [App\Http\Controllers\API\BookingController::class, 'index']);
    // Route::get('/booking/{id}', [App\Http\Controllers\API\BookingController::class, 'show']);
    // Route::post('/booking/{id}', [App\Http\Controllers\API\BookingController::class, 'store']);

    Route::get('/booking/{id}', [App\Http\Controllers\API\BookingController::class, 'booking']);

    Route::get('/v2/booking/{id}', [App\Http\Controllers\API\v2\BookingController::class, 'show']);

    Route::get('/chat', [App\Http\Controllers\API\ChatController::class, 'index']);
    Route::get('/fisioterapis', [App\Http\Controllers\API\FisioterapisController::class, 'index']);
    Route::get('/fisioterapis/{id}', [App\Http\Controllers\API\FisioterapisController::class, 'show']);

    // Route::get('/clinics', [App\Http\Controllers\API\ClinicController::class, 'index']);
    // Route::get('/clinics/{id}', [App\Http\Controllers\API\ClinicController::class, 'show']);

    Route::group(['prefix' => 'fisio'], function () {
        Route::get('/chat', [\App\Http\Controllers\Fisioterapis\ChatController::class, 'index']);
    });
});
