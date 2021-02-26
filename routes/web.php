<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/dashboard', function () {
    Session::put('selected', 'dashboard');
  
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

//routes for patients record
Route::get('/patients-record', 'PatientController@index')->middleware(['auth']);

//routes for doctors
Route::get('/doctors', 'DoctorController@index')->middleware(['auth']);

//routes for medicines
Route::get('/medicine-inventory', 'MedicineController@index')->middleware(['auth']);

//routes for appointments
Route::get('/patients-appointments', 'AppointmentController@index')->middleware(['auth']);

Route::get('/manage-accounts', function(){

    Session::put('selected', 'manage-accounts');

    $users = User::all();

    return view('manage-accounts.index', compact('users'));
})->middleware(['auth']);




