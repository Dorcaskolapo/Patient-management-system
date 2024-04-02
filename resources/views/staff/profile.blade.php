@extends('staff.layout.auth')
@php
    $staff = Auth::guard('staff')->user();
    $role = $staff->staffRole->role;
    
@endphp

@section('content')

<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="main_container">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Profile & Settings</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/staff/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/staff/profile') }}">Staff Profile</a>
                        </li>
                    </ol>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between doctor-info-details">
                                <div class="d-flex left-content">
                                    <div class="media align-self-start">
                                        <img alt="image" class="rounded-circle shadow" width="90"
                                            src="{{ asset($staff->image) }}">
                                        <div class="pulse-css"></div>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="mb-2">{{ $staff->lastname .' '. $staff->othernames}}</h2>
                                        <p class="mb-md-2 mb-sm-4 mb-2">{{ $staff->staffRole->role }}</p>
                                        <div class="star-review">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="doctor-info-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-md-6" role="presentation">
                                <button class="nav-link  active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">
                                    Short Biography
                                </button>
                            </li>
                            <li class="nav-item col-md-6" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Settings</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <p>{{ $staff->bio }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                aria-labelledby="contact-tab">
                                <div class="row m-t-30 m-l-0 m-r-0">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Personal Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form method="POST" action="{{ url('/admin/editStaff') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group row widget-3">
                                                                <div class="col-lg-12">
                                                                    <div class="form-input">
                                                                        <label class="labeltest" for="file-ip-1">
                                                                            <span>Drop image here or click to upload.</span>
                                                                        </label>
                                                                        <input type="file" id="file-ip-1" name="image" accept="image/*"  onchange="showPreview(event);">
                                                                        <div class="preview">
                                                                            @if(!$staff->image)
                                                                                <img id="file-ip-1-preview" src="{{ asset('uploads/staff/jolayemi-musa-ibrahim.jpg'.$staff->image) }}" alt="img">
                                                                            @else
                                                                                <img id="file-ip-1-preview" src="#" alt="img">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="row">
                                                            <img id="file-ip-1-preview" src="{{ asset($staff->image) }}" alt="img" width="90" height="50%">
                                                        </div> --}}
                                                        <div class="col-xl-4">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="lastname" value="{{ $staff->lastname}}">
                                                                <label for="lastname">Lastname</label>
                                                            </div>
                                                            <br>
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="othernames" value="{{ $staff->othernames}}">
                                                                <label for="othernames">Othernames</label>
                                                            </div>
                                                            <br>
                                                            <div class="form-floating">
                                                                <input type="email" class="form-control" name="email" value="{{ $staff->email}}">
                                                                <label for="email">Email</label>
                                                            </div>
                                                            <br>
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="phone_number" value="{{ $staff->phone_number}}">
                                                                <label for="phone_number">Phone Number(+234)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-floating">
                                                                <select class="form-control form-select" name="gender" value="{{ $staff->gender}}">
                                                                    <option>Choose A Gender</option>
                                                                    <option value="Female" @if($staff->gender == 'Female') selected @endif>Female</option>
                                                                    <option value="Male" @if($staff->gender == 'Male') selected @endif>Male</option>   
                                                                </select>
                                                                <label for="gender">Gender</label>
                                                            </div>
                                                            <br>
                                                            <div class="form-floating">
                                                                <input type="date" class="form-control" name="dob" value="{{ $staff->dob}}" >
                                                                <label for="dob">Date Of Birth</label>
                                                            </div>
                                                            <br>
                                                            <div class="form-floating">
                                                                <select class="form-control form-select" name="marital_status" value="{{ $staff->marital_status}}">
                                                                    <option>Select Marital Status</option>
                                                                    <option value="Single" @if($staff->marital_status == 'Single') selected @endif>Single</option>
                                                                    <option value="Married" @if($staff->marital_status == 'Married') selected @endif>Married</option>
                                                                    <option value="Divorced" @if($staff->marital_status == 'Divorced') selected @endif>Divorced</option>
                                                                    <option value="Widow" @if($staff->marital_status == 'Widow') selected @endif>Widow</option>
                                                                    <option value="Widower" @if($staff->marital_status == 'Widower') selected @endif>Widower</option>
                                                                </select>
                                                                <label for="marital_status">Marital Status</label>
                                                            </div>
                                                            <br>
                                                            <div class="form-floating">
                                                                <select class="form-control form-select" name="role">
                                                                    <option value="" @if($staff->role == '') selected @endif>Select Role</option>
                                                                    @foreach($roles as $role)
                                                                        <option value="{{ $role->id }}" @if($staff->role == $role->id) selected @endif>{{ $role->role }}</option>
                                                                    @endforeach
                                                                </select>                                                                                                        
                                                                <label for="role">Role</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="address" value="{{ $staff->address}}" >
                                                                <label for="address">Address</label>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col-xl-4">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="religion" value="{{ $staff->religion}}" >
                                                                <label for="religion">Religion</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                        </div>
                                                        <div class="col-xl-8">
                                                            <div class="form-floating">
                                                                <textarea class="form-control" name="bio">{{ $staff->bio }}</textarea>
                                                                <label for="bio">Bio</label>
                                                            </div>
                                                        </div>                                                                                                
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Change Password</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ url('staff/updatePassword') }}" method="POST">
                                                @csrf
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Old Password <span class="text-danger">*</span></label>
                                                            <input type="password" class="form-control" name="old_password" placeholder="Enter current password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                                                            <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-end">Submit</button>
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
</div>


</div>
<!-- End section content -->

@endsection