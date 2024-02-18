@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Session</h4>
                <p style="color:lightgray">( Session Details )</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table  datanew">
                                <thead>
                                    <tr>
                                        <th>Sl. No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $keydata => $session_data)
                                        <tr>
                                            <td>{{ ++$keydata }}</td>
                                            <td>{{ $session_data->name }}</td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $session_data->unique_key }}"
                                                            data-bs-toggle="modal" data-id="{{ $session_data->unique_key }}"
                                                            data-bs-target=".sessionedit-modal-xl{{ $session_data->unique_key }}"
                                                            class="badges bg-warning" style="color: white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete{{ $session_data->unique_key }}"
                                                            data-bs-toggle="modal" data-id="{{ $session_data->unique_key }}"
                                                            data-bs-target=".sessiondelete-modal-xl{{ $session_data->unique_key }}"
                                                            class="badges bg-danger" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade sessionedit-modal-xl{{ $session_data->unique_key }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $session_data->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.session.edit')
                                        </div>
                                        <div class="modal fade sessiondelete-modal-xl{{ $session_data->unique_key }}"
                                            tabindex="-1" role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $session_data->unique_key }}"
                                            aria-hidden="true">
                                            @include('page.backend.session.delete')
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <form autocomplete="off" method="POST" action="{{ route('session.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Session Name <span style="color: red;">*</span></label>
                                        <input type="text" name="name" placeholder="Enter name" required>
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

            <div class="modal fade session-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
                aria-hidden="true">
                @include('page.backend.session.create')
            </div>
        </div>
    @endsection
