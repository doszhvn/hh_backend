<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\EmploymentTypeController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VacancyReplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('cv')->group(function () {
    Route::get('/', [CVController::class, 'index'])->middleware('userRole');
    Route::get('/{dataId}', [CVController::class, 'show']);
    Route::post('/', [CVController::class, 'store'])->middleware('userRole');
    Route::put('/{dataId}', [CVController::class, 'update'])->middleware('userRole');
    Route::delete('/{dataId}', [CVController::class, 'delete'])->middleware('userRole');
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{dataId}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store'])->middleware('hrRole');
    Route::put('/{dataId}', [CategoryController::class, 'update'])->middleware('hrRole');
    Route::delete('/{dataId}', [CategoryController::class, 'delete'])->middleware('adminRole');
});

Route::prefix('employment-type')->group(function () {
    Route::get('/', [EmploymentTypeController::class, 'index']);
    Route::get('/{dataId}', [EmploymentTypeController::class, 'show']);
    Route::post('/', [EmploymentTypeController::class, 'store'])->middleware('hrRole');
    Route::put('/{dataId}', [EmploymentTypeController::class, 'update'])->middleware('hrRole');
    Route::delete('/{dataId}', [EmploymentTypeController::class, 'delete'])->middleware('adminRole');
});

Route::prefix('vacancy-reply')->group(function () {
    Route::get('/', [VacancyReplyController::class, 'index']);
    Route::get('/by-vacancy-id', [VacancyReplyController::class, 'replyByVacancyId']);
    Route::get('/{dataId}', [VacancyReplyController::class, 'show']);
    Route::post('/', [VacancyReplyController::class, 'store'])->middleware('userRole');
    Route::put('/{dataId}', [VacancyReplyController::class, 'update'])->middleware('userRole');
    Route::delete('/{dataId}', [VacancyReplyController::class, 'delete'])->middleware('adminRole');
});

Route::prefix('vacancy')->group(function () {
    Route::get('/', [VacancyController::class, 'index']);
    Route::get('/{dataId}', [VacancyController::class, 'show']);
    Route::post('/', [VacancyController::class, 'store'])->middleware('hrRole');
    Route::put('/{dataId}', [VacancyController::class, 'update'])->middleware('hrRole');
    Route::delete('/{dataId}', [VacancyController::class, 'delete'])->middleware('adminRole');
});



Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);
});
