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
        'title',
        'slug',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}