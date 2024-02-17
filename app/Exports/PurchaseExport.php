<?php

namespace App\Exports;

use App\Models\Purchase;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseExport implements FromCollection
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
        $data = Purchase::where('date', '=', $this->today)->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $purchase_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $supplier_name = Supplier::findOrFail($datas->supplier_id);


            $purchase_data[] = array(
                'date' => $datas->date,
                'bill_no' => $datas->bill_no,
                'voucher_no' => $datas->voucher_no,
                'supplier_name' => $supplier_name->name,
                'grandtotal' => $datas->grandtotal,
                'paidamount' => $datas->paidamount,
            );

        }

        return collect($purchase_data);

    }

    public function headings(): array
    {
        return ["Date", "BillNo", "Voucher No", "Supplier", "Total", "Paid"];
    }
}
