<?php

namespace App\Http\Controllers\Staff;

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
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Role;
use App\Models\Staff;
use App\Models\Test;
use App\Models\Genotype;
use App\Models\Bloodgroup;

class StaffController extends Controller
{
    //
    public function index(){

        return view('staff.home');
    }

    //STAFF PASSWORD CHANGE
    public function updatePassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required', // Add validation for old_password
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
    
        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->first())->persistent('Close');
            return redirect()->back();
        }
    
        $staff = Auth::guard('staff')->user();
    
        if ($request->has('case')) {
            if ($request->password == $request->confirm_password) {
                $staff->password = bcrypt($request->password);
            } else {
                alert()->error('Oops!', 'Password mismatch')->persistent('Close');
                return redirect()->back();
            }
            $staff->change_password = true;
        } else {
            if (!Hash::check($request->old_password, $staff->password)) {
                alert()->error('Oops', 'Wrong old password, Try again with the right one')->persistent('Close');
                return redirect()->back();
            }
            if ($request->password == $request->confirm_password) {
                $staff->password = bcrypt($request->password);
            } else {
                alert()->error('Oops!', 'Password mismatch')->persistent('Close');
                return redirect()->back();
            }
        }
    
        if ($staff->update()) { // Use save() instead of update() to trigger events
            alert()->success('Success', 'Password Changed Successfully')->persistent('Close');
            return redirect()->back();
        }
    
        alert()->error('Oops!', 'An Error Occurred')->persistent('Close');
        return redirect()->back();
    }
    

    //ALLPATIENT LOGIC

    public function allPatient() {
        $patients = Patient::all();
        $newPatient = Patient::latest()->first();
        $bloodgroups = Bloodgroup::all();
        $genotypes = Genotype::all();
        return view('staff.allPatient', [
            'patients' => $patients,
            'genotypes' => $genotypes,
            'bloodgroups' => $bloodgroups,
            'newPatient' => $newPatient,
        ]);
    }

    public function viewPatient($slug){
        $patient = Patient::where('slug', $slug)->firstOrFail();
        return view('staff.viewPatient',[
            'patient' => $patient,
        ]);
    }

    //PROFILE LOGIC
    public function profile(){
        $roles = Role::all();
        return view('staff.profile',[
            'roles' => $roles,
        ]);
    }
}
