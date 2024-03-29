<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllCustomersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $data = Customer::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $customerdata = [];
        foreach ($data as $key => $datas)
        {
            $PaymentsData = Payment::where('customer_id', '=', $datas->id)->first();
            if($PaymentsData != ""){
                if($PaymentsData->salepaid > $PaymentsData->saleamount){
                    $account_balance = $PaymentsData->salepaid - $PaymentsData->saleamount;
                    $pending_amount = '';
                }else if($PaymentsData->saleamount > $PaymentsData->salepaid){
                    $pending_amount = $PaymentsData->saleamount - $PaymentsData->salepaid;
                    $account_balance = '';
                }else {
                    $pending_amount = '';
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
            $customerdata[] = array(
                'name' => $datas->name,
                'phone_number' => $datas->phone_number,
                'balnceamount' => $balnceamount,
            );
        }

        return collect($customerdata);
    }


    public function headings(): array
    {
        return ["Name", "Phone Number", "AccountBalance"];
    }
}
