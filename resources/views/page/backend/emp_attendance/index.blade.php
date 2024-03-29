@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Employee Attendance</h4>
                <p style="color:lightgray">( Employee Attendance Details )</p>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('emp_attendance.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                        <a href="{{ route('emp_attendance.shiftonecreate') }}" class="btn" style="margin-right: 10px; background-color:#d6903f; color:white;">Shift 1</a>
                        <a href="{{ route('emp_attendance.shifttwocreate') }}" class="btn" style="margin-right: 10px; background-color:#7470f2; color:white;">Shift 2</a>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body" style="overflow: auto;">


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
                                                    @foreach ($data as $datas_emp)
                                                        <tr class="border"></tr>
                                                        <td class="border" >{{$datas_emp->name}}</td>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-10" style="overflow: auto;">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        @foreach ($list as $lists)
                                                            <th class="border" style="text-align:center;" colspan="2">{{ $lists }}</th>
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
                                                                    @include('page.backend.emp_attendance.dayedit')
                                                                </div>

                                                        
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach ($list as $listsarr)
                                                        <th class="border" style="color:#d38625;font-weight: 800;">S1</th>
                                                        <th class="border" style="color:#7367f0;font-weight: 800;">S2</th>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach ($monthdates as $monthdate_arr)
                                                        @foreach ($shift_arr as $shift_array)
                                                            <td class="border"  style=""><a style="color: #6d91cc;" href="{{ route('emp_attendance.edit', ['date' => $monthdate_arr, 'shift' => $shift_array]) }}" class="btn btn-sm btn-soft-info">
                                                            <i class="fa fa-edit" data-bs-toggle="tooltip" title="fa fa-edit"></i></a></td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $employee)
                                                    <tr class="">

                                                        @foreach ($attendence_Data as $attendence_Data_arr)
                                                            @if ($employee->id == $attendence_Data_arr['empid'])

                                                                @if ($attendence_Data_arr['attendence_status'] == 'P')
                                                                    <td class="border" style="color:green;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                                                @elseif ($attendence_Data_arr['attendence_status'] == 'A')
                                                                    <td class="border" style="color:red;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                                                @elseif ($attendence_Data_arr['attendence_status'] == 'L')
                                                                    <td class="border" style="color:blue;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                                                @elseif ($attendence_Data_arr['attendence_status'] == 'SL')
                                                                    <td class="border" style="color:orange;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
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
