@extends('admin.dashboard')

@section('content')

<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="new-patients main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Add new doctor</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="add-doctor.html">Add new doctor</a></li>
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
                                <form method="POST" action="{{ url('/admin/addStaff') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group row widget-3">
                                                <div class="col-lg-12">
                                                    <div class="form-input">
                                                        <label class="labeltest" for="image">
                                                            <span>Drop image here or click to upload.</span>
                                                        </label>
                                                        <input type="file" id="image" name="image" accept="image/*"
                                                            onchange="showPreview(event);">
                                                        <div class="preview">
                                                            <img id="file-ip-1-preview" src="#" alt="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="lastname"
                                                    placeholder="Last Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="othernames"
                                                    placeholder="Other Names">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone_number"
                                                    placeholder="Mobile No.">
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <select class="form-control form-select" name="gender">
                                                    <option>Choose A Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="dob"
                                                    placeholder="Date Of Birth">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-select" name="nationality">
                                                    <option>Nationality</option>
                                                    <option>Maroc</option>
                                                    <option>Algerier</option>
                                                    <option>Tunisie</option>
                                                    <option>Egypt</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-select" name="role" id="role" aria-label="Floating label select example">
                                                    <option value="" selected>Select Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" name="zipcode"
                                                        placeholder="Zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="form-group">
                                                <textarea class="form-control" name="bio" placeholder="Bio:"
                                                    rows="4"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit"
                                                    class="btn btn-primary float-end">Add Staff</button>
                                            </div>
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