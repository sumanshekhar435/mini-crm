@extends('layout.app')
@section('employees', 'active')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Employees Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary btn-sm float-sm-right" data-toggle="modal"
                            data-target="#exampleModalCenter">Add Employees</button>
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
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Comapny</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $item)
                                            <tr data-id="{{ $item->id }}">
                                                <td>{{ $item->first_name }}</td>
                                                <td>{{ $item->last_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ optional($item->company_details)->name }}</td>
                                                <td>
                                                    <button type="button" data-toggle="modal" data-id="{{ $item->id }}"
                                                        data-target="#editEmployeesModal" class="btn-sm edit_employees"
                                                        style="border: 0; background:none;"><i
                                                            class="fas fa-edit text-gray"></i></button>
                                                    <button type="button" data-toggle="modal" data-id="{{ $item->id }}"
                                                        data-target="#modal-default" class="btn-sm delete_employees"
                                                        style="border: 0; background:none;"><i
                                                            class="fa fa-trash text-danger" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Comapny</th>
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
                    <h5 class="modal-title ml-4" id="exampleModalLongTitle">Create Employees</h5>
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
                                                <label for="name">First Name</label>
                                                <input type="text" name="employees_first_name" class="form-control"
                                                    id="employees_first_name" placeholder="Enter Comapanie Name">
                                                <small id="first_name_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Last Name</label>
                                                <input type="text" name="employees_last_name" class="form-control"
                                                    id="employees_last_name" placeholder="Enter Comapanie Name">
                                                <small id="last_name_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="employees_email" class="form-control"
                                                    id="employees_email" placeholder="Enter email">
                                                <small id="email_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="mobile" name="phone" id="employees_phone"
                                                    class="form-control" placeholder="Enter Phone Number">
                                                <small id="phone_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Company</label>
                                                <select class="form-control select2bs4" id="company" name="company"
                                                    style="width: 100%;">
                                                    <option selected="selected">Select Company</option>
                                                    @foreach ($company as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small id="company_error" class="form-text text-danger"></small>
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
                    <button type="submit" id="create_employees_button"
                        class="btn btn-primary btn-sm create_employees">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- /. create modal --}}

    {{-- Edit modal --}}
    <div class="modal fade" id="editEmployeesModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title ml-4" id="exampleModalLongTitle">Update Employees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: black">&times;</span>
                    </button>
                </div>
                <form id="updateForm" action="{{ route('update-employees') }}" method="post">
                    @csrf
                    <input type="hidden" name="hidden_employees_id" id="hidden_employees_id">
                    <div class="modal-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">First Name</label>
                                                <input type="text" name="edit_employees_first_name" class="form-control"
                                                    id="edit_employees_first_name" placeholder="Enter Comapanie Name">
                                                <small id="first_name_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Last Name</label>
                                                <input type="text" name="edit_employees_last_name" class="form-control"
                                                    id="edit_employees_last_name" placeholder="Enter Comapanie Name">
                                                <small id="last_name_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" name="edit_employees_email" class="form-control"
                                                    id="edit_employees_email" placeholder="Enter email">
                                                <small id="email_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="website">Phone</label>
                                                <input type="text" name="edit_employees_phone" class="form-control"
                                                    id="edit_employees_phone" placeholder="Website">
                                                <small id="phone_error" class="form-text text-danger"></small>
                                            </div>
                                            <div class="form-group">
                                                <label>Company</label>
                                                <select class="form-control select2bs4" id="edit_company" name="edit_company"
                                                    style="width: 100%;">
                                                    <option selected="selected">Select Company</option>
                                                    @foreach ($company as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                <small id="company_error" class="form-text text-danger"></small>
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
                        <button type="submit" id="edit_employees_button"
                            class="btn btn-primary btn-sm edit_employees">Update</button>
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
                    <h4 class="modal-title">Delete Employees</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete Employees data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" id="employees_delete" class="btn bg-danger btn-sm">Delete</button>
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
        $('.create_employees').on('click', function() {
            $('#create_employees_button').prop('disabled', true);
            var first_name = $('#employees_first_name').val();
            var last_name = $('#employees_last_name').val();
            var email = $('#employees_email').val();
            var phone = $('#employees_phone').val();
            var company = $('#company').val();
            var data = new FormData();
            data.append('first_name', first_name);
            data.append('last_name', last_name);
            data.append('email', email);
            data.append('phone', phone);
            data.append('company', company);
            $('.loader-container').show();
            console.log(data);
            $.ajax({
                type: "post",
                url: '{{ route('store-employees') }}',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('.loader-container').hide();
                    $('#create_employees_button').prop('disabled', false);
                    $('#exampleModalCenter').modal('hide');
                    showToast('bg-success', 'Employees Data successfully stored!');
                    var employees = response.employees;
                    console.log(employees.id);
                    // Create the new row HTML
                    var newRow = '<tr data-id="' + employees.id + '">' +
                        '<td>' + employees.first_name + '</td>' +
                        '<td>' + employees.last_name + '</td>'
                    '<td>' + employees.email + '</td>' +
                        '<td>' + employees.phone + '</td>' +
                        '<td>' +
                        '<a href="" class="mr-3 ml-2"><i class="fas fa-edit text-gray"></i></a>' +
                        '<button type="button" data-toggle="modal" data-id="' + employees.id +
                        '" data-target="#modal-default" class="btn-sm delete_employees" style="border: 0; background:none;"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button>' +
                        '</td>' +
                        '</tr>';

                    // Append the new row to the table body
                    $('tbody').append(newRow);
                },
                error: function(reject) {
                    $('.loader-container').hide();
                    $('#create_employees_button').prop('disabled', false);
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
            var employees_id;
            $('.delete_employees').on('click', function() {
                employees_id = $(this).data('id');
            });

            $('#employees_delete').on('click', function() {
                $(this).prop('disabled', true);
                $('.loader-container').show();

                $.ajax({
                    type: "post",
                    url: '{{ route('delete-employees') }}',
                    data: {
                        id: employees_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('.loader-container').hide();
                        $(this).prop('disabled', false);
                        $('#modal-default').modal('hide');
                        showToast('bg-success', 'Company Data Delete successfully!');
                        $('tr[data-id="' + employees_id + '"]').remove();
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.edit_employees').on('click', function() {
                var employees_id = $(this).data('id');
                console.log(employees_id);
                $.ajax({
                    type: "get",
                    url: 'edit-employees/' + employees_id,
                    success: function(response) {
                        console.log(response);
                        $('#hidden_employees_id').val(employees_id);
                        $('#edit_employees_first_name').val(response.employee.first_name);
                        $('#edit_employees_last_name').val(response.employee.last_name);
                        $('#edit_employees_email').val(response.employee.email);
                        $('#edit_employees_phone').val(response.employee.phone);
                        $('#edit_company').val(response.employee.company_id).trigger('change');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#updateForm').submit(function(e) {
                // Disable the "Update" button
                $('#edit_employees_button').prop('disabled', true);

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
    <script>
        $(document).ready(function() {
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@stop
