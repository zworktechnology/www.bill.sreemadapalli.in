<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Deliveryboy;
use App\Models\Deliveryattendance;
use App\Models\Deliveryattendancedata;
use App\Models\Session;
use App\Models\Deliveryboypayoff;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;
class DeliveryattendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $time = strtotime($today);
        $curent_month = date("F",$time);


        $month = date("m",strtotime($today));
        $year = date("Y",strtotime($today));

        $list=array();
        $monthdates = [];
        $maxDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($d=1; $d<=$maxDays; $d++)
        {
            $times = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $times) == $month)
                $list[] = date('d', $times);
                $monthdates[] = date('Y-m-d', $times);
        }
        $attendence_Data = [];

        $shift_arr = array(1,2);

        foreach (($monthdates) as $key => $monthdate_arr) {

            foreach (($shift_arr) as $key => $shift_arrays) {

            $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();

            foreach ($deliveryboy as $key => $deliveryboy_arr) {

                    $status = '';
                $attendencedata = Deliveryattendancedata::where('deliveryboy_id', '=', $deliveryboy_arr->id)->where('date', '=', $monthdate_arr)
                                                        ->where('shift', '=', $shift_arrays)->first();
                    if($attendencedata != ""){

                        if($attendencedata->checkleave == 1){
                            if($attendencedata->attendance == 'Present'){
                                $status = 'NULL';
                            }
                            $attendence_id = $attendencedata->id;

                        }else if($attendencedata->checkleave == 0){

                            if($attendencedata->attendance == 'Present'){
                                $status = 'P';
                            }else if($attendencedata->attendance == 'Absent'){
                                $status = 'A';
                            }
                            $attendence_id = $attendencedata->id;
                        }
                        
                    }else {
                        $attendence_id = 0;
                    }
    
    
                    $attendence_Data[] = array(
                        'deliveryboy' => $deliveryboy_arr->name,
                        'deliveryboyid' => $deliveryboy_arr->id,
                        'attendence_status' => $status,
                        'date' => date("d",strtotime($monthdate_arr)),
                        'attendence_id' => $attendence_id
                    );
                }
                
                
            }
        }
        


        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        
        return view('page.backend.delivery_attendance.index', compact('attendence_Data', 'today', 'timenow', 'Deliveryboy', 'curent_month', 'year', 'list', 'shift_arr', 'monthdates', 'month'));
    }


    public function datefilter(Request $request) {
        $today = $request->get('from_date');

        $time = strtotime($today);
        $curent_month = date("F",$time);


        $month = date("m",strtotime($today));
        $year = date("Y",strtotime($today));

        $list=array();
        $monthdates = [];

        $maxDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for($d=1; $d<=$maxDays; $d++)
        {
            $times = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $times) == $month)
                $list[] = date('d', $times);
                $monthdates[] = date('Y-m-d', $times);
        }
        $attendence_Data = [];

        $shift_arr = array(1,2);

        foreach (($monthdates) as $key => $monthdate_arr) {
            foreach (($shift_arr) as $key => $shift_arrays) {

            $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();

            foreach ($deliveryboy as $key => $deliveryboy_arr) {
            

                    $status = '';
                    $attendencedata = Deliveryattendancedata::where('deliveryboy_id', '=', $deliveryboy_arr->id)->where('date', '=', $monthdate_arr)
                                ->where('shift', '=', $shift_arrays)->first();
                    if($attendencedata != ""){

                        if($attendencedata->checkleave == 1){
                            if($attendencedata->attendance == 'Present'){
                                $status = 'NULL';
                            }
                            $attendence_id = $attendencedata->id;
                            
                        }else if($attendencedata->checkleave == 0){

                            if($attendencedata->attendance == 'Present'){
                                $status = 'P';
                            }else if($attendencedata->attendance == 'Absent'){
                                $status = 'A';
                            }
                            $attendence_id = $attendencedata->id;
                        }
                        
                    }else {
                        $attendence_id = 0;
                    }
    
    
                    $attendence_Data[] = array(
                        'deliveryboy' => $deliveryboy_arr->name,
                        'deliveryboyid' => $deliveryboy_arr->id,
                        'attendence_status' => $status,
                        'date' => date("d",strtotime($monthdate_arr)),
                        'attendence_id' => $attendence_id
                    );
                }
                
                
            }
        }
        

        


        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        
        return view('page.backend.delivery_attendance.index', compact('attendence_Data', 'today', 'timenow', 'Deliveryboy', 'curent_month', 'year', 'list', 'shift_arr', 'monthdates', 'month'));
    }


    public function create()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.create', compact('deliveryboy', 'today', 'timenow', 'session'));
    }



    public function breakfastcreate()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.breakfastcreate', compact('deliveryboy', 'today', 'timenow', 'session'));
    }


    public function lunchcreate()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.lunchcreate', compact('deliveryboy', 'today', 'timenow', 'session'));
    }


    public function dinnercreate()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.dinnercreate', compact('deliveryboy', 'today', 'timenow', 'session'));
    }



    public function store(Request $request)
    {
        $date = $request->get('date');
        $shift = $request->get('shift');

        $dateatend = Deliveryattendance::where('date', '=', $date)->where('shift', '=', $shift)->first();
        if($dateatend == ""){

            $randomkey = Str::random(5);

            $data = new Deliveryattendance();
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->time = $request->get('time');
            $data->month = date('m', strtotime($request->get('date')));
            $data->year = date('Y', strtotime($request->get('date')));
            $data->dateno = date('d', strtotime($request->get('date')));
            $data->shift = $request->get('shift');
            $data->save();

            $insertedId = $data->id;


            foreach ($request->get('deliveryboy_id') as $key => $deliveryboy_id) {
                

                $shiftatend = Deliveryattendancedata::where('date', '=', $request->get('date'))->where('deliveryboy_id', '=', $deliveryboy_id)->first();
                if($shiftatend == ""){
                    if($request->attendance[$deliveryboy_id] != ""){

                        $pprandomkey = Str::random(5);
                        $Deliveryattendancedata = new Deliveryattendancedata;
                        $Deliveryattendancedata->deliveryattendance_id = $insertedId;
                        $Deliveryattendancedata->deliveryboy_id = $deliveryboy_id;
                        $Deliveryattendancedata->deliveryboy = $request->deliveryboy[$key];
                        $Deliveryattendancedata->attendance = $request->attendance[$deliveryboy_id];
                        $Deliveryattendancedata->date = $request->get('date');
                        $Deliveryattendancedata->shift = $request->get('shift');
                        $Deliveryattendancedata->month = date('m', strtotime($request->get('date')));
                        $Deliveryattendancedata->year = date('Y', strtotime($request->get('date')));
                        $Deliveryattendancedata->save();
                    }
                }
    
                    
    
            }

            return redirect()->route('delivery_attendance.index')->with('message', 'Attendance Data added successfully!');
        }else {

            return redirect()->route('delivery_attendance.index')->with('warning', 'the delivery boy BreakFast attendance already registered..Please edit!');
        }
    }



   

    public function edit($date, $shift)
    {
        $Deliveryattendance = Deliveryattendance::where('date', '=', $date)->where('shift', '=', $shift)->first();
        if($Deliveryattendance != ""){
            if($shift == 1){
                $shiftname = 'Morning';
            }else if($shift == 2){
                $shiftname = 'Evening';
            }

            $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
            $today = Carbon::now()->format('Y-m-d');
            $timenow = Carbon::now()->format('H:i');
            $Deliveryattendancedata = Deliveryattendancedata::where('deliveryattendance_id', '=', $Deliveryattendance->id)->get();


            return view('page.backend.delivery_attendance.edit', compact('Deliveryattendance', 'deliveryboy', 'today', 'timenow', 'Deliveryattendancedata', 'shift', 'shiftname'));
        }else {
            if($shift == 1){

                $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                $today = $date;
                $timenow = Carbon::now()->format('H:i');
                $shiftname = 'Morning';

                return view('page.backend.delivery_attendance.breakfastcreate', compact('deliveryboy', 'today', 'timenow', 'shift', 'shiftname'));

            }else if($shift == 2){

                $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                $today = $date;
                $timenow = Carbon::now()->format('H:i');
                $shiftname = 'Evening';
        
                return view('page.backend.delivery_attendance.lunchcreate', compact('deliveryboy', 'today', 'timenow', 'shift', 'shiftname'));


            }
        }
        

        
    }


    public function update(Request $request, $unique_key)
    {
        $delivery_attendance = Deliveryattendance::where('unique_key', '=', $unique_key)->first();

        $delivery_attendance->date = $request->get('date');
        $delivery_attendance->time = $request->get('time');
        $delivery_attendance->month = date('m', strtotime($request->get('date')));
        $delivery_attendance->year = date('Y', strtotime($request->get('date')));
        $delivery_attendance->dateno = date('d', strtotime($request->get('date')));
        $delivery_attendance->session_id = $request->get('session_id');
        $delivery_attendance->update();

        $attendance_id = $delivery_attendance->id;


        foreach ($request->get('deliveryboy_id') as $key => $deliveryboy_id) {
                
                $attendanceid = $attendance_id;
                $attendance = $request->attendance[$deliveryboy_id];

                DB::table('deliveryattendancedatas')->where('deliveryattendance_id', $attendanceid)->where('deliveryboy_id', $deliveryboy_id)->update([
                    'attendance' => $attendance
                ]);
        }


        return redirect()->route('delivery_attendance.index')->with('info', 'Updated !');


    }




    public function dayedit(Request $request, $date)
    {
        $Deliveryattendance = Deliveryattendance::where('date', '=', $date)->first();
        if($Deliveryattendance == ""){

            $shift_arr = array(1,2);
            foreach ($shift_arr as $key => $shift_arrs) {
                $derandomkey = Str::random(5);

                $data = new Deliveryattendance();
                $data->unique_key = $derandomkey;
                $data->date = $date;
                $data->month = date('m', strtotime($date));
                $data->year = date('Y', strtotime($date));
                $data->dateno = date('d', strtotime($date));
                $data->shift = $shift_arrs;
                $data->save();


                $insertedId = $data->id;


                $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                foreach ($Deliveryboy as $key => $Deliveryboy_arr) {

                    $Deliveryattendancedata = new Deliveryattendancedata;
                    $Deliveryattendancedata->deliveryattendance_id = $insertedId;
                    $Deliveryattendancedata->deliveryboy_id = $Deliveryboy_arr->id;
                    $Deliveryattendancedata->deliveryboy = $Deliveryboy_arr->name;
                    $Deliveryattendancedata->date = $date;
                    $Deliveryattendancedata->month = date('m', strtotime($date));
                    $Deliveryattendancedata->year = date('Y', strtotime($date));
                    $Deliveryattendancedata->attendance = 'Present';
                    $Deliveryattendancedata->shift = $shift_arrs;
                    $Deliveryattendancedata->checkleave = 1;
                    $Deliveryattendancedata->save();
                }
            }

           
    
            

            return redirect()->route('delivery_attendance.index')->with('info', 'Leave Updated !');
        }else {
            return redirect()->route('delivery_attendance.index')->with('warning', 'Attendance Added for this date. so you cannot change !');
        }

            

        
    }





}
