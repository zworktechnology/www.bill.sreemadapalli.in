@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Payment</h4>
                <p style="color:lightgray">( Customers Sales Payment )</p>
            </div>
            <div class="page-btn">
                <div style="display: flex;">
                    <form autocomplete="off" method="POST" action="{{ route('salespayment.datefilter') }}">
                        @method('PUT')
                        @csrf
                        <div style="display: flex">
                            <div style="margin-right: 10px;"><input type="date" name="from_date"
                                    class="form-control from_date" value="{{ $today }}"></div>
                            <div style="margin-right: 5px;"><input type="submit" class="btn" value="Search"
                                    style="background: #ff9f43; color:white;" /></div>
                        </div>
                    </form>
                    <a href="/salespayment_pdfexport/{{ $today }}" target="_blank" class="btn btn-sucess"
                        style="margin-right:5px; background: #ff2116; color:white;">PDF</a>
                    <a href="/salespayment_excelexport/{{ $today }}" target="_blank" class="btn btn-sucess"
                        style="margin-right:5px; background: #067639; color:white;">Excel</a>
                </div>
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
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Paid Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salepayment_data as $keydata => $salepayment_datas)
                                        <tr>
                                            <td>{{ ++$keydata }}</td>
                                            <td>{{ $salepayment_datas['customer'] }}</td>
                                            <td>{{ $salepayment_datas['date'] }}</td>
                                            <td>{{ $salepayment_datas['paid_amount'] }}</td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li>
                                                        <a href="#edit{{ $salepayment_datas['unique_key'] }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $salepayment_datas['unique_key'] }}"
                                                            data-bs-target=".salepaymentedit-modal-xl{{ $salepayment_datas['unique_key'] }}"
                                                            class="badges bg-warning" style="color: white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#delete{{ $salepayment_datas['unique_key'] }}"
                                                            data-bs-toggle="modal"
                                                            data-id="{{ $salepayment_datas['unique_key'] }}"
                                                            data-bs-target=".salepaymentdelete-modal-xl{{ $salepayment_datas['unique_key'] }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <div class="modal fade salepaymentedit-modal-xl{{ $salepayment_datas['unique_key'] }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $salepayment_datas['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.salespayment.edit')
                                        </div>
                                        <div class="modal fade salepaymentdelete-modal-xl{{ $salepayment_datas['unique_key'] }}"
                                            tabindex="-1" role="dialog"data-bs-backdrop="static"
                                            aria-labelledby="deleteLargeModalLabel{{ $salepayment_datas['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.salespayment.delete')
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">

                @include('page.backend.salespayment.create')
            </div>
        </div>



    </div>
@endsection
