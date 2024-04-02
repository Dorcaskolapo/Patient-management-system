@extends('admin.layout.dashboard')

@section('content')

    <!-- start section content -->
    <div class="content-body">
        <div class="warper container-fluid">
            <div class="new_appointment main_container">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="text-primary">All Genotype</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addGenotype"> Add Genotype</button>
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
                                                <th>Genotype</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($genotypes as $genotype)
                                            <tr>
                                                <td>{{ $genotype->genotype }}</td>
                                                <td class="text-start">
                                                    <a data-bs-toggle="modal" data-bs-target="#editGenotype{{ $genotype->id }}" class="mr-4">
                                                        <span class="fas fa-pencil-alt tbl-edit"></span>
                                                    </a>
                                                    <a data-bs-toggle="modal" data-bs-target="#deleteGenotype{{ $genotype->id }}" class="mr-4">
                                                        <span class="fas fa-trash-alt tbl-delet"></span>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal for Edit genotype -->
                                            <div class="modal fade" id="editGenotype{{ $genotype->id }}" tabindex="-1" role="dialog" aria-labelledby="editGenotype{{ $genotype->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editGenotype{{ $genotype->id }}Label">Edit Genotype</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/admin/editGenotype') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="genotype_id" value="{{ $genotype->id }}">
                                                                <div class="row align-items-start">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" placeholder="Enter Genotype" name="genotype" value="{{ $genotype->genotype }}">
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

                                            <!-- Modal for Delete genotype -->
                                            <div class="modal fade" id="deleteGenotype{{ $genotype->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteGenotype{{ $genotype->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteGenotype{{ $genotype->id }}Label">Delete Genotype</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ url('/admin/deleteGenotype') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p class="text-center">Are you sure you want to delete "{{ $genotype->genotype }}"?</p>
                                                                <input type="hidden" name="genotype_id" value="{{ $genotype->id }}">
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

    <!-- Modal for Add genotype -->
    <div class="modal fade" id="addGenotype" tabindex="-1" role="dialog" aria-labelledby="addGenotypeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGenotypeLabel">Add Genotype</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/admin/addGenotype') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Genotype" name="genotype">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Genotype</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
