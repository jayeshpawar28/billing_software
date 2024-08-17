<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\SupplierModel;
use App\Models\TempPur_Model;
use Illuminate\Http\Request;

class TempPur_Controller extends Controller
{
    public function get_product()
    {
        $products = ProductModel::where('status', 'active')->get();

        $temp_pur_data = TempPur_Model::with('product')->get();
        
        return view('purchase.index', compact('products', 'temp_pur_data'));
    }

    public function temp_purchase_save(Request $req)
    {
        $req->validate([
            'product_fk' => 'required|gt:0'
        ]);

        $product_fk = $req->product_fk;
        $product = ProductModel::find($product_fk);
        $product_rate = $product->product_rate;
        $temp_pur = new TempPur_Model();
        $temp_pur->product_fk = $product_fk;
        $temp_pur->rate = $product_rate;
        $temp_pur->amount = $product_rate;
        $save = $temp_pur->save();

        if ($save) {
            return redirect()->route('purchase');
        }

        return view('purchase.index');
    }

    public function temp_purchase_delete($id)
    {
        $temp_pur_data = TempPur_Model::find($id);

        if($temp_pur_data){
            $temp_pur_data->delete();
            return redirect()->route('purchase');
        }

        return view('purchase.index');
    }

    public function temp_purchase_update(Request $req,$id)
    {
        $temp_pur_data = TempPur_Model::find($id);

        if($temp_pur_data){
            $temp_pur_data->rate = $req->rate;
            $temp_pur_data->qty = $req->qty;
            $temp_pur_data->amount = $req->rate * $req->qty;
            $temp_pur_data->save();
            return redirect()->route('purchase');
        }
        
        return view('purchase.index'); 
    }

    public function confirm_pruchase()
    {
        $temp_pur_data = TempPur_Model::with('product')->get();

        $suppliers = SupplierModel::where('status', 'active')->get();

        
        return view('purchase.confirm_purchase', compact('temp_pur_data', 'suppliers'));
    }
}





