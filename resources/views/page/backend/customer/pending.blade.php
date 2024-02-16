@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Customer</h4>
                <p style="color:lightgray">( Pending Customers Details )</p>
            </div>
            <div class="page-btn">
                <a href="{{ route('customer.index') }}">
                <button class="btn btn-primary waves-effect waves-light btn-added">View All</button>
                </a>
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
                                        {{-- <th>Sl. No</th> --}}
                                        <th>Details</th>
                                        <th>Accounts Values</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customerdata as $keydata => $custmer_data)
                                        <tr>
                                            {{-- <td>{{ ++$keydata }}</td> --}}
                                            <td>{{ $custmer_data['name'] }}<br>{{ $custmer_data['phone_number'] }}</td>

                                            @if ($custmer_data['pending_amount'] != '')
                                                <td style="color: red;">{{ $custmer_data['pending_amount'] }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $custmer_data['unique_key'] }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $custmer_data['unique_key'] }}"
                                                            data-bs-target=".customeredit-modal-xl{{ $custmer_data['unique_key'] }}"
                                                            class="badges bg-lightgrey" style="color: white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete{{ $custmer_data['unique_key'] }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $custmer_data['unique_key'] }}"
                                                            data-bs-target=".customerdelete-modal-xl{{ $custmer_data['unique_key'] }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade customeredit-modal-xl{{ $custmer_data['unique_key'] }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $custmer_data['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.customer.edit')
                                        </div>
                                        <div class="modal fade customerdelete-modal-xl{{ $custmer_data['unique_key'] }}"
                                            tabindex="-1" role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $custmer_data['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.customer.delete')
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
                        <form autocomplete="off" method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Name or Address <span style="color: red;">*</span></label>
                                        <input type="text" name="name" placeholder="Enter Customer name or Address" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Phone Number <span style="color: red;">*</span></label>
                                        <input type="text" name="phone_number" class="customer_contactno"
                                            placeholder="Enter Phone Number"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Old Balance <span style="color: red;">*</span></label>
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

        <div class="modal fade customer-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.customer.create')
        </div>
    </div>
@endsection

