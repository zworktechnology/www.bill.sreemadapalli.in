<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Models\Purchaseproduct;
use App\Models\Sale;
use App\Models\Salespayment;
use App\Models\SaleProduct;
use App\Models\Expense;
use App\Models\Bank;
use App\Models\Session;
use App\Models\Closeaccount;
use App\Models\Openaccount;
use App\Models\Denomination;


use App\Models\Employee;
use App\Models\Deliveryboy;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Empattendancedata;
use App\Models\Deliveryattendancedata;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $today = Carbon::now()->format('Y-m-d');


            $total_purchase_amt_billing = Purchase::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');
            if($total_purchase_amt_billing != ""){
                $tot_purchaseAmount = $total_purchase_amt_billing;
            }else {
                $tot_purchaseAmount = '0';
            }


            $total_sale_amt_billing = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');
            if($total_sale_amt_billing != ""){
                $tot_saleAmount = $total_sale_amt_billing;
            }else {
                $tot_saleAmount = '0';
            }

            $total_expense_amt_billing = Expense::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('total_price');
            if($total_expense_amt_billing != ""){
                $tot_expenseAmount = $total_expense_amt_billing;
            }else {
                $tot_expenseAmount = '0';
            }


            $PaymentMode = Bank::where('soft_delete', '!=', 1)->get();
            $salepaymentmode_table = [];
            foreach ($PaymentMode as $key => $PaymentModes) {
                
                $totalsaleamt_billing = Sale::where('soft_delete', '!=', 1)->where('payment_method', '=', $PaymentModes->name)->where('date', '=', $today)->sum('grandtotal');
                if($totalsaleamt_billing != 0){
                    $totsaleAmount = $totalsaleamt_billing;
                }else {
                    $totsaleAmount = '';
                }


                $totalpurchaseamt_payment = Purchase::where('soft_delete', '!=', 1)->where('payment_method', '=', $PaymentModes->id)->where('date', '=', $today)->sum('grandtotal');
                if($totalpurchaseamt_payment != 0){
                    $totalpurchase_payment = $totalpurchaseamt_payment;
                }else {
                    $totalpurchase_payment = '';
                }


                $salepaymentmode_table[] = array(
                    'name' => $PaymentModes->name,
                    'totsaleAmount' => $totsaleAmount,
                    'totalpurchase_payment' => $totalpurchase_payment,
                );

            }


            $Employee = Employee::where('soft_delete', '!=', 1)->get();
            $total_Employee = count(collect($Employee));


            $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
            $total_Deliveryboy = count(collect($Deliveryboy));


            $Customer = Customer::where('soft_delete', '!=', 1)->get();
            $total_Customer = count(collect($Customer));

            
            $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
            $total_Supplier = count(collect($Supplier));



            $allemployee = Employee::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
            $allemployee_attendance = [];
            foreach ($allemployee as $key => $allemployees) {

                $checkEmpPresentAbsent = Empattendancedata::where('employee_id', '=', $allemployees->id)->where('date', '=', $today)->where('checkleave', '=', 0)->first();

                if($checkEmpPresentAbsent != ""){
                    if($checkEmpPresentAbsent->attendance == 'Present'){
                        $attendance = 'P';
                    }else if($checkEmpPresentAbsent->attendance == 'Absent'){
                        $attendance = 'A';
                    }else if($checkEmpPresentAbsent->attendance == 'Leave'){
                        $attendance = 'L';
                    }else if($checkEmpPresentAbsent->attendance == 'Sick Leave'){
                        $attendance = 'SL';
                    }else{
                        $attendance = '';
                    }

                    $allemployee_attendance[] = array(
                        'name' => $allemployees->name,
                        'attendance' => $attendance,
                    );
                }else {
                    $attendance = '';

                    $allemployee_attendance[] = array(
                        'name' => $allemployees->name,
                        'attendance' => $attendance,
                    );
                }
            }




            $alldeliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
            $alldeliveryboy_attendance = [];
            foreach ($alldeliveryboy as $key => $alldeliveryboys) {

                    $Session = Session::where('soft_delete', '!=', 1)->get();
                    foreach ($Session as $key => $Sessions) {

                        $checkdeliveryboyPresentAbsent = Deliveryattendancedata::where('deliveryboy_id', '=', $alldeliveryboys->id)->where('session_id', '=', $Sessions->id)->where('date', '=', $today)->where('checkleave', '=', 0)->first();
                        if($checkdeliveryboyPresentAbsent != ""){

                            

                            
                                if($checkdeliveryboyPresentAbsent->attendance == 'Present'){
                                    $attendance = 'P';
                                }else if($checkdeliveryboyPresentAbsent->attendance == 'Absent'){
                                    $attendance = 'A';
                                }
                                $deliveryboyid = $checkdeliveryboyPresentAbsent->deliveryboy_id;
    
                                $alldeliveryboy_attendance[] = array(
                                    'session_id' => $Sessions->id,
                                    'deliveryboy_id' => $deliveryboyid,
                                    'attendance' => $attendance,
                                );
    
    
                            
                        }else if($checkdeliveryboyPresentAbsent == ""){
                            $attendance = '';
                            $deliveryboyid = '';


                            $alldeliveryboy_attendance[] = array(
                                'session_id' => $Sessions->id,
                                'deliveryboy_id' => $alldeliveryboys->id,
                                'attendance' => $attendance,
                            );
                        }
                        
                    }
            }

            $sessionarr = Session::where('soft_delete', '!=', 1)->get();

            $Openaccountdata = Openaccount::where('date', '=', $today)->sum('amount');
            $Saledata = Sale::where('date', '=', $today)->sum('grandtotal');
            $Denominationdata = Denomination::where('date', '=', $today)->sum('total_amount');

            $open_sales = $Openaccountdata + $Saledata;
            $total_expense = Expense::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('total_price');

            $open_sales_exp = (($Openaccountdata + $Saledata) - $total_expense);

           $cash = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('cash');
           $card = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('card');
           $paytm_business = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('paytm_business');
           $paytm = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('paytm');
           $phonepe_business = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('phonepe_business');
           $phonepe = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('phonepe');
           $gpay_business = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('gpay_business');
           $gpay = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('gpay');

           $totalpayment_methods = $cash + $card + $paytm_business + $paytm + $paytm + $phonepe_business + $phonepe + $gpay_business + $gpay;

           $Salespaymentdata = Salespayment::where('date', '=', $today)->sum('paid_amount');


    $total_card_one = $Denominationdata + $totalpayment_methods + $Saledata + $Salespaymentdata;

    if ($open_sales_exp < 0) {
        $over_all = $total_card_one + $open_sales_exp;
    } else {
        $over_all = $total_card_one - $open_sales_exp;
    }
            

        return view('home', compact('today', 'tot_purchaseAmount', 'tot_saleAmount', 'tot_expenseAmount', 'salepaymentmode_table', 'total_Employee', 'total_Deliveryboy',
         'total_Customer', 'total_Supplier', 'allemployee_attendance', 'alldeliveryboy_attendance', 'sessionarr', 'alldeliveryboy', 'Openaccountdata', 'Denominationdata',
          'card', 'paytm_business', 'paytm', 'phonepe_business', 'phonepe', 'gpay_business', 'gpay', 'cash', 'totalpayment_methods', 'Saledata', 'open_sales', 
          'total_expense', 'open_sales_exp', 'over_all'));
    }





    public function datefilter(Request $request) {


        $today = $request->get('from_date');

            $total_purchase_amt_billing = Purchase::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');
            if($total_purchase_amt_billing != ""){
                $tot_purchaseAmount = $total_purchase_amt_billing;
            }else {
                $tot_purchaseAmount = '0';
            }


            $total_sale_amt_billing = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');
            if($total_sale_amt_billing != ""){
                $tot_saleAmount = $total_sale_amt_billing;
            }else {
                $tot_saleAmount = '0';
            }

            $total_expense_amt_billing = Expense::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('total_price');
            if($total_expense_amt_billing != ""){
                $tot_expenseAmount = $total_expense_amt_billing;
            }else {
                $tot_expenseAmount = '0';
            }


            $PaymentMode = Bank::where('soft_delete', '!=', 1)->get();
            $salepaymentmode_table = [];
            foreach ($PaymentMode as $key => $PaymentModes) {
                
                $totalsaleamt_billing = Sale::where('soft_delete', '!=', 1)->where('payment_method', '=', $PaymentModes->name)->where('date', '=', $today)->sum('grandtotal');
                if($totalsaleamt_billing != 0){
                    $totsaleAmount = $totalsaleamt_billing;
                }else {
                    $totsaleAmount = '';
                }


                $totalpurchaseamt_payment = Purchase::where('soft_delete', '!=', 1)->where('payment_method', '=', $PaymentModes->id)->where('date', '=', $today)->sum('grandtotal');
                if($totalpurchaseamt_payment != 0){
                    $totalpurchase_payment = $totalpurchaseamt_payment;
                }else {
                    $totalpurchase_payment = '';
                }


                $salepaymentmode_table[] = array(
                    'name' => $PaymentModes->name,
                    'totsaleAmount' => $totsaleAmount,
                    'totalpurchase_payment' => $totalpurchase_payment,
                );

            }


            $Employee = Employee::where('soft_delete', '!=', 1)->get();
            $total_Employee = count(collect($Employee));


            $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
            $total_Deliveryboy = count(collect($Deliveryboy));


            $Customer = Customer::where('soft_delete', '!=', 1)->get();
            $total_Customer = count(collect($Customer));

            
            $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
            $total_Supplier = count(collect($Supplier));



            $allemployee = Employee::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
            $allemployee_attendance = [];
            foreach ($allemployee as $key => $allemployees) {

                $checkEmpPresentAbsent = Empattendancedata::where('employee_id', '=', $allemployees->id)->where('date', '=', $today)->where('checkleave', '=', 0)->first();

                if($checkEmpPresentAbsent != ""){
                    if($checkEmpPresentAbsent->attendance == 'Present'){
                        $attendance = 'P';
                    }else if($checkEmpPresentAbsent->attendance == 'Absent'){
                        $attendance = 'A';
                    }else if($checkEmpPresentAbsent->attendance == 'Leave'){
                        $attendance = 'L';
                    }else if($checkEmpPresentAbsent->attendance == 'Sick Leave'){
                        $attendance = 'SL';
                    }else{
                        $attendance = '';
                    }

                    $allemployee_attendance[] = array(
                        'name' => $allemployees->name,
                        'attendance' => $attendance,
                    );
                }else {
                    $attendance = '';

                    $allemployee_attendance[] = array(
                        'name' => $allemployees->name,
                        'attendance' => $attendance,
                    );
                }
            }



            $alldeliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
            $alldeliveryboy_attendance = [];
            foreach ($alldeliveryboy as $key => $alldeliveryboys) {

                    $Session = Session::where('soft_delete', '!=', 1)->get();
                    foreach ($Session as $key => $Sessions) {

                        $checkdeliveryboyPresentAbsent = Deliveryattendancedata::where('deliveryboy_id', '=', $alldeliveryboys->id)->where('session_id', '=', $Sessions->id)->where('date', '=', $today)->where('checkleave', '=', 0)->first();
                        if($checkdeliveryboyPresentAbsent != ""){

                            

                            
                                if($checkdeliveryboyPresentAbsent->attendance == 'Present'){
                                    $attendance = 'P';
                                }else if($checkdeliveryboyPresentAbsent->attendance == 'Absent'){
                                    $attendance = 'A';
                                }
                                $deliveryboyid = $checkdeliveryboyPresentAbsent->deliveryboy_id;
    
                                $alldeliveryboy_attendance[] = array(
                                    'session_id' => $Sessions->id,
                                    'deliveryboy_id' => $deliveryboyid,
                                    'attendance' => $attendance,
                                );
    
    
                            
                        }else if($checkdeliveryboyPresentAbsent == ""){
                            $attendance = '';
                            $deliveryboyid = '';


                            $alldeliveryboy_attendance[] = array(
                                'session_id' => $Sessions->id,
                                'deliveryboy_id' => $alldeliveryboys->id,
                                'attendance' => $attendance,
                            );
                        }
                        
                    }
            }

            $sessionarr = Session::where('soft_delete', '!=', 1)->get();

            $Openaccountdata = Openaccount::where('date', '=', $today)->sum('amount');
            $Saledata = Sale::where('date', '=', $today)->sum('grandtotal');
            $Denominationdata = Denomination::where('date', '=', $today)->sum('total_amount');

            $open_sales = $Openaccountdata + $Saledata;
            $total_expense = Expense::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('total_price');

            $open_sales_exp = (($Openaccountdata + $Saledata) - $total_expense);

           $cash = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('cash');
           $card = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('card');
           $paytm_business = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('paytm_business');
           $paytm = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('paytm');
           $phonepe_business = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('phonepe_business');
           $phonepe = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('phonepe');
           $gpay_business = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('gpay_business');
           $gpay = Closeaccount::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('gpay');

           $totalpayment_methods = $cash + $card + $paytm_business + $paytm + $paytm + $phonepe_business + $phonepe + $gpay_business + $gpay;

           $Salespaymentdata = Salespayment::where('date', '=', $today)->sum('paid_amount');


    $total_card_one = $Denominationdata + $totalpayment_methods + $Saledata + $Salespaymentdata;

    if ($open_sales_exp < 0) {
        $over_all = $total_card_one + $open_sales_exp;
    } else {
        $over_all = $total_card_one - $open_sales_exp;
    }
            

        return view('home', compact('today', 'tot_purchaseAmount', 'tot_saleAmount', 'tot_expenseAmount', 'salepaymentmode_table', 'total_Employee', 'total_Deliveryboy',
         'total_Customer', 'total_Supplier', 'allemployee_attendance', 'alldeliveryboy_attendance', 'sessionarr', 'alldeliveryboy', 'Openaccountdata', 'Denominationdata',
          'card', 'paytm_business', 'paytm', 'phonepe_business', 'phonepe', 'gpay_business', 'gpay', 'cash', 'totalpayment_methods', 'Saledata', 'open_sales', 
          'total_expense', 'open_sales_exp', 'over_all'));
    }
}
