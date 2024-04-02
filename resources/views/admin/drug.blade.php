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
        <div class="new_appointment main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">All Drugs</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addDrug"> Add Drug</button>
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
                                            <th>Trade Name</th>
                                            <th>Generic Name</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($drugs as $drug)
                                        <tr>
                                            <td>{{ $drug->trade_name }}</td>
                                            <td>{{ $drug->generic_name }}</td>
                                            <td>{{ $drug->note }}</td>
                                            <td class="text-start">
                                                <a data-bs-toggle="modal" data-bs-target="#editDrug{{ $drug->id }}" class="mr-4">
                                                    <span class="fas fa-pencil-alt tbl-edit"></span>
                                                </a>
                                                <a data-bs-toggle="modal" data-bs-target="#deleteDrug{{ $drug->id }}" class="mr-4">
                                                    <span class="fas fa-trash-alt tbl-delet"></span>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal for Edit Drug -->
                                        <div class="modal fade" id="editDrug{{ $drug->id }}" tabindex="-1" role="dialog" aria-labelledby="editDrug{{ $drug->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editDrug{{ $drug->id }}Label">Edit Drug</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ url('/admin/editDrug') }}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="drug_id" value="{{ $drug->id }}">
                                                            <div class="row align-items-start">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" placeholder="Enter drug trade name" name="trade_name" value="{{ $drug->trade_name }}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" placeholder="Enter drug generic name" name="generic_name" value="{{ $drug->generic_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label for="note">Note</label>
                                                                        <textarea class="form-control" rows="3" name="note">{{ $drug->note }}</textarea>
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


                                        <!-- Modal for Delete Drug -->
                                        <div class="modal fade" id="deleteDrug{{ $drug->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteDrug{{ $drug->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteDrug{{ $drug->id }}Label">Delete Drug</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ url('/admin/deleteDrug') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <p class="text-center">Are you sure you want to delete "{{ $drug->trade_name }}"?</p>
                                                            <input type="hidden" name="drug_id" value="{{ $drug->id }}">
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

<!-- Modal for Add Drug -->
<div class="modal fade" id="addDrug" tabindex="-1" role="dialog" aria-labelledby="addDrugLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDrugLabel">Add Drug</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/admin/addDrug') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Trade Name" name="trade_name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter Generic Name" name="generic_name">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea class="form-control" rows="3" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Drug</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
