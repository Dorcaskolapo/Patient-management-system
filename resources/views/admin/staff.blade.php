@extends('admin.dashboard')

@section('content')
<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="new-patients main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Add New Staff</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/staff') }}">Add New Staff</a></li>
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
                                <form role="form" method="POST" action="{{ url('/admin/addStaff') }}">
                                    @csrf
                                    {{-- <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group row widget-3">
                                                <div class="col-lg-12">
                                                    <div class="form-input">
                                                        <label class="labeltest" for="file-ip-1">
                                                            <span> Drop image here or click to upload. </span>
                                                        </label>
                                                        <input type="file" id="file-ip-1" accept="image/*"
                                                            onchange="showPreview(event);">
                                                        <div class="preview">
                                                            <img id="file-ip-1-preview" src="#" alt="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Enter staff name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Mobile No.">
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <select class="form-control form-select" name="gender">
                                                    <option>Choose A Gender</option>
                                                    <option>Female</option>
                                                    <option>Male</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <select class="form-control form-select" name="role">
                                                    <option value="" selected>Select Staff Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-8">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Address" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary float-end">Add
                                                Staff</button>
                                        </div>
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