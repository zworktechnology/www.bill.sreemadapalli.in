<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\Payment;
use App\Exports\SuppliersExport;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SupplierController extends Controller
{
    public function index()
    {
        $data = Supplier::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();

        $supplierdata = [];
        foreach ($data as $key => $datas) {

            $PaymentsData = Payment::where('supplier_id', '=', $datas->id)->first();
            if($PaymentsData != ""){
                if($PaymentsData->purchase_paid > $PaymentsData->purchase_amount){
                    $account_balance = $PaymentsData->purchase_paid - $PaymentsData->purchase_amount;
                    $pending_amount = '';
                }else if($PaymentsData->purchase_amount > $PaymentsData->purchase_paid){
                    $pending_amount = $PaymentsData->purchase_amount - $PaymentsData->purchase_paid;
                    $account_balance = '';
                }
            }else {
                $pending_amount = '';
                $account_balance = '';
            }


            $supplierdata[] = array(
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'name' => $datas->name,
                'phone_number' => $datas->phone_number,
                'address' => $datas->address,
                'account_balance' => $account_balance,
                'pending_amount' => $pending_amount,
            );
        }
        return view('page.backend.supplier.index', compact('supplierdata'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Supplier();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->phone_number = $request->get('phone_number');
        $data->address = $request->get('address');
        $data->old_balance = $request->get('old_balance');

        $data->save();
        $supplierid = $data->id;

        if($request->get('old_balance') != ""){
            
            
            $PaymentBalanceDAta = Payment::where('supplier_id', '=', $supplierid)->first();
            if($PaymentBalanceDAta == ""){
                $balance_amount = $request->get('old_balance');
                $paymentbalacedata = new Payment();
    
                $paymentbalacedata->supplier_id = $supplierid;
                $paymentbalacedata->purchase_amount = $balance_amount;
                $paymentbalacedata->purchase_paid = 0;
                $paymentbalacedata->purchase_balance = $balance_amount;
                $paymentbalacedata->save();
            }
        }

       

        



        return redirect()->route('supplier.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $SupplierData = Supplier::where('unique_key', '=', $unique_key)->first();

        $SupplierData->name = $request->get('name');
        $SupplierData->phone_number = $request->get('phone_number');
        $SupplierData->address = $request->get('address');

        $SupplierData->update();



        return redirect()->route('supplier.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Supplier::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('supplier.index')->with('warning', 'Deleted !');
    }


    public function checkduplicate(Request $request)
    {
        if(request()->get('query'))
        {
            $query = request()->get('query');
            $SupplierData = Supplier::where('phone_number', '=', $query)->first();
            
            $userData['data'] = $SupplierData;
            echo json_encode($userData);
        }
    }



    public function supplierallpdf_export() 
    {
        $data = Supplier::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();

        $supplierdata = [];
        foreach ($data as $key => $datas) {

            $PaymentsData = Payment::where('supplier_id', '=', $datas->id)->first();
            if($PaymentsData != ""){
                if($PaymentsData->purchase_paid > $PaymentsData->purchase_amount){
                    $account_balance = $PaymentsData->purchase_paid - $PaymentsData->purchase_amount;
                    $pending_amount = '';
                }else if($PaymentsData->purchase_amount > $PaymentsData->purchase_paid){
                    $pending_amount = $PaymentsData->purchase_amount - $PaymentsData->purchase_paid;
                    $account_balance = '';
                }
            }else {
                $pending_amount = '';
                $account_balance = '';
            }


            $supplierdata[] = array(
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'name' => $datas->name,
                'phone_number' => $datas->phone_number,
                'address' => $datas->address,
                'account_balance' => $account_balance,
                'pending_amount' => $pending_amount,
            );
        }

        $today = Carbon::now()->format('Y-m-d');


        $pdf = Pdf::loadView('page.backend.supplier.supplierallpdf_export', [
            'supplierdata' => $supplierdata,
            'today' => $today,
        ]);

        $name = 'AllSupplierReport.' . 'pdf';
        return $pdf->stream($name);
    }


    public function supplierall_excelexport() 
    {
        return Excel::download(new SuppliersExport, 'suppliers.xlsx');
    }
}
