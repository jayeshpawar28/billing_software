<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_view()
    {
        $product = ProductModel::where('status', 'active')->get();
        return view('product.index', compact('product'));
    }

    public function product_save(Request $req)
    {
        $req->validate([
            'product_name' => 'required',
        ]);

       $product = new ProductModel();

       $product->product_name = $req->product_name;
       $product->product_rate = $req->product_rate;
    
       $save = $product->save();

       if($save){
            return redirect()->route('product_view');
       }

       return view('product.index');
    }

    public function product_update_view($id)
    {
        $selected_pro = ProductModel::find($id);
        $product = ProductModel::where('status', 'active')->get();
        return view('product.index', compact('selected_pro','product'));
    }

    public function product_update(Request $req, $id)
    {
        $product = ProductModel::find($id);
        $product->product_name = $req->product_name;
        $product->product_rate = $req->product_rate;
        $product->save();

        return redirect()->route('product_view');
    }

    public function product_delete($id)
    {
        $product = ProductModel::find($id);
        $product->delete();
        return redirect()->route('product_view');
    }
 
}
