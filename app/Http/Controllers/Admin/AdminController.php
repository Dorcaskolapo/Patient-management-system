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
    
    public function test(){

        $tests = Test::all();

        return view('admin.test', [
            'tests' => $tests,
        ]);
    }

    public function prescription(){

        return view('admin.prescription');
    }

    public function patient(){

        return view('admin.patient');
    }

    public function drug(){
        
        $drugs = Drug::all();

        return view('admin.drug', [
            'drugs' => $drugs,
        ]);
    }

    public function billing(){

        return view('admin.billing');
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


}
