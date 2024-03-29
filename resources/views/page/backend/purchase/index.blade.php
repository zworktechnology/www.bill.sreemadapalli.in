@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Purchase</h4>
                <p style="color:lightgray">( Suppliers Purchase Bill Details )</p>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                    <form autocomplete="off" method="POST" action="{{ route('purchase.datefilter') }}">
                        @method('PUT')
                        @csrf
                        <div style="display: flex">
                            <div style="margin-right: 10px;"><input type="date" name="from_date"
                                    class="form-control from_date" value="{{ $today }}"></div>
                            <div style="margin-right: 10px;"><input type="submit" class="btn" value="Search"
                                    style="background: #ff9f43; color:white;" /></div>
                        </div>
                    </form>
                    <a href="{{ route('purchase.create') }}" class="btn btn-added" style="margin-right: 10px;">New Bill</a>
                    <a href="/purchase_pdfexport/{{ $today }}" target="_blank" class="btn btn-sucess"
                        style="margin-right:5px; background: #ff2116; color:white;">PDF</a>
                    <a href="/purchase_excelexport/{{ $today }}" target="_blank" class="btn btn-sucess"
                        style="margin-right:5px; background: #067639; color:white;">Excel</a>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Bill No</th>
                                <th>Voucher Number</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Accounts</th>
                                <th>Paid Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase_data as $keydata => $datas)
                                <tr>
                                    <td>#{{ $datas['bill_no'] }}</td>
                                    <td># {{ $datas['voucher_no'] }}</td>
                                    <td>{{ date('d-m-Y', strtotime($datas['date'])) }}</td>
                                    <td>{{ $datas['supplier_name'] }}</td>
                                    <td>₹ {{ $datas['grandtotal'] }}</td>
                                    <td>₹ {{ $datas['paidamount'] }}</td>
                                    <td>

                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            {{-- <li>
                                                <a href="#purchaseview{{ $datas['unique_key'] }}"
                                                    data-bs-toggle="modal" data-id="{{ $datas['id'] }}"
                                                    data-bs-target=".purchaseview-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges bg-lightred purchaseview" style="color: white">View</a>

                                            </li> --}}
                                            <li>
                                                <a href="{{ route('purchase.edit', ['unique_key' => $datas['unique_key']]) }}"
                                                    class="badges bg-warning" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $datas['unique_key'] }}"
                                                    data-bs-target=".purchasedelete-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <div class="modal fade purchaseview-modal-xl{{ $datas['unique_key'] }}" tabindex="-1"
                                    role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.purchase.view')
                                </div>

                                <div class="modal fade purchasedelete-modal-xl{{ $datas['unique_key'] }}" tabindex="-1"
                                    role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}" aria-hidden="true">
                                    @include('page.backend.purchase.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
