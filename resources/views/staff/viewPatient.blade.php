@extends('staff.layout.dashboard')
@php
    $bloodgroup = $patient->bloodgroup;
@endphp
@section('content')
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
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between doctor-info-details">
                                <div class="d-flex left-content">
                                    <!-- <div class="media align-self-start">
                                        <img alt="image" class="rounded-circle shadow" width="90"
                                            src="{{ asset('assets/images/patients/user1.jpg') }}">
                                        <div class="pulse-css"></div>
                                    </div> -->
                                    <div class="media-body">
                                        <h2 class="mb-2">{{ $patient->lastname .' '. $patient->othernames}}</h2>
                                        <p class="mb-md-2 mb-sm-4 mb-2">PAT-<?php echo sprintf("%03d", $patient->id); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Session and End Session Buttons -->
                <div class="col-lg-3 overflow-hidden float-end">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <button class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#vitalSignsModal">Start Session</button>
                                </div>
                                <div class="col-sm-6 mb-2">
                                    <button class="btn btn-danger btn-block">End Session</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inserted Design Template -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header fix-card">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h4 class="card-title"> Medical History </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example1" class="display ">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>
                                                            <th scope="col">Last Name</th>
                                                            <th scope="col">Othernames</th>
                                                            <th scope="col">Mobile No.</th>
                                                            <th scope="col">Marital status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- @foreach($patients as $patient)
                                                            <tr>
                                                                <td scope="row">PAT-<?php echo sprintf("%03d", $patient->id); ?></td>
                                                                <td scope="row">{{ $patient->lastname }} </td>
                                                                <td scope="row">{{ $patient->othernames }}</td>
                                                                <td scope="row">{{ $patient->phone_number }}</td>
                                                                <td scope="row">{{ $patient->marital_status }}</td>
                                                                <td scope="row">
                                                                    <form method="GET" action="{{ url('/staff/viewPatient/'.$patient->slug) }}" class="mr-4 vue">
                                                                        <button type="submit" class="btn btn-primary float-end">
                                                                            <span class="fa fa-eye tbl-eye" aria-hidden="true"></span> View
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vital Modal -->
            <div class="modal fade" id="vitalSignsModal" tabindex="-1" role="dialog" aria-labelledby="vitalSignsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="vitalSignsModalLabel">Vital Signs</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ url('staff/addVitals') }}" id="vitalSignsForm">
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="vitalNextBtn">Next</button>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="testPrevBtn">Previous</button>
                                <button type="button" class="btn btn-primary" id="testNextBtn">Next</button>
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="prescriptionPrevBtn">Previous</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
   
        </div>
    </div>
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"></script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const vitalNextBtn = document.getElementById("vitalNextBtn");
        const testNextBtn = document.getElementById("testNextBtn");
        const prescriptionSubmitBtn = document.getElementById("prescriptionSubmitBtn");

        // Function to handle vital submission
        vitalNextBtn.addEventListener("click", function () {
            const vitalSignsForm = document.getElementById("vitalSignsForm");
            const formData = new FormData(vitalSignsForm);
            axios.post("{{ url('staff/addVitals') }}", formData)
                .then(function (response) {
                    console.log(response.data);
                    // Close the vital modal
                    $('#vitalSignsModal').modal('hide');
                    // Trigger opening the next modal if needed
                    $('#testModal').modal('show');
                })
                .catch(function (error) {
                    console.error(error);
                });
        });

        // Function to handle test submission
        testNextBtn.addEventListener("click", function () {
            const testForm = document.getElementById("testForm");
            const formData = new FormData(testForm);
            axios.post("{{ url('staff/addTests') }}", formData)
                .then(function (response) {
                    console.log(response.data);
                    // Close the test modal
                    $('#testModal').modal('hide');
                    // Trigger opening the next modal if needed
                    $('#prescriptionModal').modal('show');
                })
                .catch(function (error) {
                    console.error(error);
                });
        });

        // Function to handle prescription submission
        prescriptionSubmitBtn.addEventListener("click", function () {
            const prescriptionForm = document.getElementById("prescriptionForm");
            const formData = new FormData(prescriptionForm);
            axios.post("{{ url('staff/addPrescription') }}", formData)
                .then(function (response) {
                    console.log(response.data);
                    // Close the prescription modal
                    $('#prescriptionModal').modal('hide');
                    // Close modal or redirect user
                    $('#prescriptionModal').modal('hide');
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    });
</script>





@endsection
