<?php

namespace App\Models;

use App\Notifications\StaffResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Authenticatable
{
    protected $table = 'staff';
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
        'othernames', 
        'email', 
        'password',
        'role',
        'image',
        'phone_number',
        'address',
        'dob',
        'religion',
        'marital_status',
        'gender',
        'bio',
        'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StaffResetPassword($token));
    }

    public function staffRole() {
        return $this->belongsTo(Role::class, 'role');
    }

}
