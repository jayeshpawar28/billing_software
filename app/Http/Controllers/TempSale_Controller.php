<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SupplierModel;
use App\Models\TempSale_Model;
use Illuminate\Http\Request;

class TempSale_Controller extends Controller
{
    public function sale()
    {
        $products = ProductModel::where('status', 'active')->get();
        $temp_sale_data = TempSale_Model::with('product')->get();
        
        return view('sale.index', compact('products', 'temp_sale_data'));
    }

    public function temp_sale_save(Request $req)
    {
        $req->validate([
            'product_fk' => 'required|gt:0'
        ]);
        
        $product_fk = $req->product_fk;
        $product = ProductModel::find($product_fk);
        $product_rate = $product->product_rate;
        $temp_sale = new TempSale_Model();
        $temp_sale->product_fk = $product_fk;
        $temp_sale->rate = $product_rate;
        $temp_sale->amount = $product_rate;
        $save = $temp_sale->save();

        if ($save) {
            return redirect()->route('sale');
        }

        return view('sale.index');
    }

    public function temp_sale_delete($id)
    {
        $temp_sale_data = TempSale_Model::find($id);

        if($temp_sale_data){
            $temp_sale_data->delete();
            return redirect()->route('sale');
        }

        return view('sale.index');
    }

    public function temp_sale_update(Request $req,$id)
    {
        $temp_sale_data = TempSale_Model::find($id);

        if($temp_sale_data){
            $temp_sale_data->rate = $req->rate;
            $temp_sale_data->qty = $req->qty;
            $temp_sale_data->amount = $req->rate * $req->qty;
            $temp_sale_data->save();
            return redirect()->route('sale');
        }
        
        return view('sale.index'); 
    }

    public function confirm_sale()
    {
        $temp_sale_data = TempSale_Model::with('product')->get();

        $customers = CustomerModel::where('status', 'active')->get();

        return view('sale.confirm_sale', compact('temp_sale_data', 'customers'));
    }
}
