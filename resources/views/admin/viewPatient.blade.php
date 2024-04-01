@extends('admin.dashboard')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">patient</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                    <li class="breadcrumb-item active">patient</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4">
            <div class="bg-soft-primary">
                <div class="card-body pb-0 px-4">
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="row align-items-center g-3">
                                <div class="col-md-auto">
                                    <div class="avatar-md">
                                        <img src="{{ !empty($patient->image) ? asset($patient->image) : asset('assets/images/users/user-dummy-img.jpg') }}" alt="" class="img-thumbnail rounded-circle avatar-md">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div>
                                        <h4 class="fw-bold">{{$patient->patient_id}}</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div><i class="ri-building-line align-bottom me-1"></i> {{ $patient->lastname }}</div>
                                            <div class="vr"></div>
                                            <div>Level: <span class="fw-medium">{{ $patient->allergies }} Level</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="hstack gap-1 flex-wrap">
                                
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview" role="tab">
                                Overview
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- end card body -->
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-12">
        <div class="tab-content text-muted">
            <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <!-- ene col -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-4">
                                <div>
                                    <div class="flex-shrink-0 avatar-md mx-auto">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="{{empty($patient->image)?asset('assets/images/users/user-dummy-img.jpg'):asset($patient->image)}}" alt="" height="50" />
                                        </div>
                                    </div>
                                    {{-- <div class="mt-4 text-center">
                                        <h5 class="mb-1">{{$name}}</h5>
                                        <p class="text-muted">{{ $patient->programme->name }} <br>
                                            <strong>Matric Number:</strong> {{ $patient->matric_number }}<br>
                                            <strong>Jamb Reg. Number:</strong> {{ $patient->applicant->jamb_reg_no }}<br><br>
                                            <strong>Support Code:</strong> <span class="text-danger">ST{{ sprintf("%06d", $patient->id) }}</span> 
                                        </p>
                                        <p class="text-muted border-top border-top-dashed">
                                            <strong>Class:</strong> {{ $patient->degree_class }}<br>
                                            <strong>Standing:</strong> {{ $patient->standing }}<br>
                                        </p>
                                    </div> --}}
                                    <div class="table-responsive border-top border-top-dashed">
                                        <table class="table mb-0 table-borderless">
                                            <tbody>
                                                <tr>
                                                    <th><span class="fw-medium">Department:</span></th>
                                                    <td>{{ $patient->lastname }}</td>
                                                </tr>
                                                <tr>
                                                    <th><span class="fw-medium">Faculty:</span></th>
                                                    <td>{{ $patient->othernames }}</td>
                                                </tr>
                                                <tr>
                                                    <th><span class="fw-medium">Email:</span></th>
                                                    <td>{{ $patient->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th><span class="fw-medium">Contact No.:</span></th>
                                                    <td>{{ $patient->phone_number }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <th><span class="fw-medium">Address:</span></th>
                                                    <td>{!! $patient->applicant->address !!}</td>
                                                </tr> --}}
                                                {{-- <tr>
                                                    <th><span class="fw-medium">Address:</span></th>
                                                    <td>patient Care Office, {{ env('SCHOOL_NAME') }}</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-4"></div>
                </div>
                <!-- end row -->
            </div>
            <!-- end tab pane -->
        </div>
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection