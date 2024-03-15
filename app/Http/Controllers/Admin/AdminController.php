<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use App\Models\Billing;
use App\Models\Drug;
use App\Models\Admin;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Test;


class AdminController extends Controller
{
    //

    public function index(){

        return view('admin.dashboard');
    }

    public function staff(){
        $staff = Staff::get();
        return view('admin.staff', [
            'staff' => $staff
        ]);
    }
}
