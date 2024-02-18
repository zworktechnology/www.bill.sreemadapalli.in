@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Expense</h4>
                <p style="color:lightgray">( Shop Expense Details )</p>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                    <form autocomplete="off" method="POST" action="{{ route('expense.datefilter') }}">
                        @method('PUT')
                        @csrf
                        <div style="display: flex">
                            <div style="margin-right: 10px;"><input type="date" name="from_date"
                                    class="form-control from_date" value="{{ $today }}"></div>
                            <div style="margin-right: 5px;"><input type="submit" class="btn" value="Search"
                                    style="background: #ff9f43; color:white;" /></div>
                        </div>
                    </form>
                    <a href="{{ route('expense.create') }}" class="btn btn-added" style="margin-right: 10px;">New
                        Expense</a>
                    <a href="/expense_pdfexport/{{ $today }}" target="_blank" class="btn btn-sucess"
                        style="margin-right:5px; background: #ff2116; color:white;">PDF</a>
                    <a href="/expense_excelexport/{{ $today }}" target="_blank" class="btn btn-sucess"
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
                                <th>S.No</th>
                                <th>Particulars</th>
                                <th>Total Price</th>
                                <th>Payment Mode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expense_data as $keydata => $datas)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>
                                    @foreach ($datas['terms'] as $index => $terms_array)
                                                    @if ($terms_array['expense_id'] == $datas['id'])
                                                    {{ $terms_array['note'] }} - {{ $terms_array['price'] }}<br/>
                                                    @endif
                                                    @endforeach
                                    </td>
                                    <td>
                                        {{ $datas['total_price'] }}
                                    </td>
                                    <td> {{ $datas['bank'] }}</td>
                                    <td>

                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            {{-- <li>
                                                <a href="expenseview{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $datas['id'] }}"
                                                    data-bs-target=".expenseview-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges bg-lightred expenseview" style="color: white">View</a>

                                            </li> --}}
                                            <li>
                                                <a href="{{ route('expense.edit', ['unique_key' => $datas['unique_key']]) }}"
                                                    class="badges bg-warning" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $datas['unique_key'] }}"
                                                    data-bs-target=".expensedelete-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <div class="modal fade expenseview-modal-xl{{ $datas['unique_key'] }}" tabindex="-1"
                                    role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.expense.view')
                                </div>
                                <div class="modal fade expensedelete-modal-xl{{ $datas['unique_key'] }}" tabindex="-1"
                                    role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}" aria-hidden="true">
                                    @include('page.backend.expense.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
