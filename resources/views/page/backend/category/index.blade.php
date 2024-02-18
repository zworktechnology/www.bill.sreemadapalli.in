@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Category</h4>
                <p style="color:lightgray">( Category Details )</p>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catdata as $keydata => $category_data)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $category_data['name'] }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $category_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $category_data['unique_key'] }}"
                                                    data-bs-target=".categoryeedit-modal-xl{{ $category_data['unique_key'] }}"
                                                    class="badges bg-warning" style="color: white">Edit</a>
                                            </li>
                                            <li hidden>
                                                <a href="#delete{{ $category_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $category_data['unique_key'] }}"
                                                    data-bs-target=".categorydelete-modal-xl{{ $category_data['unique_key'] }}"
                                                    class="badges bg-danger" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade categoryeedit-modal-xl{{ $category_data['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $category_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.category.edit')
                                </div>
                                <div class="modal fade categorydelete-modal-xl{{ $category_data['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $category_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.category.delete')
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
                        <form autocomplete="off" method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Name <span style="color: red;">*</span></label>
                                        <input type="text" name="name" placeholder="Enter Category name" required>
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

        <div class="modal fade category-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.category.create')
        </div>
    </div>
@endsection
