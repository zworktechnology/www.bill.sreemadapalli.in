<?php

namespace App\Exports;

use App\Models\Salespayment;
use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalespaymentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */


    protected $today;

    public function __construct(String $today) {

        $this->today = $today;
    }


    public function collection()
    {
        $data = Salespayment::where('date', '=', $this->today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $salepayment_data = [];
        foreach ($data as $key => $datas) {

                $customer = Customer::findOrFail($datas->customer_id);

            $salepayment_data[] = array(
                'date' => $this->today,
                'customer' => $customer->name,
                'paid_amount' => $datas->paid_amount,
            );
        }

        return collect($salepayment_data);

    }


    public function headings(): array
    {
        return ["Date", "Customer", "Amount"];
    }
}
