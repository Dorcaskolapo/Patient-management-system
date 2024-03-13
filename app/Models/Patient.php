<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}


