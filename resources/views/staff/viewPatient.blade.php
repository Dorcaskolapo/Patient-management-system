@extends('staff.layout.dashboard')
@php
    $bloodgroup = $patient->bloodgroup;
    $staff = Auth::guard('staff')->user();
    $sessions = $patient->sessions()->orderBy('id', 'desc')->get();
@endphp
@section('content')
<script src="https://cdn.tiny.cloud/1/ib771jqvt5joab026vosdy4bkhoad3hty1tycnv696zoka2w/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="main_container">
                <!-- Header Section -->
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <!-- <div class="welcome-text">
                            <h4 class="text-primary">{{ $patient->lastname .' '. $patient->othernames }}</h4>
                        </div> -->
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/staff/home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('/staff/profile') }}">Patient Profile</a></li>
                        </ol>
                    </div>
                </div>

                <!-- Patient Info Section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <h2 class="mb-2 card-title">{{ $patient->lastname .' '. $patient->othernames}}</h2>
                                <p class="mb-md-2 mb-sm-4 mb-2">PAT-{{ sprintf("%03d", $patient->id) }}</p>
                            </div>
                            <div class="card-body">
                                <a class="btn btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#addSessionModal">Add Session</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Medical History </h4>
                            </div>
                            <div class="card-body" style="overflow: auto;">
                                @if($sessions->isEmpty())
                                    <p>No sessions found.</p>
                                @else
                                    @foreach($sessions as $session)
                                        <div class="card mb-3 col-lg-12">
                                            <div class="card-header">
                                                <h5 class="mb-0 card-title">
                                                    Session created by {{ $session->staff->lastname.' '.$session->staff->othernames }} on {{ date("F j, Y, g:i a", strtotime($session->created_at)); }} ||  <span class="btn btn-primary mx-5 ">{{ $session->status }}</span>
                                                    <hr>
                                                    <div class="float-end justify-between ">
                                                        <a class="btn btn-primary mx-1"  data-bs-toggle="modal" data-bs-target="#deleteSession{{ $session->id }}">Add Session</a>
                                                        <a class="btn btn-primary mx-1"  data-bs-toggle="modal" data-bs-target="#updateSession">Add Session</a>
                                                        <a class="btn btn-primary mx-1"  data-bs-toggle="modal" data-bs-target="#addVitals">Add Session</a>
                                                        <a class="btn btn-primary mx-1"  data-bs-toggle="modal" data-bs-target="#addTest">Add Session</a>
                                                        <a class="btn btn-primary mx-1"  data-bs-toggle="modal" data-bs-target="#addPrescription">Add Session</a>
                                                        <a class="btn btn-primary mx-1"  data-bs-toggle="modal" data-bs-target="#updateStatus">Add Session</a>

                                                    </div>
                                                </h5>
                                            </div>
                                            <div class="card-body" style="height: 20px;">
                                                {!! $session->symptoms !!}
                                                <hr>
                                                <h5 class="mb-0 card-title">Vitals</h5>
                                                @if(!empty($session->vitals))
                                                
                                                    @foreach($session->vitals()->orderBy('id', 'desc')->get() as $vitals)
                                                    <p>Temperature: {{ $session->vitals }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vital Modal -->
                <div class="modal fade" id="addVitals" tabindex="-1" role="dialog" aria-labelledby="addVitals" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="vitalSignsModalLabel">Vital Signs</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('staff/addVitals') }}" id="vitalSignsForm">
                                    @csrf
                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                                    <div class="mb-3">
                                        <label for="body_temperature" class="form-label">Body Temperature (°C)</label>
                                        <input type="number" class="form-control" id="body_temperature" name="body_temperature" placeholder="Enter body temperature">
                                    </div>
                                    <div class="mb-3">
                                        <label for="pulse_rate" class="form-label">Pulse Rate (Beat Per Minute)</label>
                                        <input type="number" class="form-control" id="pulse_rate" name="pulse_rate" placeholder="Enter pulse rate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="respiration_rate" class="form-label">Respiration Rate (Breath Per Minute)</label>
                                        <input type="number" class="form-control" id="respiration_rate" name="respiration_rate" placeholder="Enter respiration rate">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <span><p>Blood Pressure (mmHg)</p></span>
                                        <div class="mb-3">
                                            <label for="blood_pressure_systolic" class="form-label">Systolic</label>
                                            <input type="number" class="form-control" id="blood_pressure_systolic" name="blood_pressure_systolic" placeholder="Enter blood pressure (systolic)">
                                        </div>
                                        <div class="mb-3">
                                            <label for="blood_pressure_diastolic" class="form-label">Diastolic</label>
                                            <input type="number" class="form-control" id="blood_pressure_diastolic" name="blood_pressure_diastolic" placeholder="Enter blood pressure (diastolic)">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Notes</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter notes"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Test Modal -->
                <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="testModalLabel">Tests</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('staff/addTests') }}" id="testForm">
                                    @csrf
                                    <!-- Tests Form Fields -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prescription Modal -->
                <div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="prescriptionModalLabel">Prescription</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ url('staff/addPrescription') }}">
                                    @csrf
                                    <!-- Prescription Form Fields -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Session -->
    <div class="modal fade" id="addSessionModal" tabindex="-1" aria-labelledby="addSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSessionModalLabel">Create Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center"><b>Are you sure you want to create a session for {{ $patient->lastname .' '. $patient->othernames}}?</b></p>
                    <br>
                    <hr>
                    <form method="POST" action="{{ url('/staff/createSession') }}">
                        @csrf
                        <input type="hidden" name="staff_id" value="{{ $staff->id }}" />
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}" />

                        <div>
                            <div>
                                <h4>Symptoms</h4>
                                <hr>
                                <textarea name="symptoms" class="form-control" id="symptoms" rows="5" cols="10"></textarea>
                            </div>
                        </div>
                        


                        <hr>
                        <button class="btn btn-primary btn-block float-end">Yes, Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
