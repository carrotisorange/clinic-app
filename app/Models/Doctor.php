<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 
        'name'
    ];

    public function patients()
    {
        return $this->hasMany('App\Appointment', 'doctor_id_fk');
    }
}
