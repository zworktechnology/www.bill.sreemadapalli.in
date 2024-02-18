@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Payment Modes</h4>
                <p style="color:lightgray">( Payment Modes Details )</p>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-xl">Add New</button>
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
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $keydata => $bankdata)
                                        <tr>
                                            <td>{{ ++$keydata }}</td>
                                            <td>{{ $bankdata->name }}</td>
                                            <td>{{ $bankdata->note }}</td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $bankdata->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $bankdata->unique_key }}"
                                                            data-bs-target=".edit-modal-xl{{ $bankdata->unique_key }}"
                                                            class="badges bg-warning" style="color: white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete{{ $bankdata->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $bankdata->unique_key }}"
                                                            data-bs-target=".delete-modal-xl{{ $bankdata->unique_key }}"
                                                            class="badges bg-danger" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade edit-modal-xl{{ $bankdata->unique_key }}" tabindex="-1"
                                            role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $bankdata->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.bank.edit')
                                        </div>
                                        <div class="modal fade delete-modal-xl{{ $bankdata->unique_key }}" tabindex="-1"
                                            role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $bankdata->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.bank.delete')
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
                        <form autocomplete="off" method="POST" action="{{ route('bank.store') }}">
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
                                        <label>Note</label>
                                        <textarea type="text" name="note" placeholder="Enter note"></textarea>
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

            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
                aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                @include('page.backend.bank.create')
            </div>
        </div>
    @endsection
