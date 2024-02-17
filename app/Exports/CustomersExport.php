<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Customer::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $customerdata = [];
        foreach ($data as $key => $datas) {

            $PaymentsData = Payment::where('customer_id', '=', $datas->id)->first();
            if($PaymentsData != ""){

                if($PaymentsData->saleamount > $PaymentsData->salepaid){
                    $pending_amount = $PaymentsData->saleamount - $PaymentsData->salepaid;


                    $customerdata[] = array(
                        'name' => $datas->name,
                        'phone_number' => $datas->phone_number,
                        'pending_amount' => $pending_amount,
                    );
                }
            }

        }

        return collect($customerdata);
    }

    public function headings(): array
    {
        return ["Name", "Phone Number", "Balance"];
    }
}
