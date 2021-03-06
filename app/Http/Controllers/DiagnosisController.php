<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Stock;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Auth;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $patient_id, $appointment_id)
    {

        $diagnosis = new Diagnosis();
        $diagnosis->appointment_id_fk = $appointment_id;
        $diagnosis->symptoms = $request->symptoms;
        $diagnosis->temperature = $request->temperature;
        $diagnosis->blood_pressure = $request->blood_pressure;
        $diagnosis->weight = $request->weight;
        $diagnosis->height = $request->height;
        $diagnosis->save();
      
        for ($i=1; $i < $request->no_of_bills; $i++) { 

            $bill = new Prescription();
            $bill->appointment_id_fk = $appointment_id;
            $bill->medicine_id_fk = $request->input('medicine'.$i);
            $bill->qty = $request->input('qty'.$i);
            $bill->note = $request->note;
            $bill->save();

            $medicine = Medicine::findOrFail($request->input('medicine'.$i));
            $medicine->quantity = $medicine->quantity-$request->input('qty'.$i);
            $medicine->save();

            $stock = new Stock();
            $stock->medicine_id_fk = $request->input('medicine'.$i);
            $stock->user_id_fk = Auth::user()->id;
            $stock->qty_changed = $request->input('qty'.$i);
            $stock->desc = $request->input('qty'.$i).' stock is removed to the inventory.';
            $stock->save();
    
        }

        

        return back()->with('success', 'Diagnosis added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
        //
    }
}
