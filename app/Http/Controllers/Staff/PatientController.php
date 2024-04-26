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
use Carbon\Carbon;

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
use App\Models\Vital;
use App\Models\Session;

class PatientController extends Controller
{
    //

    //STAFF TO PATIENT VIEW LOGIC
    public function viewPatient($slug){
        $patient = Patient::with('sessions')->where('slug', $slug)->firstOrFail();

        $vitals = $patient->vitals;
        return view('staff.viewPatient',[
            'patient' => $patient,
            'vitals' => $vitals,
        ]);
    }

    //ADD VITALS 
    public function addVitals(Request $request){

        $validator = Validator::make($request->all(), [
            'body_temperature' => 'required',
            'pulse_rate' => 'required',
            'respiration_rate' => 'required',
            'blood_pressure_systolic' => 'required',
            'blood_pressure_diastolic' => 'required',
            'notes' => 'required',
        ]);
        

        if($validator->fails()) {
            alert()->error('Error', $validator->messages()->all()[0])->persistent('Close');
            return redirect()->back();
        }

        $newVital = ([
            'patient_id' => $request->patient_id,
            'session_id' => $request->session_id,
            'body_temperature' => $request->body_temperature,
            'pulse_rate' => $request->pulse_rate,
            'respiration_rate' => $request->respiration_rate,
            'blood_pressure_systolic' => $request->blood_pressure_systolic,
            'blood_pressure_diastolic' => $request->blood_pressure_diastolic,
            'notes' => $request->notes,
        ]);

        if(Vital::create($newVital)){
            alert()->success('Changes Saved', 'Vitals added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }



    //ADD SESSION 
    public function createSession(Request $request){
        $patient = Patient::where('id', $request->patient_id)->firstOrFail();
        $uuid = $patient->lastname.' '.$patient->othernames.' '.Carbon::now();
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $uuid)));

        $newSession = ([
            'patient_id' => $request->patient_id,
            'staff_id' => $request->staff_id,
            'slug' => $slug,
            'symptoms' => $request->symptoms,
            'status' => 'Under Treatment',
        ]);

        if(Session::create($newSession)){
            alert()->success('Changes Saved', 'Session added successfully')->persistent('Close');
            return redirect()->back();
        }

        alert()->error('Oops!', 'Something went wrong')->persistent('Close');
        return redirect()->back();
    }

    // //ALL SESSION
    // public function allSession() {
    //     $allSessions = Session::orderBy('created_at', 'desc')->get();
    
    //     return view('viewPatient/{slug}', ['allSessions' => $allSessions]);
    // }



    // public function allSession() {
    //     $allSessions = Session::latest()->get();
    //     return view('staff.viewPatient', [
    //         'allSessions' => $allSessions,
    //     ]);
    // }

    public function fetchPatientSessions($patient_id) {
        $sessions = Session::where('patient_id', $patient_id)->orderBy('created_at', 'desc')->get();
    
        return view('staff.viewPatient', [
            'sessions' => $sessions
        ]);
    }
}
