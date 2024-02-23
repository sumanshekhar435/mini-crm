<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/company/{id}', [CompaniesController::class, 'getCompanyDetailsById']);
Route::post('company-store', [CompaniesController::class, 'storeCompany']);
Route::get('/companies/{company_id}/employees', [CompaniesController::class, 'getEmployees']);
Route::post('/store-employees', [EmployeesController::class, 'storeEmployees']);


