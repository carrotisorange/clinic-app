<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
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

    $appointments =  DB::table('appointments')
    ->join('patients', 'patient_id_fk', 'patient_id')
    ->join('doctors', 'doctor_id_fk', 'doctor_id')
    ->select('*', 'doctors.name as doctor_name', 'patients.name as patient_name')
    ->orderBy('appointment_id', 'desc')
    ->limit(5)
    ->get();

     $pending_appointments = Appointment::where("status", "pending")->count();

    $doctors = Doctor::all();

    $accounts = User::all();

    $patients = Patient::all();
  
    return view('dashboard', compact('appointments', 'doctors', 'accounts', 'patients', 'pending_appointments'));
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
Route::post('/doctor/store', 'DoctorController@store')->middleware(['auth']);

//routes for medicines
Route::get('/medicine-inventory', 'MedicineController@index')->middleware(['auth']);
Route::post('/medicine/store', 'MedicineController@store')->middleware(['auth']);
Route::get('/medicine/{medicine_id}/edit', 'MedicineController@edit')->middleware(['auth']);
Route::get('medicine/inventory', 'MedicineController@inventory');
Route::get('medicine/dashboard', 'MedicineController@dashboard');
Route::put('/medicine/{medicine_id}/update', 'MedicineController@update')->middleware(['auth']);

//routes for appointments
Route::get('/patients-appointments', 'AppointmentController@index')->middleware(['auth']);
Route::post('/patient/{patient_id}/appointment/store', 'AppointmentController@store')->middleware(['auth']);
Route::get('/patient/{patient_id}/appointment/{appointment_id}', 'AppointmentController@edit')->middleware(['auth']);
Route::get('/patient/{patient_id}/appointments/', 'AppointmentController@show')->middleware(['auth']);
Route::put('/patient/{patient_id}/appointment/{appointment_id}/update', 'AppointmentController@update')->middleware(['auth']);
Route::get('/patient/{patient_id}/appointment/{appointment_id}/export', 'AppointmentController@export')->middleware(['auth']);

//routes for patients diagnosis
Route::post('/patient/{patient_id}/appointment/{appointment_id}/diagnosis/store', 'DiagnosisController@store')->middleware(['auth']);

//routes for accounts
Route::get('/manage-accounts', function(){

    Session::put('selected', 'manage-accounts');

    $users = User::all();

    return view('manage-accounts.index', compact('users'));
})->middleware(['auth']);

Route::delete('/user/{user_id}', function($user_id){
    
    User::findOrFail($user_id)->delete();

    return back()->with('success', 'User is deleted successfully!');
})->middleware(['auth']);

Route::get('/user/{user_id}/edit', function($user_id){
    
    $user = User::findOrFail($user_id);

    return view('manage-accounts.edit', compact('user'));
})->middleware(['auth']);

Route::put('/user/{user_id}/update', function(Request $request, $user_id){

    if($request->password === null){
        $user =  User::find($user_id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->account_type=$request->account_type;
        $user->save();
    
        return redirect()->back()->with('success', 'Changes saved.');
    
     }else{
        $user =  User::find($user_id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->account_type=$request->account_type;
        $user->password = Hash::make($request->password);
        $user->save();
     }

    return back()->with('success','Changes saved.');

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





