<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'othername',
        'lastname',
        'email',
        'dob',
        'marital_status',
        'gender',
        'phone_number',
        'bloodgroup',
        'genotype',
        'allergies',
        'code',
    ];

    public function prescriptions() {
        return $this->hasMany(Prescription::class);
    }
     
    public function tests() {
        return $this->hasMany(Test::class);
    }
     
}


