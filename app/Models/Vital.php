<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vital extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'body_temperature',
        'pulse_rate',
        'respiration_rate',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'notes',
        'session_id',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
