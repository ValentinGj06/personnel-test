<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CallsController;
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

Route::get('/', [ImportController::class, 'index']);
Route::post('import', [ImportController::class, 'import']);

Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::get('users/{user}/delete', [UserController::class, 'destroy']);

Route::get('calls', [CallsController::class, 'index']);
Route::get('calls/create', [CallsController::class, 'create']);
Route::post('calls', [CallsController::class, 'store']);
Route::get('calls/{call}', [CallsController::class, 'show']);
Route::get('calls/{call}/edit', [CallsController::class, 'edit']);
Route::patch('calls/{call}', [CallsController::class, 'update']);
Route::delete('calls/{call}', [CallsController::class, 'destroy']);
Route::get('calls/{call}/delete', [CallsController::class, 'destroy']);

Route::get('run-migrate', function () {
    /* php artisan migrate */
    \Artisan::call('migrate');
    exit("Database migrated successfully");
});

Route::get('run-migrate-rollback', function () {
    /* php artisan migrate:rollback */
    \Artisan::call('migrate:rollback');
    exit("Database rollback successfully");
});
