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

    //STAFF IMFORMATION UPDATE
    public function updateStaff(Request $request)
    {
        if(!empty($request->staff_id) && !$staff = Staff::find($request->staff_id)){
            alert()->error('Oops', 'Invalid Staff Information')->persistent('Close');
            return redirect()->back();
        }


        $slug = $staff->slug;
        if(!empty($request->lastname) && $request->lastname != $staff->lastname){
            $staff->lastname = $request->lastname;
            $staff->othernames = $request->othernames;
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lastname.'-', $request->othernames)));
            $staff->slug = $slug;
        }

        if(!empty($request->staffId) && $request->staffId != $staff->staffId){
            $staff->staffId = $request->staffId;
        }

        if(!empty($request->email) && $request->email != $staff->email){
            $staff->email = $request->email;
        }

        if(!empty($request->password) && $request->password != $staff->password){
            $staff->password = $request->password;
        }

        if(!empty($request->phone_number) && $request->phone_number != $staff->phone_number){
            $staff->phone_number = $request->phone_number;
        }

        if(!empty($request->address) && $request->address != $staff->address){
            $staff->address = $request->address;
        }

        if(!empty($request->role) && $request->role != $staff->role){
            $staff->role = $request->role;
        }

        if(!empty($request->bio) && $request->bio != $staff->bio){
            $staff->bio = $request->bio;
        }

        if(!empty($request->marital_status) && $request->marital_status != $staff->marital_status){
            $staff->marital_status = $request->marital_status;
        }

        if(!empty($request->religion) && $request->religion != $staff->religion){
            $staff->religion = $request->religion;
        }

        if(!empty($request->gender) && $request->gender != $staff->gender){
            $staff->gender = $request->gender;
        }

        if(!empty($request->dob) && $request->dob != $staff->dob){
            $staff->dob = $request->dob;
        }
       

        if($request->has('password') && !empty($request->password)){
            if($request->password == $request->confirm_password){
                $password = bcrypt($request->password);
            }else{
                alert()->error('Oops!', 'Password mismatch')->persistent('Close');
                return redirect()->back();
            }
            $staff->password = $password;
        }

        if ($request->hasFile('image')) {
            $imageUrl = 'uploads/staff/' . $slug . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $request->file('image')->move('uploads/staff', $imageUrl);
            $staff->image = $imageUrl; 
        }

        if ($staff->save()) {
            alert()->success('Changes Saved', 'Staff details updated successfully')->persistent('Close');
            return redirect()->back();
        }
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

    //PATIENT LOGIC
    public function patient(){
        $genotypes = Genotype::all();
        $bloodgroups = Bloodgroup::all();
        return view('staff.patient',[
            'genotypes' => $genotypes,
            'bloodgroups' => $bloodgroups,
        ]);
    }


    //PROFILE LOGIC
    public function profile(){
        $roles = Role::all();
        return view('staff.profile',[
            'roles' => $roles,
        ]);
    }

    //PATIENT CREATION LOGIC
    public function addPatient(Request $request){

        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'othernames' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'bloodgroup' => 'required',
            'genotype' => 'required',
            'allergies' => 'nullable',
        ]);
        

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lastname.'-'.$request->othernames)));
        $allergies = $request->filled('allergies') ? $request->allergies : 'None';

        $newPatient = ([
            'lastname' => $request->lastname,
            'othernames' => $request->othernames,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'dob' => $request->dob,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'bloodgroup' =>  $request->bloodgroup,
            'genotype' =>  $request->genotype,
            'allergies' => $allergies,
            'slug' => $slug,
        ]);

        if(Patient::create($newPatient)){
            alert()->success('Changes Saved', 'Patient added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }
}
