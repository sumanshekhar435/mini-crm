@extends('layout.app')
@section('company', 'active')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Company Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-sm float-sm-right" data-toggle="modal"
                            data-target="#exampleModalCenter">Add Companies</button>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h3 class="card-title">DataTable with minimal features & hover style</h3>
                            </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Company Logo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr data-id="{{ $company->id }}">
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->website }}</td>
                                                <td><img src="{{ asset($company->logo) }}" width="30px" height="30px"
                                                        alt=""></td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-id="{{ $company->id }}"
                                                        data-target="#editCompanyModal" class="btn-sm edit_company"
                                                        style="border: 0; background:none;"><i
                                                            class="fas fa-edit text-gray"></i></button>
                                                    <button type="button" data-toggle="modal" data-id="{{ $company->id }}"
                                                        data-target="#modal-default" class="btn-sm delete_company"
                                                        style="border: 0; background:none;"><i
                                                            class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Company Logo</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{-- create modal --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title ml-4" id="exampleModalLongTitle">Create Companie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: black">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <form id="companyForm">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Comapanie Name</label>
                                                <input type="text" name="comapanie_name" class="form-control"
                                                    id="comapanie_name" placeholder="Enter Comapanie Name">
                                                <small id="name_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="comapanie_email" class="form-control"
                                                    id="comapanie_email" placeholder="Enter email">
                                                <small id="email_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" name="comapanie_website" class="form-control"
                                                    id="comapanie_website" placeholder="Website">
                                                <small id="website_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="logo">Comapanie Logo</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="comapanie_logo"
                                                            class="custom-file-input" id="comapanie_logo">
                                                        <label class="custom-file-label" for="logo">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <small id="logo_error" class="form-text text-danger"></small>
                                                <!-- Image preview -->
                                                <div class="mt-2">
                                                    <img src="{{ asset('assets/dist/img/image-upload-icon.jpg') }}"
                                                        id="create_image_preview" alt="Image Preview"
                                                        style="width: 80px; height: 80px;">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" id="create_companies_button"
                        class="btn btn-primary btn-sm create_companies">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /. create modal --}}

    {{-- Edit modal --}}
    <div class="modal fade" id="editCompanyModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title ml-4" id="exampleModalLongTitle">Update Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: black">&times;</span>
                    </button>
                </div>
                <form id="updateForm" action="{{ route('update-company') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hidden_company_id" id="hidden_company_id">
                    <div class="modal-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Company Name</label>
                                                <input type="text" name="edit_company_name" class="form-control"
                                                    id="edit_company_name" placeholder="Enter Comapanie Name">
                                                <small id="name_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="edit_company_email" class="form-control"
                                                    id="edit_company_email" placeholder="Enter email">
                                                <small id="email_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" name="edit_company_website" class="form-control"
                                                    id="edit_company_website" placeholder="Website">
                                                <small id="website_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="logo">Company Logo</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="edit_company_logo"
                                                            class="custom-file-input" id="edit_company_logo">
                                                        <label class="custom-file-label" for="logo">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <small id="logo_error" class="form-text text-danger"></small>
                                                <!-- Image preview -->
                                                <div class="mt-2">
                                                    <img src="" id="image_preview" alt="Image Preview"
                                                        style="width: 80px; height: 80px;">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" id="edit_company_button"
                            class="btn btn-primary btn-sm edit_company">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /. Edit modal --}}

    {{-- Delete Modal --}}

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Delete Company</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete company data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" id="company_delete" class="btn bg-danger btn-sm">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- loader start --}}
    <div class="loader-container spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    {{-- loader end --}}
@endsection
@section('footer_script')
    <script>
        function showToast(type, msg) {
            $(document).Toasts('create', {
                class: type,
                title: 'Success',
                position: 'bottomRight',
                body: msg
            });
        }
    </script>
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $('#comapanie_logo').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#create_image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
        $('.create_companies').on('click', function() {
            $('#create_companies_button').prop('disabled', true);
            var name = $('#comapanie_name').val();
            var email = $('#comapanie_email').val();
            var website = $('#comapanie_website').val();
            var logo = $('#comapanie_logo')[0].files[0];
            console.log(logo);
            var data = new FormData();
            data.append('name', name);
            data.append('email', email);
            data.append('website', website);
            data.append('logo', logo);
            $('.loader-container').show();
            console.log(data);
            $.ajax({
                type: "post",
                url: '{{ route('store-companies') }}',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('.loader-container').hide();
                    $('#create_companies_button').prop('disabled', false);
                    $('#exampleModalCenter').modal('hide');
                    showToast('bg-success', 'Data successfully validated and stored.');
                    var company = response.company;
                    console.log(company.id);
                    // Create the new row HTML
                    var newRow = '<tr data-id="' + company.id + '">' +
                        '<td>' + company.name + '</td>' +
                        '<td>' + company.email + '</td>' +
                        '<td>' + company.website + '</td>' +
                        '<td><img src="' + company.logo + '" width="30px" height="30px" alt=""></td>' +
                        '<td>' +
                        '<a href="" class="mr-3 ml-2"><i class="fas fa-edit text-gray"></i></a>' +
                        '<button type="button" data-toggle="modal" data-id="' + company.id +
                        '" data-target="#modal-default" class="btn-sm delete_company" style="border: 0; background:none;"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>' +
                        '</td>' +
                        '</tr>';

                    // Append the new row to the table body
                    $('tbody').append(newRow);
                },
                error: function(reject) {
                    $('.loader-container').hide();
                    $('#create_companies_button').prop('disabled', false);
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    })
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var company_id;
            $('.delete_company').on('click', function() {
                company_id = $(this).data('id');
            });

            $('#company_delete').on('click', function() {
                $(this).prop('disabled', true);
                $('.loader-container').show();

                $.ajax({
                    type: "post",
                    url: '{{ route('delete-company') }}',
                    data: {
                        id: company_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.loader-container').hide();
                        $(this).prop('disabled', false);
                        $('#modal-default').modal('hide');
                        showToast('bg-success', 'Company Data Delete successfully!');
                        $('tr[data-id="' + company_id + '"]').remove();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            // Event listener for file input change
            $('#edit_company_logo').change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('.edit_company').on('click', function() {
                var company_id = $(this).data('id');
                console.log();
                $.ajax({
                    type: "get",
                    url: 'edit-company/' + company_id,
                    success: function(response) {
                        console.log(response.company.name);
                        $('#hidden_company_id').val(company_id);
                        $('#edit_company_name').val(response.company.name);
                        $('#edit_company_email').val(response.company.email);
                        $('#edit_company_website').val(response.company.website);
                        $('#edit_company_logo').attr('src', response.company.logo);
                        // Display image preview if logo exists
                        if (response.company.logo) {
                            $('#image_preview').attr('src', response.company.logo);
                        } else {
                            // Clear image preview if logo doesn't exist
                            $('#image_preview').attr('src', '');
                        }
                        // Clear file input value
                        $('#edit_company_logo').val('');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#updateForm').submit(function(e) {
                // Disable the "Update" button
                $('#edit_company_button').prop('disabled', true);

                // Show the loader
                $('.loader-container').show();
            });
        });
    </script>

    @if (session('msg'))
        <script>
            showToast('bg-success', '{{ session('msg') }}');
        </script>
    @endif
@stop
