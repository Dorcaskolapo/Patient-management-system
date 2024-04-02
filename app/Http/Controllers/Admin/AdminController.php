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
use App\Models\Genotype;
use App\Models\Bloodgroup;


class AdminController extends Controller
{
    //

    public function index(){

        return view('admin.dashboard');
    }


    public function prescription(){

        return view('admin.prescription');
    }

    //ALLPATIENT LOGIC

    public function allPatient() {
        $patients = Patient::all();
        $newPatient = Patient::latest()->first();
        $bloodgroups = Bloodgroup::all();
        $genotypes = Genotype::all();
        return view('admin.allPatient', [
            'patients' => $patients,
            'genotypes' => $genotypes,
            'bloodgroups' => $bloodgroups,
            'newPatient' => $newPatient,
        ]);
    }

    public function viewPatient($slug){
        $patient = Patient::where('slug', $slug)->firstOrFail();
        return view('admin.viewPatient',[
            'patient' => $patient,
        ]);
    }

    //Patient Logic
    public function patient(){
        $genotypes = Genotype::all();
        $bloodgroups = Bloodgroup::all();
        return view('admin.patient',[
            'genotypes' => $genotypes,
            'bloodgroups' => $bloodgroups,
        ]);
    }

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

    public function editPatient(Request $request)
    {
        if(!empty($request->patient_id) && !$patient = Patient::find($request->patient_id)){
            alert()->error('Oops', 'Invalid Patient Information')->persistent('Close');
            return redirect()->back();
        }

        $slug = $patient->slug;
        if(!empty($request->lastname) && $request->lastname != $patient->lastname){
            $patient->lastname = $request->lastname;
            $patient->othernames = $request->othernames;
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lastname.'-', $request->othernames)));
            $patient->slug = $slug;
        }

        if(!empty($request->patientId) && $request->patientId != $patient->patientId){
            $patient->patientId = $request->patientId;
        }

        if(!empty($request->phone_number) && $request->phone_number != $patient->phone_number){
            $patient->phone_number = $request->phone_number;
        }

        if(!empty($request->address) && $request->address != $patient->address){
            $patient->address = $request->address;
        }

        if(!empty($request->marital_status) && $request->marital_status != $patient->marital_status){
            $patient->marital_status = $request->marital_status;
        }

        if(!empty($request->religion) && $request->religion != $patient->religion){
            $patient->religion = $request->religion;
        }

        if(!empty($request->gender) && $request->gender != $patient->gender){
            $patient->gender = $request->gender;
        }

        if(!empty($request->dob) && $request->dob != $patient->dob){
            $patient->dob = $request->dob;
        }

        if(!empty($request->bloodgroup) && $request->bloodgroup != $patient->bloodgroup){
            $patient->bloodgroup = $request->bloodgroup;
        }

        if(!empty($request->genotype) && $request->genotype != $patient->genotype){
            $patient->genotype = $request->genotype;
        }

        if(!empty($request->allergies) && $request->allergies != $patient->allergies){
            $patient->allergies = $request->allergies;
        }

        if ($patient->save()) {
            alert()->success('Changes Saved', 'Patient details updated successfully')->persistent('Close');
            return redirect()->back();
        }
    }

    public function deletePatient(Request $request){
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$patient = Patient::find($request->patient_id)){
            alert()->error('Oops', 'Invalid Patient')->persistent('Close');
            return redirect()->back();
        }

        if($patient->delete()) {
            alert()->success('Deleted', 'Patient successfully deleted');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function billing(){

        return view('admin.billing');
    }



    //ALLSTAFF LOGIC

    public function allStaff() { 
        $staffs = Staff::all();
        $roles = Role::all();
        return view('admin.allStaff', [
            'staffs' => $staffs,
            'roles' => $roles
        ]);
    }

    //STAFF LOGIC

    public function staff(){

        $roles = Role::all();

        return view('admin.staff', [
            'roles' => $roles,
        ]);
    }


    public function addStaff(Request $request){
        $validator = Validator::make($request->all(), [
            'lastname' => 'required',
            'othernames' => 'required',
            'email' => 'required|unique:staff',
            'password' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'confirm_password' => 'required',
            'role' => 'required',
            'image' => 'required',
            'bio' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'marital_status' => 'required',
            'gender' => 'required',

        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if($request->password == $request->confirm_password){
            $password = bcrypt($request->password);
        }else{
            alert()->error('Oops!', 'Password mismatch')->persistent('Close');
            return redirect()->back();
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->lastname.'-'.$request->othernames)));
        $imageUrl = null;
        if($request->has('image')) {
            $imageUrl = 'uploads/staff/'.$slug.'.'.$request->file('image')->getClientOriginalExtension();
            $image = $request->file('image')->move('uploads/staff', $imageUrl);
        }
        $role = Role::all();

        $newStaff = ([
            'lastname' => $request->lastname,
            'othernames' => $request->othernames,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => $request->role,
            'bio' => $request->bio,
            'slug' => $slug,
            'image' => $imageUrl,
            'marital_status' => $request->marital_status,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);

        if(Staff::create($newStaff)){
            alert()->success('Changes Saved', 'Staff added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function editStaff(Request $request)
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

    public function deleteStaff(Request $request){
        $validator = Validator::make($request->all(), [
            'staff_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }
        if(!$staff = Staff::find($request->staff_id)){
            alert()->error('Oops', 'Invalid Staff ')->persistent('Close');
            return redirect()->back();
        }
        
        if($staff->delete()){
            alert()->success('Deleted Successfully', '')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back(); 
    }


    

    //DRUG LOGIC

    public function drug(){
        
        $drugs = Drug::all();

        return view('admin.drug', [
            'drugs' => $drugs,
        ]);
    }

    public function addDrug(Request $request){
        $validator = Validator::make($request->all(), [
            'trade_name' => 'required',
            'generic_name' => 'required',
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $newDrug = [
            'trade_name' => $request->trade_name,
            'generic_name' => $request->generic_name,
            'note' => $request->note,
        ];

        if (Drug::create($newDrug)) {
            alert()->success('Success', 'Drug added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Error', 'Failed to add drug')->persistent('Close');
        return redirect()->back();
    }

    public function editDrug(Request $request){
        $validator = Validator::make($request->all(), [
            'drug_id' => 'required',
        ]);
    
        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }
    
        if(!$drug = Drug::find($request->drug_id)){
            alert()->error('Oops', 'Invalid Drug')->persistent('Close');
            return redirect()->back();
        }
    
        if(!empty($request->trade_name) && $request->trade_name != $drug->trade_name){
            $drug->trade_name = $request->trade_name;
        }
    
        if(!empty($request->generic_name) && $request->generic_name != $drug->generic_name){
            $drug->generic_name = $request->generic_name;
        }
    
        if(!empty($request->note) && $request->note != $drug->note){
            $drug->note = $request->note;
        }
    
        if($drug->save()){
            alert()->success('Changes Saved', 'Drug changes saved successfully')->persistent('Close');
            return redirect()->back();
        }
    
        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function deleteDrug(Request $request){
        $validator = Validator::make($request->all(), [
            'drug_id' => 'required',
        ]);
    
        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }
    
        if(!$drug = Drug::find($request->drug_id)){
            alert()->error('Oops', 'Invalid Drug')->persistent('Close');
            return redirect()->back();
        }
    
        if($drug->delete()) {
            alert()->success('Deleted', 'Drug successfully deleted');
            return redirect()->back();
        }
    
        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }






    //TEST LOGIC

    public function test(){

        $tests = Test::all();

        return view('admin.test', [
            'tests' => $tests,
        ]);
    }

    public function addTest(Request $request){
        $validator = Validator::make($request->all(), [
            'test_name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $newTest = [
            'test_name' => $request->test_name,
            'description' => $request->description,
        ];

        if (Test::create($newTest)) {
            alert()->success('Success', 'Test added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Error', 'Failed to add test')->persistent('Close');
        return redirect()->back();
    }

    public function editTest(Request $request){
        $validator = Validator::make($request->all(), [
            'test_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$test = Test::find($request->test_id)){
            alert()->error('Oops', 'Invalid Test')->persistent('Close');
            return redirect()->back();
        }

        if(!empty($request->test_name) && $request->test_name != $test->test_name){
            $test->test_name = $request->test_name;
        }

        if(!empty($request->description) && $request->description != $test->description){
            $test->description = $request->description;
        }

        if($test->save()){
            alert()->success('Changes Saved', 'Test changes saved successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function deleteTest(Request $request){
        $validator = Validator::make($request->all(), [
            'test_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$test = Test::find($request->test_id)){
            alert()->error('Oops', 'Invalid Test')->persistent('Close');
            return redirect()->back();
        }

        if($test->delete()) {
            alert()->success('Deleted', 'Test successfully deleted');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }


    //GENOTYPE LOGIC

    public function genotype(){

        $genotypes = Genotype::all();

        return view('admin.genotype', [
            'genotypes' => $genotypes,
        ]);
    }

    public function addGenotype(Request $request){
        $validator = Validator::make($request->all(), [
            'genotype' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $newGenotype = [
            'genotype' => $request->genotype,
        ];

        if (Genotype::create($newGenotype)) {
            alert()->success('Success', 'Genotype added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Error', 'Failed to add genotype')->persistent('Close');
        return redirect()->back();
    }

    public function editGenotype(Request $request){
        $validator = Validator::make($request->all(), [
            'genotype_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$genotype = Genotype::find($request->genotype_id)){
            alert()->error('Oops', 'Invalid Genotype')->persistent('Close');
            return redirect()->back();
        }

        if(!empty($request->genotype) && $request->genotype != $genotype->genotype){
            $genotype->genotype = $request->genotype;
        }

        if($genotype->save()){
            alert()->success('Changes Saved', 'Genotype changes saved successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function deleteGenotype(Request $request){
        $validator = Validator::make($request->all(), [
            'genotype_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$genotype = Genotype::find($request->genotype_id)){
            alert()->error('Oops', 'Invalid Genotype')->persistent('Close');
            return redirect()->back();
        }

        if($genotype->delete()) {
            alert()->success('Deleted', 'Genotype successfully deleted');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    //BLOODGROUP LOGIC

    public function bloodgroup(){

        $bloodgroups = Bloodgroup::all();

        return view('admin.bloodgroup', [
            'bloodgroups' => $bloodgroups,
        ]);
    }

    public function addBloodgroup(Request $request){
        $validator = Validator::make($request->all(), [
            'bloodgroup' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $newBloodgroup = [
            'bloodgroup' => $request->bloodgroup,
        ];

        if (Bloodgroup::create($newBloodgroup)) {
            alert()->success('Success', 'Bloodgroup added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Error', 'Failed to add bloodgroup')->persistent('Close');
        return redirect()->back();
    }

    public function editBloodgroup(Request $request){
        $validator = Validator::make($request->all(), [
            'bloodgroup_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$bloodgroup = Bloodgroup::find($request->bloodgroup_id)){
            alert()->error('Oops', 'Invalid Bloodgroup')->persistent('Close');
            return redirect()->back();
        }

        if(!empty($request->bloodgroup) && $request->bloodgroup != $bloodgroup->bloodgroup){
            $bloodgroup->bloodgroup = $request->bloodgroup;
        }

        if($bloodgroup->save()){
            alert()->success('Changes Saved', 'Bloodgroup changes saved successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    public function deleteBloodgroup(Request $request){
        $validator = Validator::make($request->all(), [
            'bloodgroup_id' => 'required',
        ]);

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        if(!$bloodgroup = Bloodgroup::find($request->bloodgroup_id)){
            alert()->error('Oops', 'Invalid Bloodgroup')->persistent('Close');
            return redirect()->back();
        }

        if($bloodgroup->delete()) {
            alert()->success('Deleted', 'Bloodgroup successfully deleted');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }
}


