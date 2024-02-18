@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Employee</h4>
                <p style="color:lightgray">( Employee Details )</p>
            </div>
        </div>
        <div style="display: flex">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>Details</th>
                                        <th>Phone No</th>
                                        <th>Per Day Salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $keydata => $employee_data)
                                        <tr>
                                            <td>{{ $employee_data->name }} <br> <span
                                                    style="color: lightgray">{{ $employee_data->address }}</span> </td>
                                            <td>{{ $employee_data->phone_number }}</td>
                                            <td>₹ {{ $employee_data->perdaysalary }}</td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $employee_data->unique_key }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $employee_data->unique_key }}"
                                                            data-bs-target=".employeeedit-modal-xl{{ $employee_data->unique_key }}"
                                                            class="badges bg-warning" style="color: white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete{{ $employee_data->unique_key }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $employee_data->unique_key }}"
                                                            data-bs-target=".employeedelete-modal-xl{{ $employee_data->unique_key }}"
                                                            class="badges bg-danger" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade employeeedit-modal-xl{{ $employee_data->unique_key }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $employee_data->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.employee.edit')
                                        </div>
                                        <div class="modal fade employeedelete-modal-xl{{ $employee_data->unique_key }}"
                                            tabindex="-1" role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $employee_data->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.employee.delete')
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4" style="margin-left: 25px;">
                <div class="card">
                    <div class="card-body">
                        <form autocomplete="off" method="POST" action="{{ route('employee.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Name <span style="color: red;">*</span></label>
                                        <input type="text" name="name" placeholder="Enter Employee name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number<span style="color: red;">*</span></label>
                                        <input type="text" name="phone_number" placeholder="Enter Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>One Day Salary<span style="color: red;">*</span></label>
                                        <input type="text" name="perdaysalary" placeholder="Per Day salary" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 button-align">
                                    <button type="submit" class="btn btn-submit me-2">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade employee-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.employee.create')
        </div>
    </div>
@endsection
