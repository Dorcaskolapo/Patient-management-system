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

use SweetAlert;
use Alert;

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

    // public function staff(){
    //     $staff = Staff::get();
    //     return view('admin.staff', [
    //         'staff' => $staff
    //     ]);
    // }

    public function staff(){

        $roles = Role::all();

        return view('admin.staff', [
            'roles' => $roles,
        ]);
    }

    public function addStaff(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if($request->password != $request->password_confirmation){
            alert()->error('Oops!', 'password mismatch')->persistent('Close');
            return redirect()->back();
        }

        $role = Role::all();

        $newStaff = ([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => $request->role,
        ]);

        if(Staff::create($newStaff)){
            alert()->success('Changes Saved', 'Staff added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }
}
