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
                    {{-- <div class="welcome-text">
                        <h4 class="text-primary">{{ $patient->lastname .' '. $patient->othernames }}</h4>
                    </div> --}}
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
                                    {{-- <div class="media align-self-start">
                                        <img alt="image" class="rounded-circle shadow" width="90"
                                            src="{{ asset('assets/images/patients/user1.jpg') }}">
                                        <div class="pulse-css"></div>
                                    </div> --}}
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
                <div class="col-lg-3 overflow-hidden">
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

            

            <!-- Tab Section -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="doctor-info-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-md-6" role="presentation">
                                <button class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info" aria-selected="true">Basic Information</button>
                            </li>
                            <li class="nav-item col-md-6" role="presentation">
                                <button class="nav-link" id="medical-history-tab" data-bs-toggle="tab" data-bs-target="#medical-history" type="button" role="tab" aria-controls="medical-history" aria-selected="false">Medical History</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!-- Basic Information -->
                            <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <ul>
                                            <li><strong>Lastname:</strong> {{ $patient->lastname }}</li>
                                            <li><strong>Othernames:</strong> {{ $patient->othernames }}</li>
                                            <li><strong>Email:</strong> {{ $patient->email }}</li>
                                            <li><strong>Date of Birth:</strong> {{ $patient->dob }}</li>
                                            <li><strong>Marital Status:</strong> {{ $patient->marital_status }}</li>
                                            <li><strong>Gender:</strong> {{ $patient->gender }}</li>
                                            <li><strong>Phone Number:</strong> {{ $patient->phone_number }}</li>
                                            <li><strong>Blood Group:</strong> {{ $patient->bloodgroup }}</li>
                                            <li><strong>Religion:</strong> {{ $patient->religion }}</li>
                                            <li><strong>Address:</strong> {{ $patient->address }}</li>
                                            <li><strong>Slug:</strong> {{ $patient->slug }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Medical History -->
                            <div class="tab-pane fade" id="medical-history" role="tabpanel" aria-labelledby="medical-history-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Session Modal -->
    <div class="modal fade" id="vitalSignsModal" tabindex="-1" role="dialog" aria-labelledby="vitalSignsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
               
            </div>
        </div>
    </div>
</div>

@endsection
