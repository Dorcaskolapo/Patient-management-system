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
                        <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ url('/admin/staff') }}">Add new doctor</a></li>
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
                                <form action="{{ url('/admin/addStaff') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group row widget-3">
                                                <div class="col-lg-12">
                                                    <div class="form-input">
                                                        <label class="labeltest" for="image">
                                                            <span> Drop image here or click to upload. </span>
                                                        </label>
                                                        <input type="file" id="image" name="image" accept="image/*" onchange="showPreview(event);">
                                                        <div class="preview">
                                                            <img id="image-preview" src="#" alt="img">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="First Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone_number" placeholder="Mobile No.">
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
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="date_of_birth" placeholder="Date Of Birth">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-select" name="languages">
                                                    <option>Languages</option>
                                                    <option>Arabic</option>
                                                    <option>English</option>
                                                    <option>French</option>
                                                    <option>German</option>
                                                </select>
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <select class="form-control form-select" name="city">
                                                        <option>City</option>
                                                        <option>Rabat</option>
                                                        <option>Kenitra</option>
                                                        <option>Casablanca</option>
                                                        <option>Marakesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <input type="text" class="form-control" name="zip" placeholder="Zip">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="form-group">
                                                <select class="form-control" name="role">
                                                    <option>User role</option>
                                                    <option>Surgery</option>
                                                    <option>Gastroenterologist</option>
                                                    <option>Endocrinologist</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <textarea class="form-control" name="address" placeholder="Address" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="form-group">
                                                <textarea class="form-control" name="bio" placeholder="Bio:" rows="4"></textarea>
                                            </div>
                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary float-end">add doctor</button>
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

<script>
    function showPreview(event) {
        var image = document.getElementById('image-preview');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

@endsection