<?php

namespace App\Exports;

use App\Models\Purchasepayment;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchasepaymentExport implements FromCollection
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
        $data = Purchasepayment::where('date', '=', $this->today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchasepayment_data = [];
        foreach ($data as $key => $datas) {

                $supplier = Supplier::findOrFail($datas->supplier_id);

            $purchasepayment_data[] = array(
                'purchasedate' => $this->today,
                'supplier' => $supplier->name,
                'paid_amount' => $datas->paid_amount,
            );
        }

        return collect($purchasepayment_data);
    }


    public function headings(): array
    {
        return ["Date", "Supplier", "Amount"];
    }
}
