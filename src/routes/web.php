<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;


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
Route::get('/', [ContactController::class,'index']);

Route::post('/confirm', [ContactController::class,'confirm']);
Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/thanks', [ContactController::class, 'thanks']);


Route::get('/register', [AuthController::class, 'add']);
Route::post('/register', [AuthController::class, 'create']);

Route::get('/login', [AuthController::class, 'login'])->name('login.form');

Route::get('/admin', [ContactController::class, 'admin'])
    ->middleware('auth') ->name('admin.index');

Route::get('/admin/export', [ContactController::class, 'export'])->name('admin.export');
Route::get('/admin/{id}', [ContactController::class, 'show'])->name('admin.show');
Route::delete('/admin/{id}', [ContactController::class, 'destroy'])->name('admin.destroy');