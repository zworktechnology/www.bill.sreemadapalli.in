@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>History</h4>
            </div>

           
        </div>

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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($saled_data as $keydata => $datas)
                                                    <tr>
                                                        <td>{{ $datas['bill_no'] }}</td>
                                                        <td> {{ $datas['date']  }}</td>
                                                        <td> {{ $datas['sales_type']  }}</td>
                                                        <td>{{ $datas['customer']}}</td>
                                                        <td>  {{$datas['payment_method']}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                </div>

            </div>

    </div>
@endsection
