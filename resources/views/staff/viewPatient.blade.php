@extends('staff.layout.dashboard')
@php
    $bloodgroup = $patient->bloodgroup;
    $staff = Auth::guard('staff')->user();
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
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between doctor-info-details">
                                <div class="d-flex left-content">
                                    <div class="media-body">
                                        <h2 class="mb-2">{{ $patient->lastname .' '. $patient->othernames}}</h2>
                                        <p class="mb-md-2 mb-sm-4 mb-2">PAT-{{ sprintf("%03d", $patient->id) }}</p>
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
                                <div class="col-md-12 mb-2">
                                    <button class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addSessionModal">Add Session</button>
                                </div>
                                {{-- <div class="col-sm-6 mb-2">
                                    <button class="btn btn-danger btn-block">End Session</button>
                                </div> --}}
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
                            {{-- <div class="modal-body">
                                <div class="btn-group d-flex" role="group" aria-label="Add Session Buttons">
                                    <button class="btn btn-primary flex-fill me-2" data-bs-toggle="modal" data-bs-target="#vitalSignsModal">Add Vitals</button>
                                    <button class="btn btn-primary flex-fill me-2">Add Test Results</button>
                                    <button class="btn btn-primary flex-fill">Add Prescriptions</button>
                                </div>
                            </div> --}}

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


                                {{-- <div class="row">
                                    <div class="col">
                                        <button class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#vitalSignsModal">Add Vitals</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-block">Add Test Results</button>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary btn-block">Add Prescriptions</button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vital Modal -->
            <div class="modal fade" id="vitalSignsModal" tabindex="-1" role="dialog" aria-labelledby="vitalSignsModalLabel" aria-hidden="true">
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

            {{-- <!-- Test Modal -->
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
            </div> --}}

            {{-- <!-- Prescription Modal -->
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
            </div> --}}


   
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to close the "Add Session" modal
        function closeAddSessionModal() {
            $('#addSessionModal').modal('hide');
        }

        // Event listeners for buttons inside the "Add Session" modal
        const addVitalsBtn = document.querySelector('[data-bs-target="#vitalSignsModal"]');
        const addPrescriptionBtn = document.querySelector('[data-bs-target="#prescriptionModal"]');
        const addTestBtn = document.querySelector('[data-bs-target="#testModal"]');

        addVitalsBtn.addEventListener("click", closeAddSessionModal);
        addPrescriptionBtn.addEventListener("click", closeAddSessionModal);
        addTestBtn.addEventListener("click", closeAddSessionModal);
    });
</script>


@endsection
