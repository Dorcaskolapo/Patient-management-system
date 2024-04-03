@extends('staff.layout.dashboard')
@php
    $bloodgroup = $patient->bloodgroup;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Patient Information</div>

                <div class="card-body">
                    <!-- Display patient information here -->
                    <p><strong>Name:</strong> {{ $patient->lastname .' '. $patient->othernames }}</p>
                    <p><strong>Age:</strong> {{ $patient->age }}</p>
                    <p><strong>Gender:</strong> {{ $patient->gender }}</p>
                    <p><strong>Genotype:</strong> {{ $patient->genotype }}</p>
                    <p><strong>Bloodgroup:</strong> {{ $patient->bloodgroup }}</p>
                    <!-- Add more fields as needed -->

                    <!-- Add buttons or links to add prescription, test, and drug -->
                    <div class="mt-4">
                        <a href="#" class="btn btn-primary">Add Prescription</a>
                        <a href="#"  class="btn btn-primary">Add Test</a>
                        <a href="#" class="btn btn-primary">Add Drug</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
