@extends('admin.dashboard')

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new_appointment main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">All Tests</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addTest"> Add Test</button>
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
                                                <th>Test Name</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tests as $test)
                                            <tr>
                                                <td>{{ $test->test_name }}</td>
                                                <td>{{ $test->description }}</td>
                                                <td class="text-start">
                                                    <a data-bs-toggle="modal" data-bs-target="#editTest{{ $test->id }}" class="mr-4">
                                                        <span class="fas fa-pencil-alt tbl-edit"></span>
                                                    </a>
                                                    <a data-bs-toggle="modal" data-bs-target="#deleteTest{{ $test->id }}" class="mr-4">
                                                        <span class="fas fa-trash-alt tbl-delet"></span>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal for Edit Test -->
                                            <div class="modal fade" id="editTest{{ $test->id }}" tabindex="-1" role="dialog" aria-labelledby="editTest{{ $test->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editTest{{ $test->id }}Label">Edit Test</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/admin/editTest') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="test_id" value="{{ $test->id }}">
                                                                <div class="row align-items-start">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" placeholder="Enter test name" name="test_name" value="{{ $test->test_name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Description</label>
                                                                            <textarea class="form-control" rows="3" name="description">{{ $test->description }}</textarea>
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

                                            <!-- Modal for Delete Test -->
                                            <div class="modal fade" id="deleteTest{{ $test->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTest{{ $test->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteTest{{ $test->id }}Label">Delete Test</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/admin/deleteTest') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p class="text-center">Are you sure you want to delete "{{ $test->test_name }}"?</p>
                                                                <input type="hidden" name="test_id" value="{{ $test->id }}">
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

    <!-- Modal for Add Test -->
    <div class="modal fade" id="addTest" tabindex="-1" role="dialog" aria-labelledby="addTestLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestLabel">Add Test</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/addTest') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Test Name" name="test_name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Test</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
