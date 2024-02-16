@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Supplier</h4>
                <p style="color:lightgray">( All Suppliers Details )</p>
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
                                    <th>Sl. No</th>
                                    <th>Name</th>
                                    <th>Phone No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierdata as $keydata => $supplier_data)
                                    <tr>
                                        <td>{{ ++$keydata }}</td>
                                        <td>{{ $supplier_data['name'] }}</td>
                                        <td>{{ $supplier_data['phone_number']  }}</td>
                                        <td>
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li>
                                                    <a href="#edit{{ $supplier_data['unique_key'] }}" data-bs-toggle="modal"
                                                        data-id="{{ $supplier_data['unique_key'] }}"
                                                        data-bs-target=".supplieredit-modal-xl{{ $supplier_data['unique_key'] }}"
                                                        class="badges bg-lightgrey" style="color: white">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#delete{{ $supplier_data['unique_key'] }}" data-bs-toggle="modal"
                                                        data-id="{{ $supplier_data['unique_key'] }}"
                                                        data-bs-target=".supplierdelete-modal-xl{{ $supplier_data['unique_key'] }}"
                                                        class="badges bg-lightyellow" style="color: white">Delete</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <div class="modal fade supplieredit-modal-xl{{ $supplier_data['unique_key'] }}"
                                        tabindex="-1" role="dialog" data-bs-backdrop="static"
                                        aria-labelledby="editLargeModalLabel{{ $supplier_data['unique_key'] }}"
                                        aria-hidden="true">
                                        @include('page.backend.supplier.edit')
                                    </div>
                                    <div class="modal fade supplierdelete-modal-xl{{ $supplier_data['unique_key'] }}"
                                        tabindex="-1" role="dialog"data-bs-backdrop="static"
                                        aria-labelledby="deleteLargeModalLabel{{ $supplier_data['unique_key'] }}"
                                        aria-hidden="true">
                                        @include('page.backend.supplier.delete')
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
                    <form autocomplete="off" method="POST" action="{{ route('supplier.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Name <span style="color: red;">*</span></label>
                                    <input type="text" name="name" placeholder="Enter Supplier name" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Phone Number<span style="color: red;">*</span></label>
                                    <input type="text" name="phone_number" class="supplier_contactno" onkeyup="suppliercheck(); return false;"  placeholder="Enter Phone Number" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" placeholder="Enter Address">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Old Balance</label>
                                    <input type="text" name="old_balance" placeholder="Enter Old Balance Amount">
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

        <div class="modal fade supplier-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.supplier.create')
        </div>
    </div>
@endsection
