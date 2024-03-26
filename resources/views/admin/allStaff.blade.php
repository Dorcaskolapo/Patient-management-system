@extends('admin.dashboard')

@section('content')

<!-- start section content -->
<div class="content-body">
    <div class="warper container-fluid">
        <div class="all-patients main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Doctors List</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="doctor-list.html">Doctors List</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-media list-doctors best-doctor">
                        <div class="timeline-row">
                            @foreach($staffs as $staff)
                                <div class="col-sm-6 col-lg-4">
                                    <div class="timeline-panel card p-4 mb-4">
                                        <div class="media">
                                            <img alt="image" src="{{ $staff->image }}"> <!-- Display image using URL from the database -->
                                        </div>
                                        <div class="media-body">
                                            <a href="#">
                                                <h4 class="mb-2">{{ $staff->lastname }} {{ $staff->othernames }}</h4> <!-- Display name -->
                                            </a>
                                            <p class="mb-2">{{ $staff->role }}</p> <!-- Display role -->
                                            
                                        </div>
                                        <div class="btn-group-style-1">
                                            <div class="btn-content">
                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <div class="form-content">
                                                        <a href="#">
                                                            <span class="ml-2">View Profile</span>
                                                        </a>
                                                        <a href="#">
                                                            <span class="ml-2">Edit</span>
                                                        </a>
                                                        <a href="#">
                                                            <span class="ml-2">Delete </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End section content -->

<div class="container">
    <div class="row">
        
    </div>
</div>



@endsection