@extends('admin.layout.dashboard')

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

<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="new-patients main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Add Staff</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/staff') }}">Add Staff</a></li>
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
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="">
                                                <label for="lastname">Lastname</label>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="othernames" id="othernames" placeholder="">
                                                <label for="othernames">Othernames</label>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="">
                                                <label for="email">Email</label>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="">
                                                <label for="phone_number">Phone Number(+234)</label>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-floating">
                                                <select class="form-control form-select" name="gender" id="gender">
                                                    <option>Choose A Gender</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                                <label for="gender">Gender</label>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <input type="date" class="form-control" name="dob" id="dob" placeholder="">
                                                <label for="dob">Date Of Birth</label>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <select class="form-control form-select" name="marital_status" id="marital_status">
                                                    <option>Marital Status</option>
                                                    <option>Single</option>
                                                    <option>Married</option>
                                                    <option>Divorced</option>
                                                    <option>Widow</option>
                                                    <option>Widower</option>
                                                </select>
                                                <label for="marital_status">Marital Status</label>
                                            </div>
                                            <br>
                                            <div class="form-floating">
                                                <select class="form-control form-select" name="role" id="role" aria-label="Floating label select example">
                                                    <option value="" selected>Select Role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
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
                                                <input type="text" class="form-control" name="address" id="address" placeholder="">
                                                <label for="address">Address</label>
                                            </div>
                                        </div>

                                        <br>
                                        
                                        <div class="col-xl-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="religion" id="religion" placeholder="">
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
                                                <textarea class="form-control" name="bio" id="bio" placeholder="" rows="4"></textarea>
                                                <label for="bio">Bio</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card-header">
                                            <h6 class="card-title">Authentication</h6>
                                        </div>
                                        <hr>
                                        <div class="col-xl-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                                                <label for="password">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="confirm-password" name="confirm_password" placeholder="">
                                                <label for="confirm-password">Confirm Password</label>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-primary float-end">Add Staff</button>
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
