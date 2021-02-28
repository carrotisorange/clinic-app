<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Diagnosis;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Session;
use DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('selected', 'patients-appointment');

        $appointments =  DB::table('appointments')
        ->join('patients', 'patient_id_fk', 'patient_id')
        ->join('doctors', 'doctor_id_fk', 'doctor_id')
        ->select('*', 'doctors.name as doctor_name', 'patients.name as patient_name')
   
        ->orderBy('appointment_id', 'desc')
        ->get();

       return view('patients-appointment.index', compact('appointments'));
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
    public function store(Request $request, $patient_id)
    {

        $appointment_id =  DB::table('appointments')->insertGetId([
            'patient_id_fk' => $patient_id,
            'doctor_id_fk' => $request->doctor_id,
            'date' => $request->date,
            'desc' => $request->desc,
        ]);

        return redirect('/patient/'.$patient_id.'/appointment/'.$appointment_id)->with('success', 'Appointment added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);

        $appointments =  DB::table('appointments')
        ->join('patients', 'patient_id_fk', 'patient_id')
        ->join('doctors', 'doctor_id_fk', 'doctor_id')
        ->select('*', 'doctors.name as doctor_name', 'patients.name as patient_name')
        ->where('patient_id', $patient_id)
        ->orderBy('appointment_id', 'desc')
        ->get();

        return view('patients-appointment.show', compact('appointments', 'patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($patient_id, $appointment_id)
    {
         $appointment = Appointment::findOrFail($appointment_id);

          $appointment_info =  DB::table('appointments')
         ->join('patients', 'patient_id_fk', 'patient_id')
         ->join('doctors', 'doctor_id_fk', 'doctor_id')
         ->select('*', 'doctors.name as doctor_name', 'patients.name as patient_name')
         ->where('appointment_id', $appointment_id)
         ->get();

         $patient = Patient::findOrFail($patient_id);

         $medicines = Medicine::all();

         $doctors = Doctor::all();

        $diagnosis = Appointment::findOrFail($appointment_id)->diagnosis;

        $prescriptions = Appointment::findOrFail($appointment_id)->prescriptions;
         

        return view('patients-appointment.edit', compact('appointment','appointment_info','patient', 'doctors', 'medicines', 'prescriptions', 'diagnosis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
        $appointment->doctor_id_fk = $request->doctor_id;
        $appointment->status = $request->status;
        $appointment->date = $request->date;
        $appointment->desc = $request->desc;
        $appointment->save();

        return back()->with('success', 'Changes saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
