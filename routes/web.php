<?php

use App\Http\Controllers\TestCaseController;
use App\Http\Controllers\TestRunController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [TestRunController::class, 'index']);

    Route::resource('test-run', TestRunController::class)->only([
        'index'
    ]);

    Route::resource('test-case', TestCaseController::class)->only([
        'index', 'create', 'store'
    ]);
});

require __DIR__.'/auth.php';
