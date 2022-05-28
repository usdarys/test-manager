<?php

use App\Http\Controllers\TestCaseController;
use App\Http\Controllers\TestRunController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\UserController;
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
    Route::get('/', [ProjectController::class, 'index']);

    Route::resource('/project', ProjectController::class)
            ->only(['index', 'create', 'store'])
            ->where(['project' => '[0-9]+']);

    Route::resource('/user', UserController::class)
            ->only(['index', 'create', 'store', 'update', 'edit', 'destroy'])
            ->where(['user' => '[0-9]+']);

    Route::prefix('/{project}')->group(function () {
        Route::resource('/test-run', TestRunController::class)
                ->only(['index', 'create', 'store'])
                ->where(['project' => '[0-9]+', 'test-run' => '[0-9]+']);
    
        Route::resource('/test-case', TestCaseController::class)
                ->only(['index', 'create', 'store'])
                ->where(['project' => '[0-9]+', 'test-case' => '[0-9]+']);

        Route::get('/test-result/{testRun}', [TestResultController::class, 'index'])
                ->where(['testRun' => '[0-9]+'])
                ->name('test-result.index');

        Route::get('/test-result/{testRun}/{testCase}/edit', [TestResultController::class, 'edit'])
                ->where(['testRun' => '[0-9]+', 'testCase' => '[0-9]+'])
                ->name('test-result.edit');

        Route::patch('/test-result/{testRun}/{testCase}', [TestResultController::class, 'update'])
                ->where(['testRun' => '[0-9]+', 'testCase' => '[0-9]+'])
                ->name('test-result.update');
    });
});

require __DIR__.'/auth.php';
