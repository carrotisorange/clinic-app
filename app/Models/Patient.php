<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name', 
        'gender',
        'address',
        'birthate',
        'fathersname',
        'mothersname',
        'civilstatus',
        'education_attainment' 
    ];

    public function appointments()
    {
        return $this->hasMany('App\Appointment', 'patient_id_fk');
    }
}
