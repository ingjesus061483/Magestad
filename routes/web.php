<?php

use App\Exports\ClientExport;
use App\Http\Controllers\ArlController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactInfoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmploymentInformationController;
use App\Http\Controllers\EpsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ClientPolicyController;
use App\Http\Controllers\AuthorizationPolicyController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NewnessController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewnessTypeController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\RequestLoanController;
use Maatwebsite\Excel\Facades\Excel;
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

Route::get('/',[HomeController::class,'index']);/* function () {
    return view('welcome');
});*/
Route::resource('requestLoan',RequestLoanController::class);
Route::resource('homework',HomeworkController::class);
Route::get('UnAutorize', function () {
    return view('Shared.UnAutorize');
});
Route::get('cities/GetcitiesByName',[CityController::class,'GetcitiesByName']);
Route::get('clients/downloadExcel/{id}',[ClientController::class,'downloadExcel']);
Route::resource('Newness',NewnessController::class);
Route::resource('NewnessType',NewnessTypeController::class);
Route::get('clients/GetClients',[ClientController::class,'GetClients']);
Route::get('authorizationPolicies/ShowByTitle/{id}',[AuthorizationPolicyController::class,'showByTitle']);
Route::get('NewnessType/SearchByName/{id}',[NewnessTypeController::class,'SearchByName']);
Route::resource('users', UserController::class);
Route::resource('authorizationPolicies',AuthorizationPolicyController::class);
Route::patch('clients/UpdateDataProccess/{id}',[ClientController::class,'UpdateDataProccess']);
Route::get('clients/SearchByName',[ClientController::class,'SearchByName']);
Route::patch('clients/UpdateLawInformation/{id}',[ClientController::class,'UpdateLawInformation']);
Route::patch('clients/UpdatePatrimonialInformation/{id}',[ClientController::class,'UpdatePatrimonialInformation']);
Route::get('cities/GetCitiesByState/{stateId}',[CityController::class,'GetCitiesByState']);
Route::resource('contactinfo',ContactInfoController::class);
Route::resource('clients',ClientController::class);
Route::resource('employmentInformations', EmploymentInformationController::class);
Route::resource('loans', LoanController::class);
Route::get('users/login/{id}',[UserController::class,'login']);
Route::post('users/sigin',[UserController::class,'storelogin']);
Route::post('users/logout',[UserController::class,'logout']);
Route::post('Newness/changeStateNewness/{id}',[NewnessController::class,'changeStateNewness']);
Route::post('homework/changeStateHomework/{id}',[HomeworkController::class,'changeStateHomework']);
Route::resource('arls',ArlController::class);
Route::resource('eps',EpsController::class);
Route ::resource('clientPolicies', ClientPolicyController::class);
Route::resource('DocumentType',DocumentTypeController::class);
Route::resource('documents',DocumentController::class);
Route::get('documents/download/{id}',[DocumentController::class,'Download']);
