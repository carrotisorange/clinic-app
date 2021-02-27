<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    $appointments = DB::table('appointments')
                   ->join('patients', 'patient_id_fk', 'patient_id')
                   ->join('doctors', 'doctor_id_fk', 'doctor_id')        
                   ->get();

    $doctors = Doctor::all();

    $accounts = User::all();

    $patients = Patient::all();
  
    return view('dashboard', compact('appointments', 'doctors', 'accounts', 'patients'));
})->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
  
    return view('auth.login');
})->middleware(['auth']);


require __DIR__.'/auth.php';

//routes for patients record
Route::get('/patients-record', 'PatientController@index')->middleware(['auth']);
Route::post('/patient/store', 'PatientController@store')->middleware(['auth']);
Route::get('/patient/{patient_id}', 'PatientController@edit')->middleware(['auth']);
Route::put('/patient/{patient_id}/update', 'PatientController@update')->middleware(['auth']);

//routes for doctors
Route::get('/doctors', 'DoctorController@index')->middleware(['auth']);

//routes for medicines
Route::get('/medicine-inventory', 'MedicineController@index')->middleware(['auth']);

//routes for appointments
Route::get('/patients-appointments', 'AppointmentController@index')->middleware(['auth']);

//routes for accounts
Route::get('/manage-accounts', function(){

    Session::put('selected', 'manage-accounts');

    $users = User::all();

    return view('manage-accounts.index', compact('users'));
})->middleware(['auth']);


//routes for the user's profile
Route::get('/profile/{account_id}', function($account_id){

     $account = User::findOrFail($account_id);

    return view('manage-accounts.show', compact('account'));
})->middleware(['auth']);

//routes for the updating user's profile
Route::put('/profile/{account_id}/update', function(Request $request, $account_id){

 if($request->password === null){
    $account = User::findOrFail($account_id);
    $account->name = $request->name;
    $account->email = $request->email;
    $account->save();

    return redirect()->back()->with('success', 'Changes saved.');

 }else{
    $account = User::findOrFail($account_id);
    $account->name = $request->name;
    $account->email = $request->email;
    $account->password = Hash::make($request->password);
    $account->save();

    Auth::logout();
 
    $request->session()->flash('status', 'Changes saved.');

    return redirect()->back()->with('success', 'Changes saved.');
 }
   
  
})->middleware(['auth']);





