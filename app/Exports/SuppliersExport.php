<?php

namespace App\Exports;

use App\Models\Supplier;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuppliersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
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

            if($pending_amount != ""){
                $balnceamount = -$pending_amount;
            }else if($account_balance != ""){
                $balnceamount = +$account_balance;
            }else {
                $balnceamount = '';
            }


            $supplierdata[] = array(
                'name' => $datas->name,
                'phone_number' => $datas->phone_number,
                'balnceamount' => $balnceamount,
            );
        }

        return collect($supplierdata);
    }

    public function headings(): array
    {
        return ["Name", "Phone Number", "Pending"];
    }
}
