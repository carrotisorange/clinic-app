<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'patient_id_fk', 
        'doctor_id_fk', 
        'date', 
        'desc',
        'status',
    ];

    public function prescriptions()
    {
        return $this->hasMany('App\Models\Prescription', 'appointment_id_fk');
    }

    public function diagnosis()
    {
        return $this->hasMany('App\Models\Diagnosis', 'appointment_id_fk');
    }
}
