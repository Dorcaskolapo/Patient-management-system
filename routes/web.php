<?php

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

Route::get('/', function () {
    return view('staff.auth.login');
});

// Route::get('/', [App\Http\Controllers\Staff\LoginController::class, 'welcome']);

Route::group(['prefix' => 'admin'], function () {
  Route::get('/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
  Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
  Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

  // Route::get('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
  // Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

  Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
  Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'reset'])->name('password.email');
  Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
  Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class, 'showResetForm']);

  Route::get('/home', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home')->middleware(['auth:admin']);

  Route::get('/staff', [App\Http\Controllers\Admin\AdminController::class, 'staff'])->name('staff')->middleware(['auth:admin']);  
  Route::get('/allStaff', [App\Http\Controllers\Admin\AdminController::class, 'allStaff'])->name('allStaff')->middleware(['auth:admin']);  
  Route::post('/addStaff', [App\Http\Controllers\Admin\AdminController::class, 'addStaff'])->name('addStaff')->middleware(['auth:admin']);
  Route::post('/editStaff', [App\Http\Controllers\Admin\AdminController::class, 'editStaff'])->name('editStaff')->middleware(['auth:admin']);
  Route::post('/deleteStaff', [App\Http\Controllers\Admin\AdminController::class, 'deleteStaff'])->name('deleteStaff')->name('deleteStaff')->middleware(['auth:admin']);

  Route::get('/patient', [App\Http\Controllers\Admin\AdminController::class, 'patient'])->name('patient')->middleware(['auth:admin']);  
  Route::get('/allPatient', [App\Http\Controllers\Admin\AdminController::class, 'allPatient'])->name('allPatient')->middleware(['auth:admin']);  
  Route::post('/addPatient', [App\Http\Controllers\Admin\AdminController::class, 'addPatient'])->name('addPatient')->middleware(['auth:admin']);
  Route::get('/viewPatient/{slug}', [App\Http\Controllers\Admin\AdminController::class, 'viewPatient'])->name('viewPatient')->middleware(['auth:admin']);
  Route::post('/editPatient', [App\Http\Controllers\Admin\AdminController::class, 'editPatient'])->name('editPatient')->middleware(['auth:admin']);
  Route::post('/deletePatient', [App\Http\Controllers\Admin\AdminController::class, 'deletePatient'])->name('deletePatient')->name('deletePatient')->middleware(['auth:admin']);

  Route::get('/prescription', [App\Http\Controllers\Admin\AdminController::class, 'prescription'])->name('prescription')->middleware(['auth:admin']);  
  Route::get('/allPrescription', [App\Http\Controllers\Admin\AdminController::class, 'allPrescription'])->name('allPrescription')->middleware(['auth:admin']);  
  Route::post('/addPrescription', [App\Http\Controllers\Admin\AdminController::class, 'addPrescription'])->name('addPrescription')->middleware(['auth:admin']);
  Route::post('/editPrescription', [App\Http\Controllers\Admin\AdminController::class, 'editPrescription'])->name('editPrescription')->middleware(['auth:admin']);
  Route::post('/deletePrescription', [App\Http\Controllers\Admin\AdminController::class, 'deletePrescription'])->name('deletePrescription')->name('deletePrescription')->middleware(['auth:admin']);

  Route::get('/drug', [App\Http\Controllers\Admin\AdminController::class, 'drug'])->name('drug')->middleware(['auth:admin']);  
  Route::get('/allDrug', [App\Http\Controllers\Admin\AdminController::class, 'allDrug'])->name('allDrug')->middleware(['auth:admin']);  
  Route::post('/addDrug', [App\Http\Controllers\Admin\AdminController::class, 'addDrug'])->name('addDrug')->middleware(['auth:admin']);
  Route::post('/editDrug', [App\Http\Controllers\Admin\AdminController::class, 'editDrug'])->name('editDrug')->middleware(['auth:admin']);
  Route::post('/deleteDrug', [App\Http\Controllers\Admin\AdminController::class, 'deleteDrug'])->name('deleteDrug')->name('deleteDrug')->middleware(['auth:admin']);

  Route::get('/test', [App\Http\Controllers\Admin\AdminController::class, 'test'])->name('test')->middleware(['auth:admin']);  
  Route::get('/allTest', [App\Http\Controllers\Admin\AdminController::class, 'allTest'])->name('allTest')->middleware(['auth:admin']);  
  Route::post('/addTest', [App\Http\Controllers\Admin\AdminController::class, 'addTest'])->name('addTest')->middleware(['auth:admin']);
  Route::post('/editTest', [App\Http\Controllers\Admin\AdminController::class, 'editTest'])->name('editTest')->middleware(['auth:admin']);
  Route::post('/deleteTest', [App\Http\Controllers\Admin\AdminController::class, 'deleteTest'])->name('deleteTest')->name('deleteTest')->middleware(['auth:admin']);

  // Route::get('/billing', [App\Http\Controllers\Admin\AdminController::class, 'billing'])->name('billing')->middleware(['auth:admin']);  
  // Route::get('/allBilling', [App\Http\Controllers\Admin\AdminController::class, 'allBilling'])->name('allBilling')->middleware(['auth:admin']);  
  // Route::post('/addBilling', [App\Http\Controllers\Admin\AdminController::class, 'addBilling'])->name('addBilling')->middleware(['auth:admin']);
  // Route::post('/editBilling', [App\Http\Controllers\Admin\AdminController::class, 'editBilling'])->name('editBilling')->middleware(['auth:admin']);
  // Route::post('/deleteBilling', [App\Http\Controllers\Admin\AdminController::class, 'deleteBilling'])->name('deleteBilling')->name('deleteBilling')->middleware(['auth:admin']);

  Route::get('/genotype', [App\Http\Controllers\Admin\AdminController::class, 'genotype'])->name('genotype')->middleware(['auth:admin']);  
  Route::get('/allGenotype', [App\Http\Controllers\Admin\AdminController::class, 'allGenotype'])->name('allGenotype')->middleware(['auth:admin']);  
  Route::post('/addGenotype', [App\Http\Controllers\Admin\AdminController::class, 'addGenotype'])->name('addGenotype')->middleware(['auth:admin']);
  Route::post('/editGenotype', [App\Http\Controllers\Admin\AdminController::class, 'editGenotype'])->name('editGenotype')->middleware(['auth:admin']);
  Route::post('/deleteGenotype', [App\Http\Controllers\Admin\AdminController::class, 'deleteGenotype'])->name('deleteGenotype')->name('deleteGenotype')->middleware(['auth:admin']);

  Route::get('/bloodgroup', [App\Http\Controllers\Admin\AdminController::class, 'bloodgroup'])->name('bloodgroup')->middleware(['auth:admin']);  
  Route::get('/allBloodgroup', [App\Http\Controllers\Admin\AdminController::class, 'allBloodgroup'])->name('allBloodgroup')->middleware(['auth:admin']);  
  Route::post('/addBloodgroup', [App\Http\Controllers\Admin\AdminController::class, 'addBloodgroup'])->name('addBloodgroup')->middleware(['auth:admin']);
  Route::post('/editBloodgroup', [App\Http\Controllers\Admin\AdminController::class, 'editBloodgroup'])->name('editBloodgroup')->middleware(['auth:admin']);
  Route::post('/deleteBloodgroup', [App\Http\Controllers\Admin\AdminController::class, 'deleteBloodgroup'])->name('deleteBloodgroup')->name('deleteBloodgroup')->middleware(['auth:admin']);

  Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('profile')->middleware(['auth:admin']);  
});

Route::group(['prefix' => 'staff'], function () {
  Route::get('/', [App\Http\Controllers\Staff\Auth\LoginController::class, 'showLoginForm'])->name('staff.login');
  Route::get('/login', [App\Http\Controllers\Staff\Auth\LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [App\Http\Controllers\Staff\Auth\LoginController::class, 'login']);
  Route::post('/logout', [App\Http\Controllers\Staff\Auth\LoginController::class, 'logout'])->name('logout');

  // Route::get('/register', [App\Http\Controllers\Staff\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
  // Route::post('/register', [App\Http\Controllers\Staff\Auth\RegisterController::class, 'register']);

  Route::post('/password/email', [App\Http\Controllers\Staff\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.request');
  Route::post('/password/reset', [App\Http\Controllers\Staff\Auth\ResetPasswordController::class, 'reset'])->name('password.email');
  Route::get('/password/reset', [App\Http\Controllers\Staff\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.reset');
  Route::get('/password/reset/{token}', [App\Http\Controllers\Staff\Auth\ResetPasswordController::class, 'showResetForm']);

  Route::get('/home', [App\Http\Controllers\Staff\StaffController::class, 'index'])->name('home')->middleware(['auth:staff']);

  Route::get('/patient', [App\Http\Controllers\Staff\StaffController::class, 'patient'])->name('patient')->middleware(['auth:staff']);  
  Route::get('/allPatient', [App\Http\Controllers\Staff\StaffController::class, 'allPatient'])->name('allPatient')->middleware(['auth:staff']);  
  Route::post('/addPatient', [App\Http\Controllers\Staff\StaffController::class, 'addPatient'])->name('addPatient')->middleware(['auth:staff']);
  Route::get('/viewPatient/{slug}', [App\Http\Controllers\Staff\PatientController::class, 'viewPatient'])->name('viewPatient')->middleware(['auth:staff']);
  Route::post('/editPatient', [App\Http\Controllers\Staff\StaffController::class, 'editPatient'])->name('editPatient')->middleware(['auth:staff']);

  Route::get('/profile', [App\Http\Controllers\Staff\StaffController::class, 'profile'])->name('profile')->middleware(['auth:staff']);  
  Route::post('/updatePassword', [App\Http\Controllers\Staff\StaffController::class, 'updatePassword'])->name('updatePassword')->middleware(['auth:staff']); 
  Route::post('/updateStaff', [App\Http\Controllers\Staff\StaffController::class, 'updateStaff'])->name('updateStaff')->middleware(['auth:staff']);  
});


