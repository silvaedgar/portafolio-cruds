<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudApiController;
use App\Http\Controllers\CrudPaginateController;
use App\Http\Controllers\DataTableServerSideController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\ElementsController;
use App\Http\Controllers\MenuController;

use App\Http\Controllers\GraphicsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MenuController::class, 'portfolio'])->name('home');
Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('dashboard');

// ---------------  Rutas del DataTableServerSide ------------------
Route::get('/datatable-serverside', [DataTableServerSideController::class, 'index'])->name('dataTableSS.index');
Route::get('/datatable-serverside/edit/{id}', [DataTableServerSideController::class, 'edit'])->name('dataTableSS.edit');
Route::post('/datatable-serverside', [DataTableServerSideController::class, 'store'])->name('dataTableSS.store');
Route::delete('/datatable-serverside/{id}', [DataTableServerSideController::class, 'destroy'])->name('dataTableSS.destroy');

// // ---------------  Rutas del DataTable Cliente ------------------
Route::get('/datatable', [DataTableController::class, 'index'])->name('dataTable.index');
Route::post('/datatable', [DataTableController::class, 'store'])->name('dataTable.store');
Route::delete('/datatable', [DataTableController::class, 'destroy'])->name('dataTable.destroy');

// // ---------------  Rutas del DataTable con Paginate ------------------
Route::get('/paginate', [CrudPaginateController::class, 'index'])->name('paginate.index');
Route::get('/api', [CrudApiController::class, 'index'])->name('apiCrud.index');

Route::get('/graphics', [GraphicsController::class, 'index'])->name('graphics.index');

Route::get('/login', [UserController::class, 'viewLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/inputs', [ElementsController::class, 'input'])->name('elements.input');
Route::get('/selects', [ElementsController::class, 'select'])->name('elements.select');
Route::get('/check', [ElementsController::class, 'check'])->name('elements.check');
Route::get('/qrCode', [ElementsController::class, 'qr'])->name('elements.qrCode');
Route::get('/modal', [ElementsController::class, 'modal'])->name('elements.modal');
