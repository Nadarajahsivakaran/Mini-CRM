<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\userController;

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


// Company
Route::get("/companies",[CompaniesController::class,'viewCompany']);
Route::post("/storeCompany",[CompaniesController::class,'store']);
Route::get("/deleteCompany/{id}",[CompaniesController::class,'delete']);


// Employee
Route::get("/employees",[EmployeesController::class,'viewEmployee']);
Route::post("/storeEmployee",[EmployeesController::class,'store']);
Route::get("/deleteEmployee/{id}",[EmployeesController::class,'delete']);


// users
Route::post("/storeUser",[userController::class,'store']);
Route::post("/login",[userController::class,'login']);
Route::get("/logout",[userController::class,'logout']);
Route::get("/",[userController::class,'viewLogin']);
Route::view('signup','signup');




