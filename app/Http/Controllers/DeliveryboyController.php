<?php

namespace App\Http\Controllers;

use App\Models\Deliveryarea;
use App\Models\Deliveryboy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Hash;

class DeliveryboyController extends Controller
{
    public function index()
    {
        $data = Deliveryboy::where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $deliveryarea = Deliveryarea::where('soft_delete', '!=', 1)->get();

        return view('page.backend.deliveryboy.index', compact('data', 'deliveryarea'));
    }

    

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Deliveryboy();

        $data->user_key = Auth::user()->name;
        $data->name = $request->get('name');
        $data->phone_number = $request->get('phone_number');
        $data->address = $request->get('address');
        $data->delivery_area_id = $request->get('delivery_area_id');
        $data->perdaysalary = $request->get('perdaysalary');
        $data->email = $request->get('deliveryboy_email');
        $data->password = $request->get('deliveryboy_password');
        $data->unique_key = $randomkey;

        $data->save();


        $password = $request->get('deliveryboy_password');
        $hashedPassword = Hash::make($password);

        $Userdata = new User();
        $Userdata->name = $request->get('name');
        $Userdata->email = $request->get('deliveryboy_email');
        $Userdata->role = 'DeliveryBoy';
        $Userdata->deliveryboy_id = $data->id;
        $Userdata->password = $hashedPassword;
        $Userdata->save();

        return redirect()->route('delivery.boy.index')->with('message', 'Added !');
    }

    public function edit(Request $request, $unique_key)
    {
        $plandata = Deliveryboy::where('unique_key', '=', $unique_key)->first();

        $plandata->name = $request->get('name');
        $plandata->phone_number = $request->get('phone_number');
        $plandata->address = $request->get('address');
        $plandata->delivery_area_id = $request->get('delivery_area_id');
        $plandata->perdaysalary = $request->get('perdaysalary');

        $plandata->update();

        return redirect()->route('delivery.boy.index')->with('info', 'Updated !');
    }

    public function delete($unique_key)
    {
        $data = Deliveryboy::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('delivery.boy.index')->with('warning', 'Deleted !');
    }
}
