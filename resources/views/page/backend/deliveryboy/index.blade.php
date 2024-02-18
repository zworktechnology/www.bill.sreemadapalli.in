@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Delivery Boys</h4>
                <p style="color:lightgray">( Delivery Boys Details )</p>
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
                                        <th>Phone Number</th>
                                        {{-- <th>Delivery Area</th> --}}
                                        <!-- <th>Per Shift Salary</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $keydata => $deliveryboydata)
                                        <tr>
                                            <td>{{ ++$keydata }}</td>
                                            <td>{{ $deliveryboydata->name }} <br> <span style="color: lightgray">{{ $deliveryboydata->address }}</span></td>
                                            <td>{{ $deliveryboydata->phone_number }}</td>
                                            {{-- <td>{{ $deliveryboydata->deliveryarea->name }}</td> --}}
                                            <!-- <td>₹ {{ $deliveryboydata->pershiftsalary }}.00</td> -->
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $deliveryboydata->unique_key }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $deliveryboydata->unique_key }}"
                                                            data-bs-target=".edit-modal-xl{{ $deliveryboydata->unique_key }}"
                                                            class="badges bg-warning" style="color: white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete{{ $deliveryboydata->unique_key }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $deliveryboydata->unique_key }}"
                                                            data-bs-target=".delete-modal-xl{{ $deliveryboydata->unique_key }}"
                                                            class="badges bg-danger" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade edit-modal-xl{{ $deliveryboydata->unique_key }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $deliveryboydata->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.deliveryboy.edit')
                                        </div>
                                        <div class="modal fade delete-modal-xl{{ $deliveryboydata->unique_key }}"
                                            tabindex="-1" role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $deliveryboydata->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.deliveryboy.delete')
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
                        <form autocomplete="off" method="POST" action="{{ route('delivery.boy.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Name <span style="color: red;">*</span></label>
                                        <input type="text" name="name" placeholder="Enter name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Phone Number <span style="color: red;">*</span></label>
                                        <input type="text" name="phone_number" placeholder="Enter Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea type="text" name="address" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12" hidden>
                                    <div class="form-group">
                                        <label>Per Shift Salary <span style="color: red;">*</span></label>
                                        <input type="text" name="pershiftsalary" placeholder="Per Shift Salary ">
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


            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
                aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                @include('page.backend.deliveryboy.create')
            </div>
        </div>
    @endsection
