<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Closeaccount;
use App\Models\Sale;
use App\Models\Expense;
use App\Models\Openaccount;
use App\Models\Bank;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;


class CloseaccountController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Closeaccount::where('soft_delete', '!=', 1)->where('date', '=', $today)->orderBy('id', 'desc')->get();


        $saletotalamount = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');

        
        return view('page.backend.closeaccount.index', compact('data', 'today', 'saletotalamount'));
        
    }

    public function datefilter(Request $request) {
        $today = $request->get('from_date');
        $data = Closeaccount::where('soft_delete', '!=', 1)->where('date', '=', $today)->orderBy('id', 'desc')->get();


        $saletotalamount = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');

        
        return view('page.backend.closeaccount.index', compact('data', 'today', 'saletotalamount'));
    }



    public function store(Request $request)
    {
        $olddata = Closeaccount::where('date', '=', $request->get('date'))->where('soft_delete', '!=', 1)->first();

        if($olddata == ''){

            $randomkey = Str::random(5);

            $data = new Closeaccount();
    
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->sales = $request->get('sales');
            $data->cash = $request->get('cash');
            $data->card = $request->get('card');
            $data->paytm_business = $request->get('paytm_business');
            $data->paytm = $request->get('paytm');
            $data->phonepe_business = $request->get('phonepe_business');
            $data->phonepe = $request->get('phonepe');
            $data->gpay_business = $request->get('gpay_business');
            $data->gpay = $request->get('gpay');
    
            $data->save();
    
    
            return redirect()->route('closeaccount.index')->with('message', 'Added !');
        }else {
            return redirect()->route('closeaccount.index')->with('info', 'Already Existed !');
        }
        
    }


    public function edit(Request $request, $unique_key)
    {
        $data = Closeaccount::where('unique_key', '=', $unique_key)->first();

        $data->date = $request->get('date');
        $data->sales = $request->get('sales');
        $data->cash = $request->get('cash');
        $data->card = $request->get('card');
        $data->paytm_business = $request->get('paytm_business');
        $data->paytm = $request->get('paytm');
        $data->phonepe_business = $request->get('phonepe_business');
        $data->phonepe = $request->get('phonepe');
        $data->gpay_business = $request->get('gpay_business');
        $data->gpay = $request->get('gpay');

            $data->update();

        return redirect()->route('closeaccount.index')->with('info', 'Updated !');
    }


    public function delete($unique_key)
    {
        $data = Closeaccount::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('closeaccount.index')->with('warning', 'Deleted !');
    }
}
