@extends('admin.dashboard')

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
                                        <h4 class="card-title"> All Staffs </h4>
                                    </div>
                                    <div class="col-4 float-end">
                                        <a href="{{ url('/admin/staff') }}" class="btn btn-primary float-end">New
                                            Staff</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Last Name</th>
                                                <th>Othernames</th>
                                                <th>Email</th>
                                                <th>Mobile No.</th>
                                                <th>Marital status</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($staffs as $staff)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td><img class="rounded-circle" width="35" src="{{ asset($staff->image) }}" alt=""></td>
                                                    <td>{{ $staff->lastname }} </td>
                                                    <td>{{ $staff->othernames }}</td>
                                                    <td>{{ $staff->email }}</td>
                                                    <td>{{ $staff->phone_number }}</td>
                                                    <td>{{ $staff->marital_status }}</td>
                                                    <td>{{ $staff->staffRole->role }}</td>
                                                    <td>
                                                        <a data-bs-toggle='modal' data-bs-target='#modal-edit'
                                                            class='mr-4'>
                                                            <span class='fas fa-pencil-alt tbl-edit'></span>
                                                        </a>
                                                        <a class='mr-4 delet' data-bs-toggle='modal' data-bs-target="#modal-delete">
                                                            <span class='fas fa-trash-alt tbl-delet'></span>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!--Edit Modal -->
                                                <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-title-edit-row" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-title-edit-row">Edit Staff</h5>
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
                                                                                        <form method="POST" action="{{ url('/admin/editStaff') }}" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                                                                                            {{-- <div class="row">
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
                                                                                                </div> --}}
                                                                                                <div class="row">
                                                                                                    <img id="file-ip-1-preview" src="{{ asset($staff->image) }}" alt="img">
                                                                                                </div>
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
                                                                                                            <option value="Female">Female</option>
                                                                                                            <option value="Male">Male</option>
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
                                                                                                        <select class="form-control form-select" name="role" value="{{ $staff->role}}">
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
                                                                                                        <textarea class="form-control" name="bio" rows="4" value="{{ $staff->bio}}" ></textarea>
                                                                                                        <label for="bio">Bio</label>
                                                                                                    </div>
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


                                                <!--Delete Modal -->
                                                <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="modal-title-delete-row" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center p-5">
                                                                <div class="text-end">
                                                                    <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <h4 class="mb-3 mt-4">Are you sure you want to delete <br/> {{ $staff->lastname.' '.$staff->othernames }}?</h4>
                                                                    <form action="{{ url('/admin/deleteStaff') }}" method="POST">
                                                                        @csrf
                                                                        <input name="staff_id" type="hidden" value="{{$staff->id}}">
                                                                        <hr>
                                                                        <button type="submit" id="submit-button" class="btn btn-danger w-100">Yes, Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light p-3 justify-content-center">
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End section content -->


    <!-- start section footer -->
    <div class="footer ">
        <div class="copyright container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © {{ env('APP_NAME') }}.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Designed & Developed by {{ env('APP_AUTHOR') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End section footer -->

</div>

@endsection