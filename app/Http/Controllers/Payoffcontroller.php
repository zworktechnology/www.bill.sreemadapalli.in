<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Payoff;
use App\Models\Payoffdata;
use App\Models\Employee;
use App\Models\Empattendance;
use App\Models\Empattendancedata;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class Payoffcontroller extends Controller
{
    public function index()
    {
        
        $today = Carbon::now()->format('Y-m-d');
        $data = Payoff::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $payoffdata = [];
        foreach ($data as $key => $datas) {

            $employee = Employee::findOrFail($datas->employee_id);

            $payoffdata[] = array(
                'date' => $datas->date,
                'month' => $datas->month,
                'year' => $datas->year,
                'employee_id' => $datas->employee_id,
                'employee' => $employee->name,
                'perdaysalary' => $datas->perdaysalary,
                'amountgiven' => $datas->amountgiven,
                'status' => $datas->status,
                'payoffnotes' => $datas->payoffnotes,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key
            );
        }
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');
        return view('page.backend.payoff.index', compact('payoffdata', 'employee', 'today', 'timenow'));
    }



    public function datefilter(Request $request) {
        $today = $request->get('from_date');
        $data = Payoff::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $payoffdata = [];
        foreach ($data as $key => $datas) {

            $employee = Employee::findOrFail($datas->employee_id);

            $payoffdata[] = array(
                'date' => $datas->date,
                'month' => $datas->month,
                'year' => $datas->year,
                'employee_id' => $datas->employee_id,
                'employee' => $employee->name,
                'perdaysalary' => $datas->perdaysalary,
                'amountgiven' => $datas->amountgiven,
                'status' => $datas->status,
                'payoffnotes' => $datas->payoffnotes,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key
            );
        }
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');
        return view('page.backend.payoff.index', compact('payoffdata', 'employee', 'today', 'timenow'));
    }

    public function create()
    {
        
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $maxDays=date('t');

        $years = date('Y', strtotime($today)) - 1;
        $years_arr = array($years, $years+1, $years+2);
        //$shiftatend = Empattendancedata::where('employee_id', '=', $employee_id)->first();

        $current_year = Carbon::now()->format('Y');


            $atendance_output = [];
        
            $Employee = Employee::where('soft_delete', '!=', 1)->get();
            foreach ($Employee as $key => $Employees_arr) {

                $perday_Salary = $Employees_arr->perdaysalary;

                $GetPresentornot = Empattendancedata::where('employee_id', '=', $Employees_arr->id)->where('date', '=', $today)->where('attendance', '=', 'Present')->first();
                if($GetPresentornot != ""){

                    $Attendance_status = 'Present';
                   
                    
               
              

                    $paidsalary = Payoff::where('employee_id', '=', $Employees_arr->id)->where('date', '=', $today)->first();
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
                        'perdaysalary' => $Employees_arr->perdaysalary,
                        'Employee' => $Employees_arr->name,
                        'id' => $Employees_arr->id,
                        'paid_salary' => $paid_salary,
                        'balanceAmount' => $balanceAmount,
                    );
                }
            
            }
       
        return view('page.backend.payoff.create', compact('employee', 'today', 'timenow', 'maxDays', 'years_arr', 'current_year', 'atendance_output'));
    }



    public function store(Request $request)
    {
        $date = $request->get('date');
        $salrymonth = $request->get('salary_month');

       

        foreach ($request->get('salaryamountgiven') as $key => $salaryamountgiven) {
            if($request->salaryamountgiven[$key] != ""){

                $paidsalary = Payoff::where('employee_id', '=', $request->employee_id[$key])->where('date', '=', $request->get('date'))->first();
                if($paidsalary != ""){

                    $old_salary_amount = $paidsalary->amountgiven;
                    $new_salary_amount = $salaryamountgiven;
                    $totalsalry = $old_salary_amount + $new_salary_amount;

                    $paidsalary->amountgiven = $totalsalry;
                    $paidsalary->payoffnotes = $request->payoffnotes[$key];
                    $paidsalary->update();
                    

                }else {
                    $randomkey = Str::random(5);

                    $Payoff = new Payoff();
    
                    $Payoff->unique_key = $randomkey;
                    $Payoff->date = $request->get('date');
                    $Payoff->month = date('m', strtotime($request->get('date')));
                    $Payoff->year = date('Y', strtotime($request->get('date')));
                    $Payoff->employee_id = $request->employee_id[$key];
                    $Payoff->perdaysalary = $request->perdaysalary[$key];
                    $Payoff->amountgiven = $salaryamountgiven;
                    $Payoff->status = 1;
                    $Payoff->payoffnotes = $request->payoffnotes[$key];
                    $Payoff->save();
                }

                    
            }
        }


        return redirect()->route('payoff.index')->with('message', 'Data added successfully!');
            
    }


   


    public function update(Request $request, $unique_key)
    {
        $Payoff_Data = Payoff::where('unique_key', '=', $unique_key)->first();
        $Payoff_Data->amountgiven = $request->get('amountgiven');
        $Payoff_Data->payoffnotes = $request->get('note');
        $Payoff_Data->update();

        return redirect()->route('payoff.index')->with('message', 'Data updated successfully!');
    }


    public function getpayoffdatas()
    {
        $payoff_date = request()->get('payoff_date');


        $atendance_output = [];
        
            $Employee = Employee::where('soft_delete', '!=', 1)->get();
            foreach ($Employee as $key => $Employees_arr) {

                $perday_Salary = $Employees_arr->perdaysalary;

                $GetPresentornot = Empattendancedata::where('employee_id', '=', $Employees_arr->id)->where('date', '=', $payoff_date)->where('attendance', '=', 'Present')->first();
                if($GetPresentornot != ""){

                    $Attendance_status = 'Present';
                   
                    
               
              

                    $paidsalary = Payoff::where('employee_id', '=', $Employees_arr->id)->where('date', '=', $payoff_date)->first();
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
                        'perdaysalary' => $Employees_arr->perdaysalary,
                        'Employee' => $Employees_arr->name,
                        'id' => $Employees_arr->id,
                        'paid_salary' => $paid_salary,
                        'balanceAmount' => $balanceAmount,
                        'payoffnotes' => $payoffnotes,
                    );
                }
            
            }



            echo json_encode($atendance_output);
    }
}
