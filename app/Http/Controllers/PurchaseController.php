<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Purchase;
use App\Models\PurchaseProductdata;
use App\Models\Supplier;
use App\Models\Purchaseproduct;
use App\Models\Bank;
use App\Models\Payment;
use App\Exports\PurchaseExport;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PurchaseController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Purchase::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchase_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $supplier_name = Supplier::findOrFail($datas->supplier_id);


            $payment_method = Bank::findOrFail($datas->payment_method);
            $purchase_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'voucher_no' => $datas->voucher_no,
                'date' => $datas->date,
                'time' => $datas->time,
                'supplier_id' => $datas->supplier_id,
                'supplier_name' => $supplier_name->name,
                'supplier_phone_number' => $supplier_name->phone_number,
                'supplier_address' => $supplier_name->address,
                'id' => $datas->id,
                'grandtotal' => $datas->grandtotal,
                'paidamount' => $datas->paidamount,
                'balanceamount' => $datas->balanceamount,
                'payment_method' => $payment_method->name,
            );

        }


        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.purchase.index', compact('purchase_data', 'today', 'timenow', 'Supplier', 'bank'));
    }

    public function datefilter(Request $request) {
        $today = $request->get('from_date');

        $data = Purchase::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchase_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $supplier_name = Supplier::findOrFail($datas->supplier_id);


            $payment_method = Bank::findOrFail($datas->payment_method);
            $purchase_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'voucher_no' => $datas->voucher_no,
                'date' => $datas->date,
                'time' => $datas->time,
                'supplier_id' => $datas->supplier_id,
                'supplier_name' => $supplier_name->name,
                'supplier_phone_number' => $supplier_name->phone_number,
                'supplier_address' => $supplier_name->address,
                'id' => $datas->id,
                'grandtotal' => $datas->grandtotal,
                'paidamount' => $datas->paidamount,
                'balanceamount' => $datas->balanceamount,
                'payment_method' => $payment_method->name,
            );

        }


        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.purchase.index', compact('purchase_data', 'today', 'timenow',  'Supplier', 'bank'));
    }



    public function create()
    {
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $Latest_Bill = Purchase::latest('id')->first();
        if($Latest_Bill != ''){
            $billno = $Latest_Bill->bill_no + 1;
        }else {
            $billno = 1;
        }

        return view('page.backend.purchase.create', compact('Supplier', 'bank', 'today', 'timenow', 'billno'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);



        $bill_date = $request->get('date');
        $s_bill_no = 1;

        $billreport_date = date('dmY', strtotime($bill_date));

        $lastreport = Purchase::where('date', '=', $bill_date)->latest('id')->first();
            if($lastreport != '')
            {
                $added_billno = substr ($lastreport->bill_no, -2);
                $billno = $billreport_date . 'P0' . ($added_billno) + 1;
            } else {
                $billno = $billreport_date . 'P0' . $s_bill_no;
            }




        $data = new Purchase();
        $data->unique_key = $randomkey;
        $data->bill_no = $request->get('bill_no');
        $data->voucher_no = $request->get('voucher_no');
        $data->date = $request->get('date');
        $data->time = $request->get('time');
        $data->supplier_id = $request->get('supplier_id');
        $data->purchaseoldbalance = $request->get('purchaseoldbalance');
        $data->total = $request->get('purchasetotal_amount');
        $data->grandtotal = $request->get('purchasegrandtotal');
        $data->paidamount = $request->get('purchasepaidamount');
        $data->balanceamount = $request->get('purchasebalanceamount');
        $data->payment_method = $request->get('payment_method');
        $data->save();

        $insertedId = $data->id;
        $supplierid = $data->supplier_id;



        $PurchseData = Payment::where('supplier_id', '=', $supplierid)->first();
        if($PurchseData != ""){

            $old_grossamount = $PurchseData->purchase_amount;
            $old_paid = $PurchseData->purchase_paid;

            $gross_amount = $request->get('purchasetotal_amount');
            $payable_amount = $request->get('purchasepaidamount');

            $new_grossamount = $old_grossamount + $gross_amount;
            $new_paid = $old_paid + $payable_amount;
            $new_balance = $new_grossamount - $new_paid;

            DB::table('payments')->where('supplier_id', $supplierid)->update([
                'purchase_amount' => $new_grossamount,  'purchase_paid' => $new_paid, 'purchase_balance' => $new_balance
            ]);

        }else {
            $gross_amount = $request->get('purchasetotal_amount');
            $payable_amount = $request->get('purchasepaidamount');
            $balance_amount = $gross_amount - $payable_amount;

            $data = new Payment();

            $data->supplier_id = $supplierid;
            $data->purchase_amount = $request->get('purchasetotal_amount');
            $data->purchase_paid = $request->get('purchasepaidamount');
            $data->purchase_balance = $balance_amount;
            $data->save();
        }


        return redirect()->route('purchase.index')->with('message', 'Purchase Data added successfully!');
    }



    public function edit($unique_key)
    {
        $PurchaseData = Purchase::where('unique_key', '=', $unique_key)->first();
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();

        return view('page.backend.purchase.edit', compact('PurchaseData', 'Supplier', 'bank'));
    }


    public function update(Request $request, $unique_key)
    {
        $Purchase_Data = Purchase::where('unique_key', '=', $unique_key)->first();

        $purchase_supplier_id = $Purchase_Data->supplier_id;


        $PurchasebranchwiseData = Payment::where('supplier_id', '=', $purchase_supplier_id)->first();
        if($PurchasebranchwiseData != ""){


            $old_grossamount = $PurchasebranchwiseData->purchase_amount;
            $old_paid = $PurchasebranchwiseData->purchase_paid;

            $oldentry_grossamount = $Purchase_Data->total;
            $oldentry_paid = $Purchase_Data->paidamount;

            $gross_amount = $request->get('purchasetotal_amount');
            $payable_amount = $request->get('purchasepaidamount');



            $editedgross = $old_grossamount - $oldentry_grossamount;
           $editedpaid = $old_paid - $oldentry_paid;
           $newgross = $editedgross + $gross_amount;
           $newpaid = $editedpaid + $payable_amount;

            $new_balance = $newgross - $newpaid;

            DB::table('payments')->where('supplier_id', $purchase_supplier_id)->update([
                'purchase_amount' => $newgross,  'purchase_paid' => $newpaid, 'purchase_balance' => $new_balance
            ]);

        }


        
        $Purchase_Data->voucher_no = $request->get('voucher_no');
        $Purchase_Data->date = $request->get('date');
        $Purchase_Data->time = $request->get('time');
        $Purchase_Data->purchaseoldbalance = $request->get('purchaseoldbalance');
        $Purchase_Data->total = $request->get('purchasetotal_amount');
        $Purchase_Data->grandtotal = $request->get('purchasegrandtotal');
        $Purchase_Data->paidamount = $request->get('purchasepaidamount');
        $Purchase_Data->balanceamount = $request->get('purchasebalanceamount');
        $Purchase_Data->payment_method = $request->get('payment_method');
        $Purchase_Data->update();





        return redirect()->route('purchase.index')->with('info', 'Updated !');


    }


    public function delete($unique_key)
    {
        $data = Purchase::where('unique_key', '=', $unique_key)->first();


        

        $purchase_supplier_id = $data->supplier_id;


        $PurchasebranchwiseData = Payment::where('supplier_id', '=', $purchase_supplier_id)->first();
        if($PurchasebranchwiseData != ""){


            $old_grossamount = $PurchasebranchwiseData->purchase_amount;
            $old_paid = $PurchasebranchwiseData->purchase_paid;

            $oldentry_grossamount = $data->total;
            $oldentry_paid = $data->paidamount;

         
                $updated_gross = $old_grossamount - $oldentry_grossamount;
                $updated_paid = $old_paid - $oldentry_paid;

                $new_balance = $updated_gross - $updated_paid;

            DB::table('payments')->where('supplier_id', $purchase_supplier_id)->update([
                'purchase_amount' => $updated_gross,  'purchase_paid' => $updated_paid, 'purchase_balance' => $new_balance
            ]);

        }



        $data->delete();

        return redirect()->route('purchase.index')->with('warning', 'Deleted !');
    }


    public function getProducts()
    {
        $GetProduct = Purchaseproduct::orderBy('name', 'ASC')->where('soft_delete', '!=', 1)->get();
        $userData['data'] = $GetProduct;
        echo json_encode($userData);
    }


    public function getbalanceforpurchasePayment()
    {

        $supplierid = request()->get('supplierid');



        $last_idrow = Payment::where('supplier_id', '=', $supplierid)->first();
        if($last_idrow != ""){

            if($last_idrow->purchase_balance != NULL){

                $output[] = array(
                    'payment_pending' => $last_idrow->purchase_balance,
                );
            }else {
                $output[] = array(
                    'payment_pending' => 0,
                );

            }
        }else {
            $output[] = array(
                'payment_pending' => 0,
            );
        }
        echo json_encode($output);
    }


    public function purchase_pdfexport($today) 
    {
        $data = Purchase::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchase_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $supplier_name = Supplier::findOrFail($datas->supplier_id);


            $payment_method = Bank::findOrFail($datas->payment_method);
            $purchase_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'voucher_no' => $datas->voucher_no,
                'date' => $datas->date,
                'time' => $datas->time,
                'supplier_id' => $datas->supplier_id,
                'supplier_name' => $supplier_name->name,
                'supplier_phone_number' => $supplier_name->phone_number,
                'supplier_address' => $supplier_name->address,
                'id' => $datas->id,
                'grandtotal' => $datas->grandtotal,
                'paidamount' => $datas->paidamount,
                'balanceamount' => $datas->balanceamount,
                'payment_method' => $payment_method->name,
            );

        }

    


        $pdf = Pdf::loadView('page.backend.purchase.purchase_pdfexport', [
            'purchase_data' => $purchase_data,
            'today' => $today,
        ]);

        $name = 'PurchaseExport.' . 'pdf';
        return $pdf->stream($name);
    }


    public function purchase_excelexport($today) 
    {
       // $from = Carbon::parse($today);
        return Excel::download(new PurchaseExport($today), 'purchasereports.xlsx');
    }
}
