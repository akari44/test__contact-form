<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
Route::get('/confirm', [ContactController::class,'confirm']);
Route::get('/register', [ContactController::class,'register']);
Route::get('/login', [ContactController::class,'login']);
Route::get('/thanks', [ContactController::class,'thanks']);
Route::get('/admin', [ContactController::class,'admin']);
