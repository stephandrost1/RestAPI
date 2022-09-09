<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('v1/companies', CompanyController::class)->middleware('ForceJSONResponse', 'auth:sanctum');
Route::resource('v1/employees', EmployeeController::class)->middleware('ForceJSONResponse', 'auth:sanctum');


Route::post('/auth/register', [AuthController::class, 'createUser'])->middleware('ForceJSONResponse');
Route::post('/auth/login', [AuthController::class, 'loginUser'])->middleware('ForceJSONResponse');
