<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QRController;
use App\Http\Controllers\Api\CrudApiController;
use App\Http\Controllers\CrudPaginateController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('qrLaravel/{text}', [QRController::class, 'qr'])->name('qrLaravel');
Route::post('storeUser', [QRController::class, 'store'])->name('storeUser');
Route::post('/paginate/record-to-number', [CrudPaginateController::class, 'recordNumber'])->name('paginate.recordToNumber');
Route::get('/crud', [CrudApiController::class, 'index'])->name('api.index');
Route::get('/crud/{id}', [CrudApiController::class, 'show'])->name('api.show');
Route::delete('/crud/{id}', [CrudApiController::class, 'destroy'])->name('api.destroy');


Route::post('/save-user', [CrudApiController::class, 'store'])->name('api.store');

Route::get('/permissions', [CrudApiController::class, 'permissions'])->name('api.permissions');
