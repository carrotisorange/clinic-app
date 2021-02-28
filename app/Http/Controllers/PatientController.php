<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Session;
use DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::put('selected', 'patients-record');

        Session::put('search', $request->search);

        if($request->search == null){
            $patients = Patient::all();
        }else{
            $patients = DB::table('patients')
            ->whereRaw("concat(name, ' ', contact_number) like '%$request->search%' ")
            ->get(); 
        }  

        return view('patients-record.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient_id =  DB::table('patients')->insertGetId([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'civil_status' => $request->civil_status,
            'contact_number' => $request->contact_number,
            'fathers_name' => $request->fathers_name,
            'mothers_name' => $request->mothers_name,
            'educational_attainment' => $request->educational_attainment
        ]);

        return redirect('/patient/'.$patient_id)->with('success', 'Patient added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        
        $doctors = Doctor::all();

        $appointments =  DB::table('appointments')
        ->join('patients', 'patient_id_fk', 'patient_id')
        ->join('doctors', 'doctor_id_fk', 'doctor_id')
        ->select('*', 'doctors.name as doctor_name', 'patients.name as patient_name')
        ->where('patient_id', $patient_id)
        ->orderBy('appointment_id', 'desc')
        ->get();


        return view('patients-record.edit', compact('patient', 'doctors','appointments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $patient->name=$request->name;
        $patient->gender=$request->gender;
        $patient->birthdate=$request->birthdate;
        $patient->address=$request->address;
        $patient->contact_number=$request->contact_number;
        $patient->fathers_name=$request->fathers_name;
        $patient->mothers_name=$request->mothers_name;
        $patient->civil_status=$request->civil_status;
        $patient->educational_attainment=$request->educational_attainment;
        $patient->save();

        return redirect()->back()->with('success', 'Changes saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
