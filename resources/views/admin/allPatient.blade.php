@extends('admin.layout.dashboard')

@section('content')


    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="all-patients main_container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header fix-card">
                                <div class="row">
                                    <div class="col-8">
                                        <h4 class="card-title"> All Patients </h4>
                                    </div>
                                    <div class="col-4 float-end">
                                        <a href="{{ url('/admin/patient') }}" class="btn btn-primary float-end">New
                                            Patient</a>
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
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($patients as $patient)
                                                <tr>
                                                    {{-- <td scope="row">PAT-{{ $patient->id }}</td> --}}
                                                    <td scope="row">PAT-<?php echo sprintf("%03d", $patient->id); ?></td>
                                                    <td scope="row">{{ $patient->lastname }} </td>
                                                    <td scope="row">{{ $patient->othernames }}</td>
                                                    <td scope="row">{{ $patient->phone_number }}</td>
                                                    <td scope="row">{{ $patient->marital_status }}</td>
                                                    <td scope="row">
                                                        <a href="{{ url('/admin/viewPatient/'.$patient->slug) }}" class='mr-4 vue'>
                                                            <span class='fa fa-eye tbl-eye' aria-hidden='true'></span>
                                                        </a>
                                                        <a data-bs-toggle='modal' data-bs-target='#modal-edit-{{ $patient->id }}' class='mr-4'>
                                                            <span class='fas fa-pencil-alt tbl-edit'></span>
                                                        </a>
                                                        <a class='mr-4 delet' data-bs-toggle='modal' data-bs-target="#modal-delete-{{ $patient->id }}">
                                                            <span class='fas fa-trash-alt tbl-delet'></span>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!--Edit Modal -->
                                                <div class="modal fade" id="modal-edit-{{ $patient->id }}" tabindex="-1" aria-labelledby="modal-title-edit-row" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-title-edit-row">Edit Patient</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card">
                                                                                <div class="card-header">
                                                                                    <h4 class="card-title">Personal Information</h4>
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <div class="basic-form">
                                                                                        <form method="POST" action="{{ url('/admin/editPatient') }}" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <!-- Othernames -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="text" class="form-control" name="othernames" id="othernames" value="{{ $patient->othernames}}">
                                                                                                        <label for="othernames">Othernames</label>
                                                                                                    </div>
                                                                                                    <!-- Lastname -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $patient->lastname}}">
                                                                                                        <label for="lastname">Lastname</label>
                                                                                                    </div>
                                                                                                    <!-- Date of Birth -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="date" class="form-control" name="dob" id="dob" value="{{ $patient->dob}}">
                                                                                                        <label for="dob">Date Of Birth</label>
                                                                                                    </div>
                                                                                                    <!-- Marital Status -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <select class="form-control form-select" name="marital_status" id="marital_status">
                                                                                                            <option>Select Marital Status</option>
                                                                                                            <option value="Single" @if($patient->marital_status == 'Single') selected @endif>Single</option>
                                                                                                            <option value="Married" @if($patient->marital_status == 'Married') selected @endif>Married</option>
                                                                                                            <option value="Divorced" @if($patient->marital_status == 'Divorced') selected @endif>Divorced</option>
                                                                                                            <option value="Widow" @if($patient->marital_status == 'Widow') selected @endif>Widow</option>
                                                                                                            <option value="Widower" @if($patient->marital_status == 'Widower') selected @endif>Widower</option>

                                                                                                        </select>
                                                                                                        <label for="marital_status">Marital Status</label>
                                                                                                    </div>
                                                                                                    <!-- Gender -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <select class="form-control form-select" name="gender" id="gender">
                                                                                                            <option>Choose A Gender</option>
                                                                                                            <option value="Female" @if($patient->gender == 'Female') selected @endif>Female</option>
                                                                                                            <option value="Male" @if($patient->gender == 'Male') selected @endif>Male</option>                                                                                                            
                                                                                                        </select>
                                                                                                        <label for="gender">Gender</label>
                                                                                                    </div>
                                                                                                    <!-- Phone Number -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ $patient->phone_number}}">
                                                                                                        <label for="phone_number">Phone Number(+234)</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <!-- Address -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="text" class="form-control" name="address" id="address" value="{{ $patient->address}}">
                                                                                                        <label for="address">Address</label>
                                                                                                    </div>
                                                                                                
                                                                                                    <!-- Religion -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="text" class="form-control" name="religion" id="religion" value="{{ $patient->religion}}">
                                                                                                        <label for="religion">Religion</label>
                                                                                                    </div>
                                                                                                    <!-- Blood Group -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <select class="form-control form-select" name="bloodgroup" id="bloodgroup">
                                                                                                            <option value="" @if($patient->bloodgroup == '') selected @endif>Select Blood Group</option>
                                                                                                            @foreach($bloodgroups as $bloodgroup)
                                                                                                                <option value="{{ $bloodgroup->id }}" @if($patient->bloodgroup == $bloodgroup->id) selected @endif>{{ $bloodgroup->bloodgroup }}</option>
                                                                                                            @endforeach
                                                                                                        </select>                                                                                                        
                                                                                                        <label for="bloodgroup">Blood Group</label>
                                                                                                    </div>
                                                                                                    <!-- Genotype -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <select class="form-control form-select" name="genotype" id="genotype">
                                                                                                            <option value="" @if($patient->genotype == '') selected @endif>Select Genotype</option>
                                                                                                            @foreach($genotypes as $genotype)
                                                                                                                <option value="{{ $genotype->id }}" @if($patient->genotype == $genotype->id) selected @endif>{{ $genotype->genotype }}</option>
                                                                                                            @endforeach
                                                                                                        </select>                                                                                                        
                                                                                                        <label for="genotype">Genotype</label>
                                                                                                    </div>
                                                                                                    <!-- Allergies -->
                                                                                                    <div class="form-floating mb-3">
                                                                                                        <input type="text" class="form-control" name="allergies" id="allergies" value="{{ $patient->allergies}}">
                                                                                                        <label for="allergies">Allergies (If any)</label>
                                                                                                    </div>
                                                                                                    <!-- Code -->
                                                                                                    {{-- <input type="hidden" name="code" value="PAT{{ $newPatient->id }}"> --}}
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                                                    </div>
                                                </div>
                                                <!--End Modal -->


                                                <!-- Modal for Delete Test -->
                                                <div class="modal fade" id="modal-delete-{{ $patient->id }}" tabindex="-1" aria-labelledby="modal-title-delete-row" aria-hidden="true">
                                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-title-delete-row">Delete Patient</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ url('/admin/deletePatient') }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p class="text-center">Are you sure you want to delete "{{ $patient->lastname.' '.$patient->othernames }}"?</p>
                                                                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>""
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- End section content -->
</div>
@endsection