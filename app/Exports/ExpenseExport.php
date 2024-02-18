<?php

namespace App\Exports;

use App\Models\Expense;
use App\Models\Expensedata;
use App\Models\Bank;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpenseExport implements FromCollection
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
        $data = Expense::where('date', '=', $this->today)->where('soft_delete', '!=', 1)->get();

        $expense_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {

            $Expensedata = Expensedata::where('expense_id', '=', $datas->id)->get();
            foreach ($Expensedata as $key => $Expensedatas_arr) {

                $terms[] = array(
                    $Expensedatas_arr->note . ' - ' . $Expensedatas_arr->price,
                );
            }


            if($datas->bank_id != ""){
                $bank = Bank::findOrFail($datas->bank_id);
                $bankname = $bank->name;
                $bank_id = $datas->bank_id;
            }else {
                $bankname = '';
                $bank_id = '';
            }


            $expense_data[] = array(
                'date' => $this->today,
                'terms' => $terms,
                'total_price' => $datas->total_price,
                'bank' => $bankname,
            );

        }
        return collect($expense_data);

    }


    public function headings(): array
    {
        return ["Date", "Items", "Total", "Bank"];
    }
}
