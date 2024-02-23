<?php

use Illuminate\Routing\RouteGroup;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'prevent-back']], function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('companies/', [App\Http\Controllers\CompaniesController::class, 'index'])->name('companies');
    Route::post('store-companies/', [App\Http\Controllers\CompaniesController::class, 'store'])->name('store-companies');
    Route::post('delete-company/', [App\Http\Controllers\CompaniesController::class, 'delete'])->name('delete-company');
    Route::get('edit-company/{company_id}', [App\Http\Controllers\CompaniesController::class, 'edit'])->name('edit-company');
    Route::post('update-company/', [App\Http\Controllers\CompaniesController::class, 'update'])->name('update-company');

    // Employees route start

    Route::get('employees', [App\Http\Controllers\EmployeesController::class, 'index'])->name('employees');
    Route::post('store-employees/', [App\Http\Controllers\EmployeesController::class, 'store'])->name('store-employees');
    Route::post('delete-employees/', [App\Http\Controllers\EmployeesController::class, 'delete'])->name('delete-employees');
    Route::get('edit-employees/{employees_id}', [App\Http\Controllers\EmployeesController::class, 'edit'])->name('edit-employees');
    Route::post('update-employees/', [App\Http\Controllers\EmployeesController::class, 'update'])->name('update-employees');
});
