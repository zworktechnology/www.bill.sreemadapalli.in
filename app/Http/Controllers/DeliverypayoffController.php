<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Deliveryboypayoff;
use App\Models\Deliveryboypayoffdata;
use App\Models\Deliveryboy;
use App\Models\Deliveryattendance;
use App\Models\Deliveryattendancedata;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class DeliverypayoffController extends Controller
{

   public function index()
   {
       
       $today = Carbon::now()->format('Y-m-d');
       $data = Deliveryboypayoff::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
       $payoffdata = [];
       foreach ($data as $key => $datas) {

           $deliveryboy = Deliveryboy::findOrFail($datas->deliveryboy_id);

           $payoffdata[] = array(
               'date' => $datas->date,
               'month' => $datas->month,
               'year' => $datas->year,
               'deliveryboy_id' => $datas->deliveryboy_id,
               'deliveryboy' => $deliveryboy->name,
               'perdaysalary' => $datas->perdaysalary,
               'amountgiven' => $datas->amountgiven,
               'status' => $datas->status,
               'payoffnotes' => $datas->payoffnotes,
               'id' => $datas->id,
               'unique_key' => $datas->unique_key
           );
       }
       $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
       $timenow = Carbon::now()->format('H:i');
       return view('page.backend.deliveryboyspayoff.index', compact('payoffdata', 'deliveryboy', 'today', 'timenow'));
   }


   public function datefilter(Request $request) {
      $today = $request->get('from_date');
      
      $data = Deliveryboypayoff::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
      $payoffdata = [];
      foreach ($data as $key => $datas) {

          $deliveryboy = Deliveryboy::findOrFail($datas->deliveryboy_id);

          $payoffdata[] = array(
            'date' => $datas->date,
            'month' => $datas->month,
            'year' => $datas->year,
            'deliveryboy_id' => $datas->deliveryboy_id,
            'deliveryboy' => $deliveryboy->name,
            'perdaysalary' => $datas->perdaysalary,
            'amountgiven' => $datas->amountgiven,
            'status' => $datas->status,
            'payoffnotes' => $datas->payoffnotes,
            'id' => $datas->id,
            'unique_key' => $datas->unique_key
        );
      }
      $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
      $timenow = Carbon::now()->format('H:i');
      return view('page.backend.deliveryboyspayoff.index', compact('payoffdata', 'deliveryboy', 'today', 'timenow'));
   }


   public function create()
    {
        
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $maxDays=date('t');

        $years = date('Y', strtotime($today)) - 1;
        $years_arr = array($years, $years+1, $years+2);
        //$shiftatend = Empattendancedata::where('employee_id', '=', $employee_id)->first();

        $current_year = Carbon::now()->format('Y');


            $atendance_output = [];
        
            $Deliveryboysarr = Deliveryboy::where('soft_delete', '!=', 1)->get();
            foreach ($Deliveryboysarr as $key => $Deliveryboys_arr) {

                $perday_Salary = $Deliveryboys_arr->perdaysalary;

                $GetPresentornot = Deliveryattendancedata::where('deliveryboy_id', '=', $Deliveryboys_arr->id)->where('date', '=', $today)->where('attendance', '=', 'Present')->first();
                if($GetPresentornot != ""){

                    $Attendance_status = 'Present';

                    $paidsalary = Deliveryboypayoff::where('deliveryboy_id', '=', $Deliveryboys_arr->id)->where('date', '=', $today)->first();
                    if($paidsalary != ""){

                        $paid_salary = $paidsalary->amountgiven;
                    }else {
                        $paid_salary = 0;
                    }
                    $balanceAmount = $perday_Salary - $paid_salary;

                    if($paid_salary == 0){
                        $placeholder = 'Enter Amount';
                        $readonly = '';
                        $noteplaceholder = 'Enter Note';
                    }else {
                        if($balanceAmount == 0){
                            $readonly = 'readonly';
                            $placeholder = '';
                            $noteplaceholder = '';
                        }else {
                            $readonly = '';
                            $placeholder = 'Enter Amount';
                            $noteplaceholder = 'Enter Note';
                            
                        }
                    }
                

               
                    // $days = cal_days_in_month( 0, $salary_month, $year);
                    $atendance_output[] = array(
                        'Attendance_status' => $Attendance_status,
                        'readonly' => $readonly,
                        'placeholder' => $placeholder,
                        'noteplaceholder' => $noteplaceholder,
                        'perdaysalary' => $Deliveryboys_arr->perdaysalary,
                        'Deliveryboy' => $Deliveryboys_arr->name,
                        'id' => $Deliveryboys_arr->id,
                        'paid_salary' => $paid_salary,
                        'balanceAmount' => $balanceAmount,
                    );
                }
            
            }
       
        return view('page.backend.deliveryboyspayoff.create', compact('Deliveryboy', 'today', 'timenow', 'maxDays', 'years_arr', 'current_year', 'atendance_output'));
    }


    public function store(Request $request)
    {
        $date = $request->get('date');
        $salrymonth = $request->get('salary_month');


        foreach ($request->get('salaryamountgiven') as $key => $salaryamountgiven) {
            if($request->salaryamountgiven[$key] != ""){

                $paidsalary = Deliveryboypayoff::where('deliveryboy_id', '=', $request->Deliveryboy_id[$key])->where('date', '=', $request->get('date'))->first();
                if($paidsalary != ""){

                    $old_salary_amount = $paidsalary->amountgiven;
                    $new_salary_amount = $salaryamountgiven;
                    $totalsalry = $old_salary_amount + $new_salary_amount;

                    $paidsalary->amountgiven = $totalsalry;
                    $paidsalary->payoffnotes = $request->payoffnotes[$key];
                    $paidsalary->update();
                    

                }else {
                    $randomkey = Str::random(5);

                    $Deliveryboypayoff = new Deliveryboypayoff();
    
                    $Deliveryboypayoff->unique_key = $randomkey;
                    $Deliveryboypayoff->date = $request->get('date');
                    $Deliveryboypayoff->month = date('m', strtotime($request->get('date')));
                    $Deliveryboypayoff->year = date('Y', strtotime($request->get('date')));
                    $Deliveryboypayoff->deliveryboy_id = $request->Deliveryboy_id[$key];
                    $Deliveryboypayoff->perdaysalary = $request->perdaysalary[$key];
                    $Deliveryboypayoff->amountgiven = $salaryamountgiven;
                    $Deliveryboypayoff->status = 1;
                    $Deliveryboypayoff->payoffnotes = $request->payoffnotes[$key];
                    $Deliveryboypayoff->save();
                }

                    
            }
        }

        

        return redirect()->route('deliveryboyspayoff.index')->with('message', 'Data added successfully!');
            
    }



   


    public function update(Request $request, $unique_key)
    {
        $Deliveryboypayoff = Deliveryboypayoff::where('unique_key', '=', $unique_key)->first();
        $Deliveryboypayoff->amountgiven = $request->get('amountgiven');
        $Deliveryboypayoff->payoffnotes = $request->get('note');
        $Deliveryboypayoff->update();

        return redirect()->route('deliveryboyspayoff.index')->with('message', 'Data updated successfully!');
    }



    public function getdeliveryboy_payoff()
    {
        $deliverypayoff_date = request()->get('deliverypayoff_date');


        $atendance_output = [];
        
        $Deliveryboysarr = Deliveryboy::where('soft_delete', '!=', 1)->get();
        foreach ($Deliveryboysarr as $key => $Deliveryboys_arr) {

            $perday_Salary = $Deliveryboys_arr->perdaysalary;

            $GetPresentornot = Deliveryattendancedata::where('deliveryboy_id', '=', $Deliveryboys_arr->id)->where('date', '=', $deliverypayoff_date)->where('attendance', '=', 'Present')->first();
            if($GetPresentornot != ""){

                $Attendance_status = 'Present';

                $paidsalary = Deliveryboypayoff::where('deliveryboy_id', '=', $Deliveryboys_arr->id)->where('date', '=', $deliverypayoff_date)->first();
                if($paidsalary != NULL){

                    $paid_salary = $paidsalary->amountgiven;
                    $payoffnotes = $paidsalary->payoffnotes;
                }else {
                    $paid_salary = 0;
                    $payoffnotes = '';
                }
                $balanceAmount = $perday_Salary - $paid_salary;

                if($paid_salary == 0){
                    $placeholder = 'Enter Amount';
                    $readonly = '';
                    $noteplaceholder = 'Enter Note';
                }else {
                    if($balanceAmount == 0){
                        $readonly = 'readonly';
                        $placeholder = '';
                        $noteplaceholder = '';
                    }else {
                        $readonly = '';
                        $placeholder = 'Enter Amount';
                        $noteplaceholder = 'Enter Note';
                        
                    }
                }

           
                // $days = cal_days_in_month( 0, $salary_month, $year);
                $atendance_output[] = array(
                    'Attendance_status' => $Attendance_status,
                    'readonly' => $readonly,
                    'placeholder' => $placeholder,
                    'noteplaceholder' => $noteplaceholder,
                    'perdaysalary' => $Deliveryboys_arr->perdaysalary,
                    'Deliveryboy' => $Deliveryboys_arr->name,
                    'id' => $Deliveryboys_arr->id,
                    'paid_salary' => $paid_salary,
                    'balanceAmount' => $balanceAmount,
                    'payoffnotes' => $payoffnotes,
                );
            }
        
        }



            echo json_encode($atendance_output);
    }

}
