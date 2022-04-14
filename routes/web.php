<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => true,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/logout', [LoginController::class, 'logout'])->middleware(['auth']);
Route::get('/home', [PatientsController::class, 'index'])->middleware(['auth']);

// BACK END
Route::post('/admin/patient/db/save', [PatientsController::class, 'savePatient'])->middleware(['auth']);
Route::get('/admin/patient/GET_ALL', [PatientsController::class, 'getAll'])->middleware(['auth']);
Route::get('/admin/patient/CHANGE_STATUS', [PatientsController::class, 'changeStatus'])->middleware(['auth']);
Route::get('/admin/patient/VIEW_LAB_REPORT', [PatientsController::class, 'viewLABReport'])->middleware(['auth']);
Route::get('/admin/patient/VIEW_XRAY_REPORT', [PatientsController::class, 'viewXRAYReport'])->middleware(['auth']);

Route::get('/patient/GET_PATIENT_DETAILS', [PatientsController::class, 'getPatientDetailsById']);
