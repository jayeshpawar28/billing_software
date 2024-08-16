<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CustomerController extends Controller
{
    public function customers()
    {
        return view('master.customers_view');
    }


    public function customer_save(Request $req)
    {
        $req->validate([
            'customer_name' => 'required|string',
            'mobile' => 'required|numeric',
        ]);

       $data = new CustomerModel();

       $data->customer_name = $req->customer_name;
       $data->address = $req->address;
       $data->mobile = $req->mobile;
       $data->email = $req->email;
    
       $save = $data->save();

       if($save){
            return redirect('customer_list');
       }

       return view('customers');
    }

    public function customer_list()
    {
        $data = CustomerModel::where('status', 'active')->get();
        return view('master.customer_list', compact('data'));
    }

    public function customer_update_view($id)
    {
        $customer  = CustomerModel::find($id);
        return view('master.customers_view', compact('customer'));
    }

    public function customer_update(Request $req, $id)
    {
        $req->validate([
            'customer_name' => 'required|string',
            'mobile' => 'required|numeric',
        ]);

        $customer = CustomerModel::find($id);

        if($customer){
            $customer->customer_name = $req->customer_name;
            $customer->address = $req->address;
            $customer->mobile = $req->mobile;
            $customer->email = $req->email;

            $customer->save();

            return redirect()->route('customer_list');
        }

        return view('master.customers_view');
    }

    public function customer_delete($id)
    {
        $customer = CustomerModel::find($id);

        if($customer){
            $customer->status = 'inactive';
            $customer->save();
        }

        return redirect()->route('customer_list');

    }
}
