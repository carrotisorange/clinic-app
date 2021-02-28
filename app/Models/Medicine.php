<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'medicine_id';

    protected $fillable = [
        'medicine_id',
        'name',
        'mg',
        'quantity',
        'expiration',
    ];
}
