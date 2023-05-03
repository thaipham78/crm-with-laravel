<?php
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
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

Route::get('/companies/{id}', [CompanyController::class, 'show'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::get('/companies/{limit?}/{offset?}', [CompanyController::class, 'index'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::post('/companies', [CompanyController::class, 'store'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::put('/companies/{id}', [CompanyController::class, 'update'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->middleware(['auth:sanctum','roles:user,Super-Admin']);

Route::get('/contacts/{id}', [ContactController::class, 'show'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::get('/contacts/{limit?}/{offset?}', [ContactController::class, 'index'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::post('/contacts', [ContactController::class, 'store'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::put('/contacts/{id}', [ContactController::class, 'update'])->middleware(['auth:sanctum','roles:user,Super-Admin']);
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->middleware(['auth:sanctum','roles:user,Super-Admin']);

Route::get('/users/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum','roles:Super-Admin']);
Route::get('/users/{limit?}/{offset?}', [UserController::class, 'index'])->middleware(['auth:sanctum','roles:Super-Admin']);
Route::post('/users/create', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update'])->middleware(['auth:sanctum','roles:Super-Admin']);
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware(['auth:sanctum','roles:Super-Admin']);
Route::post('/users/login', [UserController::class, 'login']);




