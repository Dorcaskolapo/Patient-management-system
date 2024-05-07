@extends('staff.layout.dashboard')
    @php
        $bloodgroup = $patient->bloodgroup;
        $staff = Auth::guard('staff')->user();
        $sessions = $patient->sessions()->orderBy('id', 'desc')->get();
        $role = $staff->staffRole->role;
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
                                <strong><p class="mb-md-2 mb-sm-4 mb-2">PAT-{{ sprintf("%03d", $patient->id) }}</p></strong>
                            </div>
                            @if($role == 'Doctor' || $role == 'Nurse')
                                <div class="card-body">
                                    <a class="btn btn-primary float-end"  data-bs-toggle="modal" data-bs-target="#addSessionModal">Add Session</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Medical History </h4>
                            </div>
                            <div class="accordion" id="accordionSessions">
                                @if($sessions->isEmpty())
                                    <div class="text-center">
                                        <strong><p class="text-centered">No sessions found.</p></strong>
                                    </div>
                                @else
                                    @foreach($sessions as $index => $session)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="sessionHeading{{ $index }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#sessionCollapse{{ $index }}" aria-expanded="true" aria-controls="sessionCollapse{{ $index }}">
                                                    <strong> Session created by {{ $session->staff ? $session->staff->lastname.' '.$session->staff->othernames : 'Admin' }} on {{ date("F j, Y, g:i a", strtotime($session->created_at)) }}</strong>
                                                </button>
                                                <hr>
                                                <div class="d-flex justify-content-end"> 
                                                    <span class="btn btn-info">{{ $session->status }}</span>
                                                </div>
                                            </h2>
                                            <div id="sessionCollapse{{ $index }}" class="accordion-collapse collapse show" aria-labelledby="sessionHeading{{ $index }}" data-bs-parent="#accordionSessions">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-lg-9">
                                                            <div>
                                                                <h5 class="mb-0 card-title">Symptoms</h5>
                                                                {!! $session->symptoms !!}
                                                            </div>
                                                            <hr>
                                                            <div>
                                                                <h5 class="mb-0 card-title">Vitals</h5>
                                                                @if(!empty($session->vitals))
                                                                   
                                                                    @foreach($session->vitals()->orderBy('id', 'desc')->get() as $vitals)
                                                                        <ul>
                                                                            <li>Temperature: {{ $vitals->body_temperature }}</li>
                                                                            <li>Pulse Rate: {{ $vitals->pulse_rate }}</li>
                                                                            <li>Blood Pressure: {{ $vitals->blood_pressure_systolic }}/{{ $vitals->blood_pressure_diastolic }}</li>
                                                                            <li>Notes: {!! $vitals->notes !!}</li>
                                                                        </ul>
                                                                    @endforeach
                                                                    
                                                                @endif
                                                            </div>
                                                            <hr>
                                                            <div>
                                                                <h5 class="mb-0 card-title">Tests</h5>
                                                                <div class="row">
                                                                    @if(!empty($session->testResults))
                                                                        @foreach($session->testResults()->orderBy('id', 'desc')->get() as $testResults)
                                                                            <div class="col-md-4 mb-4">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">Test Name: {{ $testResults->test_name }}</h5>
                                                                                        <img src="{{ asset($testResults->image) }}" alt="Test Image" class="card-img-top" width="100%" height="auto">
                                                                                        <p class="card-text">Summary: {{ $testResults->summary }}</p>
                                                                                    </div>
                                                                                    <div class="card-footer">
                                                                                        <div class="dropdown">
                                                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton_{{ $loop->index }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                Action
                                                                                            </button>
                                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $loop->index }}">
                                                                                                <a class="dropdown-item" href="#">Edit</a>
                                                                                                <a class="dropdown-item" href="#">View</a>
                                                                                                <a class="dropdown-item" href="#">Update</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                                                                                             
                                                            <hr>
                                                            <div>
                                                                <h5 class="mb-0 card-title">Prescriptions</h5>
                                                                @if(!empty($session->prescriptions))
                                                                    @foreach($session->prescriptions()->orderBy('id', 'desc')->get() as $prescriptions)
                                                                        <p>Prescription: {{ $prescriptions->prescription }}</p>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="d-flex flex-column align-items-center float-end">
                                                                @if($role == 'Doctor' || $role == 'Nurse')
                                                                    <a class="btn btn-primary btn-sm mb-1 w-100" data-bs-toggle="modal" data-bs-target="#updateSession{{ $session->id }}">Update Session</a>
                                                                    <a class="btn btn-danger btn-sm mb-1 w-100"  data-bs-toggle="modal" data-bs-target="#deleteSession{{ $session->id }}">Delete Session</a>
                                                                    <a class="btn btn-primary btn-sm mb-1 w-100"  data-bs-toggle="modal" data-bs-target="#addVitals">Add Vitals</a>
                                                                @endif

                                                                @if($role == 'Lab Technician')
                                                                    <a class="btn btn-primary btn-sm mb-1 w-100"  data-bs-toggle="modal" data-bs-target="#testResult">Add Test Results</a>
                                                                @endif

                                                                @if($role == 'Pharmacist')
                                                                    <a class="btn btn-primary btn-sm mb-1 w-100"  data-bs-toggle="modal" data-bs-target="#addPrescription">Add Prescription</a>
                                                                @endif

                                                                @if($role == 'Doctor' || $role == 'Nurse')
                                                                    <a class="btn btn-primary btn-sm mb-1 w-100"  data-bs-toggle="modal" data-bs-target="#updateStatus{{ $session->id }}">Update Status</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Update Session -->
                                        <div class="modal fade" id="updateSession{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="updateSession{{ $session->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateSession{{ $session->id }}Label">Update Session</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><b>Are you sure you want to update a session for {{ $patient->lastname .' '. $patient->othernames}}?</b></p>
                                                        <br>
                                                        <hr>
                                                        <form method="POST" action="{{ url('/staff/updateSession') }}">
                                                            @csrf
                                                            <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="symptoms{{ $session->id }}" class="form-label">Symptoms</label>
                                                                    <textarea class="form-control" id="symptoms{{ $session->id }}" name="symptoms" rows="5" cols="10">{{ $session->symptoms }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Delete Session -->
                                        <div class="modal fade" id="deleteSession{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteSession{{ $session->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteSessionModalLabel">Delete Session</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><b>Are you sure you want to delete a session for {{ $patient->lastname .' '. $patient->othernames}}?</b></p>
                                                        <br>
                                                        <hr>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form id="deleteSessionForm" method="POST" action="{{ url('/staff/deleteSession') }}">
                                                            @csrf
                                                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Update Session Status -->
                                        <div class="modal fade" id="updateStatus{{ $session->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStatus{{ $session->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateStatus{{ $session->id }}Label">Update Session Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ url('staff/updateSessionStatus') }}">
                                                            @csrf
                                                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Select Status</label>
                                                                <select class="form-select" id="status" name="status">
                                                                    <option>Select Status</option>
                                                                    <option value="Admitted">Admitted</option>
                                                                    <option value="Under Treatment">Under Treatment</option>
                                                                    <option value="Deceased">Deceased</option>
                                                                    <option value="Discharged">Discharged</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary float-end">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Vital Modal -->
                                        <div class="modal fade" id="addVitals" tabindex="-1" role="dialog" aria-labelledby="addVitals{{ $session->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addVitals{{ $session->id }}Label">Vital Signs</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ url('staff/addVitals') }}">
                                                            @csrf
                                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                            <input type="hidden" name="session_id" value="{{ isset($session) ? $session->id : '' }}">
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
                                                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Test Modal -->
                                        <div class="modal fade" id="testResult" tabindex="-1" role="dialog" aria-labelledby="testResult{{ $session->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="testResult{{ $session->id }}Label">Tests Result</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ url('staff/testResult') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                            <input type="hidden" name="session_id" value="{{ isset($session) ? $session->id : '' }}">
                                                            
                                                            <div class="mb-3">
                                                                <label for="test_name" class="form-label">Test Name</label>
                                                                <select class="form-select" id="test_name" name="test_name">
                                                                    <option value="">Select a Test</option>
                                                                    @foreach($tests as $test)
                                                                        <option>{{ $test->test_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">File (Image)</label>
                                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                            </div>
                                                            
                                                            <div class="mb-3">
                                                                <label for="summary" class="form-label">Summary</label>
                                                                <textarea class="form-control" id="summary" name="summary"></textarea>
                                                            </div>
                                                            
                                                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         <!-- Prescription Modal -->
                                        <div class="modal fade" id="addPrescription" tabindex="-1" role="dialog" aria-labelledby="addPrescription{{ $session->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addPrescription{{ $session->id }}Label">Prescription</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ url('staff/addPrescription') }}">
                                                            @csrf
                                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                            <input type="hidden" name="session_id" value="{{ isset($session) ? $session->id : '' }}">
                                                            <!-- Prescription Form Fields -->
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
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
