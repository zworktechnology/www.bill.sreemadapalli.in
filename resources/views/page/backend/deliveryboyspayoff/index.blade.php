@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Delivery Boy - Payoff</h4>
            </div>
            <div class="page-btn">
                <div style="display: flex;">
                    <form autocomplete="off" method="POST" action="{{ route('deliveryboyspayoff.datefilter') }}">
                        @method('PUT')
                        @csrf
                        <div style="display: flex">
                            <div style="margin-right: 10px;"><input type="date" name="from_date"
                                    class="form-control from_date" value="{{ $today }}"></div>
                            <div style="margin-right: 10px;"><input type="submit" class="btn btn-success" value="Search" />
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('deliveryboyspayoff.create') }}" class="btn btn-added" style="margin-right: 10px;">Add
                        New</a>
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
                                <th>Date</th>
                                <th>Delivery Boy</th>
                                <th>Salary Amount</th>
                                <th>Paid Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payoffdata as $keydata => $datas)
                                <tr>
                                <td>{{ ++$keydata }}</td>
                                    <td> {{ date('d-m-Y', strtotime($datas['date'])) }}</td>
                                    <td>{{ $datas['deliveryboy'] }}</td>
                                    <td> {{ $datas['perdaysalary'] }}</td>
                                    <td> {{ $datas['amountgiven'] }}</td>
                                    <td>

                                        <ul class="list-unstyled hstack gap-1 mb-0">

                                                <li>
                                                <a href="#edit{{ $datas['unique_key'] }}" data-bs-toggle="modal"  data-id="{{ $datas['unique_key'] }}"
                                                data-bs-target=".deliverypayoffedit-modal-xl{{ $datas['unique_key'] }}" class="badges bg-warning" style="color: white">Edit</a>
                                             </li>
                                        </ul>
                                    </td>
                                </tr>
                                <div class="modal fade deliverypayoffedit-modal-xl{{ $datas['unique_key'] }}"
                                            tabindex="-1" role="dialog" data-bs-backdrop="static"
                                            aria-labelledby="editLargeModalLabel{{ $datas['unique_key'] }}"
                                            aria-hidden="true">
                                            @include('page.backend.deliveryboyspayoff.edit')
                                        </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
