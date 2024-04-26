<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'staff_id',
        'symptoms',
        'status',
        'slug',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function vitals(){
        return $this->hasMany(Vital::class, 'session_id', 'id');
    }
}
