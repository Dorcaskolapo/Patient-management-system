@extends('admin.layout.dashboard')

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new_appointment main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">All Bloodgroup</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addBloodgroup"> Add Bloodgroup</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th>Bloodgroup</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bloodgroups as $bloodgroup)
                                            <tr>
                                                <td>{{ $bloodgroup->bloodgroup }}</td>
                                                <td class="text-start">
                                                    <a data-bs-toggle="modal" data-bs-target="#editBloodgroup{{ $bloodgroup->id }}" class="mr-4">
                                                        <span class="fas fa-pencil-alt tbl-edit"></span>
                                                    </a>
                                                    <a data-bs-toggle="modal" data-bs-target="#deleteBloodgroup{{ $bloodgroup->id }}" class="mr-4">
                                                        <span class="fas fa-trash-alt tbl-delet"></span>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal for Edit Bloodgroup -->
                                            <div class="modal fade" id="editBloodgroup{{ $bloodgroup->id }}" tabindex="-1" role="dialog" aria-labelledby="editBloodgroup{{ $bloodgroup->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editBloodgroup{{ $bloodgroup->id }}Label">Edit Bloodgroup</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/admin/editBloodgroup') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="bloodgroup_id" value="{{ $bloodgroup->id }}">
                                                                <div class="row align-items-start">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" placeholder="Enter bloodgroup" name="bloodgroup" value="{{ $bloodgroup->bloodgroup }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal for Delete Bloodgroup -->
                                            <div class="modal fade" id="deleteBloodgroup{{ $bloodgroup->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteBloodgroup{{ $bloodgroup->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteBloodgroup{{ $bloodgroup->id }}Label">Delete Bloodgroup</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/admin/deleteBloodgroup') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p class="text-center">Are you sure you want to delete "{{ $bloodgroup->bloodgroup }}"?</p>
                                                                <input type="hidden" name="bloodgroup_id" value="{{ $bloodgroup->id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
            </div>
        </div>
    </div>
    <!-- End section content -->

    <!-- Modal for Add Bloodgroup -->
    <div class="modal fade" id="addBloodgroup" tabindex="-1" role="dialog" aria-labelledby="addBloodgroupLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBloodgroupLabel">Add Bloodgroup</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/addBloodgroup') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Bloodgroup" name="bloodgroup">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Bloodgroup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
