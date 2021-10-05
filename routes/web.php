<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RoleController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
// frontend
Route::get('/',[FrontController::class, 'index'])->name('frontend');
// Dashboard
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/role/assign/user',[RoleController::class, 'assignUser'])->name('assign.user')->middleware('auth');
Route::post('/dashboard/role/assign/user/post',[RoleController::class, 'assignUserPost'])->name('assign.user.post')->middleware('auth');
Route::get('/dashboard/create/user',[RoleController::class, 'createUser'])->name('create.user')->middleware('auth');
Route::post('/dashboard/create/user/post',[RoleController::class, 'createUserPost'])->name('create.user.post')->middleware('auth');
Route::resource('/dashboard/role',RoleController::class);

require __DIR__.'/auth.php';
