<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Purchase;
use App\Models\PurchaseProductdata;
use App\Models\Supplier;
use App\Models\Purchaseproduct;
use App\Models\Bank;
use App\Models\Payment;
use App\Models\Purchasepayment;
use App\Exports\PurchasepaymentExport;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PurchasepaymentController extends Controller
{
    public function index()
    {
        
        $today = Carbon::now()->format('Y-m-d');
        $data = Purchasepayment::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchasepayment_data = [];
        foreach ($data as $key => $datas) {

                $supplier = Supplier::findOrFail($datas->supplier_id);

                if($datas->bank_id != ""){
                    $bank = Bank::findOrFail($datas->bank_id);
                    $bankname = $bank->name;
                    $bank_id = $datas->bank_id;
                }else {
                    $bankname = '';
                    $bank_id = '';
                }

            $purchasepayment_data[] = array(
                'supplier' => $supplier->name,
                'supplier_id' => $datas->supplier_id,
                'purchasedate' => $datas->date,
                'purchasepayment_note' => $datas->purchasepayment_note,
                'date' => date('d-m-Y', strtotime($datas->date)),
                'paid_amount' => $datas->paid_amount,
                'id' => $datas->id,
                'bank_id' => $datas->bank_id,
                'bankname' => $bankname,
                'unique_key' => $datas->unique_key,
            );
        }
        
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();

        $todaydate = Carbon::now()->format('d-m-Y');
        return view('page.backend.purchasepayment.index', compact('purchasepayment_data', 'Supplier', 'today', 'todaydate', 'bank'));
    }


    public function datefilter(Request $request) {

        $today = $request->get('from_date');
        $data = Purchasepayment::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchasepayment_data = [];
        foreach ($data as $key => $datas) {

                $supplier = Supplier::findOrFail($datas->supplier_id);

                if($datas->bank_id != ""){
                    $bank = Bank::findOrFail($datas->bank_id);
                    $bankname = $bank->name;
                    $bank_id = $datas->bank_id;
                }else {
                    $bankname = '';
                    $bank_id = '';
                }

            $purchasepayment_data[] = array(
                'supplier' => $supplier->name,
                'supplier_id' => $datas->supplier_id,
                'purchasedate' => $datas->date,
                'date' => date('d-m-Y', strtotime($datas->date)),
                'paid_amount' => $datas->paid_amount,
                'purchasepayment_note' => $datas->purchasepayment_note,
                'id' => $datas->id,
                'bank_id' => $datas->bank_id,
                'bankname' => $bankname,
                'unique_key' => $datas->unique_key,
            );
        }
        
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();

        $todaydate = Carbon::now()->format('d-m-Y');
        return view('page.backend.purchasepayment.index', compact('purchasepayment_data', 'Supplier', 'today', 'todaydate', 'bank'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);
        $timenow = Carbon::now()->format('H:i');

        $data = new Purchasepayment();

        $data->unique_key = $randomkey;
        $data->supplier_id = $request->get('supplier_id');
        $data->date = $request->get('date');
        $data->time = $timenow;
        $data->paid_amount = $request->get('paid_amount');
        $data->purchasepayment_note = $request->get('purchasepayment_note');
        $data->bank_id = $request->get('bank_id');
        $data->save();

        $supplier_id = $request->get('supplier_id');

        $saleamountData = Payment::where('supplier_id', '=', $supplier_id)->first();

        if($saleamountData != ""){
            $old_grossamount = $saleamountData->purchase_amount;
            $old_paid = $saleamountData->purchase_paid;

            $paidamount = $request->get('paid_amount');

            $new_grossamount = $old_grossamount;
            $new_paid = $old_paid + $paidamount;
            $new_balance = $new_grossamount - $new_paid;

            DB::table('payments')->where('supplier_id', $supplier_id)->update([
                'purchase_amount' => $new_grossamount,  'purchase_paid' => $new_paid, 'purchase_balance' => $new_balance
            ]);
        }else {

            $new_grossamount = 0;
            $paidamount = $request->get('paid_amount');
            $new_balance = $new_grossamount - $paidamount;

            $Paymentata = new Payment();

            $Paymentata->supplier_id = $supplier_id;
            $Paymentata->purchase_amount = 0;
            $Paymentata->purchase_paid = $paidamount;
            $Paymentata->purchase_balance = $new_balance;
            $Paymentata->save();
    }

        return redirect()->route('purchasepayment.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $Purchasepayment = Purchasepayment::where('unique_key', '=', $unique_key)->first();
        $db_paid_data = $Purchasepayment->paid_amount;

        $supplier_id = $request->get('supplier_id');
        $saleamountData = Payment::where('supplier_id', '=', $supplier_id)->first();
        if($saleamountData != ""){

            $paidamount = $request->get('paid_amount');

            $old_grossamount = $saleamountData->purchase_amount;
            $old_paid = $saleamountData->purchase_paid;


            $db_update_paid = $old_paid - $db_paid_data;


            $new_grossamount = $old_grossamount;
            $new_paid = $db_update_paid + $paidamount;
            $new_balance = $new_grossamount - $new_paid;

            DB::table('payments')->where('supplier_id', $supplier_id)->update([
                'purchase_amount' => $new_grossamount,  'purchase_paid' => $new_paid, 'purchase_balance' => $new_balance
            ]);

        }


        $Purchasepayment->supplier_id = $request->get('supplier_id');
        $Purchasepayment->date = $request->get('date');
        $Purchasepayment->paid_amount = $request->get('paid_amount');
        $Purchasepayment->purchasepayment_note = $request->get('purchasepayment_note');
        $Purchasepayment->bank_id = $request->get('bank_id');
        $Purchasepayment->update();

        



        return redirect()->route('purchasepayment.index')->with('info', 'Updated !');
    }


    public function delete($unique_key)
    {
        $data = Purchasepayment::where('unique_key', '=', $unique_key)->first();

        $db_paid_data = $data->paid_amount;
        $db_paid_supplier_id = $data->supplier_id;


        $saleamountData = Payment::where('supplier_id', '=', $db_paid_supplier_id)->first();
        if($saleamountData != ""){


            $old_grossamount = $saleamountData->purchase_amount;
            $old_paid = $saleamountData->purchase_paid;


            $db_update_paid = $old_paid - $db_paid_data;


            $new_grossamount = $old_grossamount;
            $new_paid = $db_update_paid;
            $new_balance = $new_grossamount - $new_paid;

            DB::table('payments')->where('supplier_id', $db_paid_supplier_id)->update([
                'purchase_amount' => $new_grossamount,  'purchase_paid' => $new_paid, 'purchase_balance' => $new_balance
            ]);

        }



        $data->delete();

        return redirect()->route('purchasepayment.index')->with('warning', 'Deleted !');
    }


    public function purchasepayment_pdfexport($today) 
    {
        $data = Purchasepayment::where('date', '=', $today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchasepayment_data = [];
        foreach ($data as $key => $datas) {

                $supplier = Supplier::findOrFail($datas->supplier_id);

            $purchasepayment_data[] = array(
                'supplier' => $supplier->name,
                'phone_number' => $supplier->phone_number,
                'supplier_id' => $datas->supplier_id,
                'purchasedate' => $datas->date,
                'date' => date('d-m-Y', strtotime($datas->date)),
                'paid_amount' => $datas->paid_amount,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
            );
        }

    


        $pdf = Pdf::loadView('page.backend.purchasepayment.purchasepayment_pdfexport', [
            'purchasepayment_data' => $purchasepayment_data,
            'today' => $today,
        ]);

        $name = 'PurchaseExport.' . 'pdf';
        return $pdf->stream($name);
    }

    public function purchasepayment_excelexport($today) 
    {
       // $from = Carbon::parse($today);
        return Excel::download(new PurchasepaymentExport($today), 'purchasepaymentreports.xlsx');
    }

}
