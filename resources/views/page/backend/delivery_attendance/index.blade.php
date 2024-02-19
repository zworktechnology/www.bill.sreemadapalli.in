                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Delivery Attendance</h4>
                <p style="color:lightgray">( Delivery Attendance Details )</p>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('delivery_attendance.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                        <a href="{{ route('delivery_attendance.breakfastcreate') }}" class="btn btn-added" style="margin-right: 10px;background:darkcyan;">Morning</a>
                        <a href="{{ route('delivery_attendance.lunchcreate') }}" class="btn btn-added" style="margin-right: 10px;background:goldenrod;">Evening</a>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">

                    <div class="row">

                                        <div class="col-sm-2">
                                            <table class="table ">
                                                <thead>
                                                    <tr>
                                                        <th class="border">Date</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="border" style="padding: 13px;">Day</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="border" style="padding: 12px;">Shift</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="border" style="padding: 13px;">Add / Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($Deliveryboy as $Deliveryboys)
                                                        <tr class="border"></tr>
                                                        <td class="border" >{{$Deliveryboys->name}}</td>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-sm-10" style="overflow: auto;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        @foreach ($list as $lists)
                                                            <th colspan="2" class="border" style="text-align:center;">{{ $lists }}</th>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach ($list as $lists_ass)
                                                        @php 
                                                        
                                                        $timestamp = strtotime($year .'-'. $month .'-'. $lists_ass); 
                                                        $day = date('l', $timestamp);
                                                        $date = $year .'-'. $month .'-'. $lists_ass;
                                                        @endphp

                                                        
                                                                <th class="border" colspan="2" style="text-align:center;">
                                                                    <a href="#dayedit{{ $date }}" data-bs-toggle="modal" data-bs-target=".dayedit-modal-xl{{ $date }}"
                                                                                    class="badges bg-lightyellow dayedit{{ $date }}" style="color: white">{{$day}}</a>
                                                                </th>
                                                                <div class="modal fade dayedit-modal-xl{{ $date }}"
                                                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                                    aria-labelledby="deleteLargeModalLabel{{ $date }}"
                                                                    aria-hidden="true">
                                                                    @include('page.backend.delivery_attendance.dayedit')
                                                                </div>

                                                        
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach ($list as $lists)
                                                        <th class="border" style="color:#d38625;font-weight: 700;font-size:15px;">Mor</th>
                                                        <th class="border" style="color:#7367f0;font-weight: 700;font-size:15px;">Eve</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="background-color: #fafbfe">
                                                        @foreach ($list as $lists)
                                                    @foreach ($shift_arr as $shift_array)
                                                            <td class="border"><a href="{{ route('delivery_attendance.edit', ['date' => $year.'-'.$month. '-'.$lists, 'shift' => $shift_array]) }}" class="btn btn-sm btn-soft-info">
                                                            <i class="fa fa-edit" data-bs-toggle="tooltip" title="fa fa-edit"></i></a></td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                                <tbody>
                                                    @foreach ($Deliveryboy as $Deliveryboyarr)
                                                    <tr class="border">

                                                        @foreach ($attendence_Data as $attendence_Data_arr)
                                                            @if ($Deliveryboyarr->id == $attendence_Data_arr['deliveryboyid'])

                                                                @if ($attendence_Data_arr['attendence_status'] == 'P')
                                                                    <td class="border" style="color:green;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                                                @elseif ($attendence_Data_arr['attendence_status'] == 'A')
                                                                    <td class="border" style="color:red;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                                                @elseif($attendence_Data_arr['attendence_status'] == 'NULL')
                                                                    <td class="border" style="color:#76691b;font-weight: 800;">H</td>
                                                                    @else
                                                                    <td class="border" style="color:white">No</td>
                                                                @endif

                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
