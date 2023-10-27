<?php

use App\Http\Controllers\TareaController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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


Route::get("/", function () {
    return view('welcome');
});



Auth::routes();
Route::resource('tareas', TareaController::class)->middleware(Authenticate::class);
Route::get('/home', [TareaController::class, 'index'])->middleware(Authenticate::class);
Route::get('/tareas/user/{id}', [TareaController::class, 'taskByUser'])->middleware(Authenticate::class);
