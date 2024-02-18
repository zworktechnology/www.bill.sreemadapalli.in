@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales</h4>
                <p style="color:lightgray">( Sales Details )</p>
            </div>

            <div class="page-btn">
                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('sales.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;" hidden>
                                       <select class="form-control" name="sales_type" id="sales_type">
                                          <option value="none">Status</option>
                                          <option value="Dine In">Dine In</option>
                                          <option value="Delivery">Delivery</option>
                                          <option value="Delivery">Delivery</option>
                                       </select>
                                 </div>
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn"
                                        value="Search" style="background: #ff9f43; color:white;"/></div>
                            </div>
                        </form>
                        <a href="{{ route('sales.create') }}" class="btn btn-added" style="margin-right: 10px;">Add New</a>
                </div>
            </div>
        </div>
        {{-- <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">Delivery</a></li>
            </ul> --}}
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">

                <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table  datanew">
                                            <thead>
                                                <tr>
                                                    <th>Bill No</th>
                                                    <th>Date</th>
                                                    <th>Sales Type</th>
                                                    <th>Customer</th>
                                                    <th>Payment Method</th>
                                                    <th>Delivery Boy</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($saledelivery_data as $keydata => $datas)
                                                    <tr>
                                                        <td>{{ $datas['bill_no'] }}</td>
                                                        <td> {{ $datas['date']  }}</td>
                                                        <td> {{ $datas['sales_type']  }}</td>
                                                        <td>{{ $datas['customer']}}</td>
                                                        <td>
                                                            @if ($datas['payment_method'] != "")
                                                                {{$datas['payment_method']}}
                                                            @else
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li>
                                                                    <a href="deliveryupdate{{ $datas['unique_key'] }}"
                                                                    data-bs-toggle="modal" data-id="{{ $datas['id'] }}" style="background: #e3e167;"
                                                                    data-bs-target=".deliveryupdate-modal-xl{{ $datas['unique_key'] }}"
                                                                    class="badges" style="color: white">Add</a>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                        </td>
                                                        <td style="color: #dc3545;"><i class="fa fa-user-circle" data-bs-toggle="tooltip" title="fa fa-user-circle"></i> {{$datas['Delivery_boyname']}}</td>
                                                        <td>₹ {{ $datas['grandtotal']   }}</td>
                                                        <td>

                                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li>
                                                                    <a href="#salesview{{ $datas['unique_key'] }}"
                                                                        data-bs-toggle="modal" data-id="{{ $datas['id'] }}"
                                                                        data-bs-target=".salesview-modal-xl{{ $datas['unique_key'] }}"
                                                                        class="badges bg-lightred salesview" style="color: white">View</a>

                                                                </li>
                                                                <li>
                                                                <a href="https://bill.sreemadapalli.in/zworktechnology/sales/print/{{ $datas['id'] }}" class="badges btn btn-success" style="color:white">Print</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                                        data-id="{{ $datas['unique_key'] }}"
                                                                        data-bs-target=".salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                                        class="badges bg-lightyellow" style="color: white">Delete</a>
                                                                </li>

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade deliveryupdate-modal-xl{{ $datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                        aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.deliveryupdate')
                                                    </div>
                                                    <div class="modal fade salesview-modal-xl{{ $datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                        aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.view')
                                                    </div>
                                                    <div class="modal fade salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                        aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.delete')
                                                    </div>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

    </div>
@endsection
