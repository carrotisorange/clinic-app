<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'medicine_id';

    protected $fillable = [
        'brand',
        'name',
        'mg',
        'quantity',
        'expiration',
    ];

    public function stocks()
    {
        return $this->hasMany('App\Models\Medicine', 'medicine_id_fk');
    }
}
