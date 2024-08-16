<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stock()
    {
        $products = ProductModel::where('status', 'active')->get();
        return view('stock.index', compact('products'));
    }

    public function stock_update()
    {
        $products = ProductModel::where('status', 'active')->get();
        return view('stock.update', compact('products'));
    } 

    public function stock_update_save(Request $req)
    {
        $replacer = ["\r\n", "\n", "\r", "\t", "  "];
        $anyUpdate = false;

        foreach ($req->product_qty as $product_pk => $qty) {
            // Update each product's stock
            $product = ProductModel::find($product_pk);

            if ($product) {
                $clean_qty = str_replace($replacer, "", trim($qty));

                if ($product->qty != $clean_qty) {
                    $product->qty = $clean_qty;
                    $anyUpdate = true; 
                }

                $product->last_action = 'Manual';

                if ($anyUpdate) {
                    $product->save();
                    $anyUpdate = false;
                }
            }
        }

        return redirect()->route('stock');
    }

}
