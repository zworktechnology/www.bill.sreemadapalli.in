@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product</h4>
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
                                        <th>Image</th>
                                        <th>Details</th>
                                        <th>Sessions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Productdata as $keydata => $Productdatas)
                                        <tr>
                                            <td>{{ ++$keydata }}</td>
                                            @if ($Productdatas['image'] == '')
                                                <td></td>
                                            @elseif ($Productdatas['image'] != '')
                                                <td><img src="{{ asset('assets/product/' . $Productdatas['image']) }}"
                                                        alt="" width="50" height="50"></td>
                                            @endif
                                            <td>{{ $Productdatas['name'] }} - <span
                                                    style="color: red">₹ {{ $Productdatas['price'] }}</span><br><span
                                                    style="color: lightgray">{{ $Productdatas['categoryname'] }}</span></td>
                                            <td></td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $Productdatas['unique_key'] }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $Productdatas['unique_key'] }}"
                                                            data-bs-target=".productedit-modal-xl{{ $Productdatas['unique_key'] }}"
                                                            class="badges bg-lightgrey" style="color: white">Edit</a>
                                                    </li>
                                                    <li hidden>
                                                        <a href="#delete{{ $Productdatas['unique_key'] }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $Productdatas['unique_key'] }}"
                                                            data-bs-target=".productedelete-modal-xl{{ $Productdatas['unique_key'] }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade productedit-modal-xl{{ $Productdatas['unique_key'] }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $Productdatas['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.product.edit')
                                        </div>
                                        <div class="modal fade productedelete-modal-xl{{ $Productdatas['unique_key'] }}"
                                            tabindex="-1" role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $Productdatas['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.product.delete')
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
                        <form autocomplete="off" method="POST" action="{{ route('product.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Category <span style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single select productcategory_id" name="category_id"
                                            id="category_id">
                                            <option value="" disabled selected hiddden>Select Category</option>
                                            @foreach ($category as $categores)
                                                <option value="{{ $categores->id }}">{{ $categores->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Product Name <span style="color: red;">*</span></label>
                                        <input type="text" name="name" placeholder="Enter Product name"
                                            class="product_name">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Price<span style="color: red;">*</span></label>
                                        <input type="text" name="price" placeholder="Enter Product Price">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Image<span style="color: red;">*</span></label>
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-3 col-3">
                                                <img src="#" id="category-img-tag" width="100" height="100" />
                                            </div>
                                            <div class="col-lg-9 col-sm-9 col-9">
                                                <input type="file" id="productimage" class="form-control"
                                                    name="productimage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-12">
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

            <div class="modal fade product-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
                aria-hidden="true">
                @include('page.backend.product.create')
            </div>
        </div>
    @endsection
