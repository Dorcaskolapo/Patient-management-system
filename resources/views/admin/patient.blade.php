@extends('admin.layout.auth')

@section('content')

<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="new-patients main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Add Patient</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/patient') }}">Add Patient</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Personal Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ url('/admin/addPatient') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Othernames -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="othernames" id="othernames" placeholder="">
                                                <label for="othernames">Othernames</label>
                                            </div>
                                            <!-- Lastname -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="">
                                                <label for="lastname">Lastname</label>
                                            </div>
                                            <!-- Date of Birth -->
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" name="dob" id="dob" placeholder="">
                                                <label for="dob">Date Of Birth</label>
                                            </div>
                                            <!-- Marital Status -->
                                            <div class="form-floating mb-3">
                                                <select class="form-control form-select" name="marital_status" id="marital_status">
                                                    <option>Select Marital Status</option>
                                                    <option>Single</option>
                                                    <option>Married</option>
                                                    <option>Divorced</option>
                                                    <option>Widow</option>
                                                    <option>Widower</option>
                                                </select>
                                                <label for="marital_status">Marital Status</label>
                                            </div>
                                            <!-- Gender -->
                                            <div class="form-floating mb-3">
                                                <select class="form-control form-select" name="gender" id="gender">
                                                    <option>Choose A Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                                <label for="gender">Gender</label>
                                            </div>
                                            <!-- Phone Number -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="">
                                                <label for="phone_number">Phone Number(+234)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Address -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="address" id="address" placeholder="">
                                                <label for="address">Address</label>
                                            </div>
                                        
                                            <!-- Religion -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="religion" id="religion" placeholder="">
                                                <label for="religion">Religion</label>
                                            </div>
                                            <!-- Blood Group -->
                                            <div class="form-floating mb-3">
                                                <select class="form-control form-select" name="bloodgroup" id="bloodgroup">
                                                    <option value="" selected>Select Bloodgroup</option>
                                                    @foreach($bloodgroups as $bloodgroup)
                                                        <option value="{{ $bloodgroup->id }}">{{ $bloodgroup->bloodgroup }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="bloodgroup">Bloodgroup</label>
                                            </div>
                                            <!-- Genotype -->
                                            <div class="form-floating mb-3">
                                                <select class="form-control form-select" name="genotype" id="genotype">
                                                    <option value="" selected>Select Genotype</option>
                                                    @foreach($genotypes as $genotype)
                                                        <option value="{{ $genotype->id }}">{{ $genotype->genotype }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="genotype">Genotype</label>
                                            </div>
                                            <!-- Allergies -->
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="allergies" id="allergies" placeholder="">
                                                <label for="allergies">Allergies (If any)</label>
                                            </div>
                                            <!-- Code -->
                                            {{-- <input type="hidden" name="code" value="PAT{{ $newPatient->id }}"> --}}
                                        </div>
                                    </div>
                                    <div class="form-group text-right mt-4">
                                        <button type="submit" class="btn btn-primary">Add Patient</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End section content -->

@endsection
