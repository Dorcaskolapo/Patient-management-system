<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'payment_method',
        'status',
        'amount',
        'invoice_title',
    ];

    public function prescriptions() {
        return $this->hasMany(Prescription::class);
    }
     
}
