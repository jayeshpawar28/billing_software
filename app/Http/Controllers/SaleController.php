<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\SaleProductsModel;
use App\Models\TempSale_Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function sale_save(Request $req)
    {
        $req->validate([
            'customer_fk' => 'required|gt:0'
        ]);

        $temp_data = TempSale_Model::orderBy('temp_sale_pk', 'ASC')->get();
        $res_data = $temp_data->toArray();

        //Code for bill number
        $lastSale = SaleModel::orderBy('sale_pk', 'desc')->first();
        $lastBillNo = $lastSale ? $lastSale->bill_no : 0;
        $newBillNo = $lastBillNo + 1;
        //Code for bill number

        $sale_data = new SaleModel();
        $sale_data->sale_date = $req->sale_date;
        $sale_data->customer_fk = $req->customer_fk;
        $sale_data->remark = $req->remark;
        $sale_data->count = count($res_data);
        $sale_data->total_amount = $req->total_amount;
        $sale_data->paid_amt = $req->paid_amt;
        $sale_data->pending_amt = $req->pending_amt;
        $sale_data->bill_no = $newBillNo;
        $sale_data->save();

        $sale_fk = $sale_data->sale_pk; 

        foreach($res_data as $row){
            $sale_product = new SaleProductsModel();
            $sale_product->sale_fk = $sale_fk;
            $sale_product->qty = $row['qty'];
            $sale_product->rate = $row['rate'];
            $sale_product->amount = $row['amount'];
            $sale_product->product_fk = $row['product_fk'];
            $sale_product->save();

             // Update stock and Last action in the product table
            $product = ProductModel::find($row['product_fk']);
            if ($product) {
                $product->qty -= $row['qty'];
                $product->last_action = 'Sale'; 
                $product->save();
            }
        }

        $trun = TempSale_Model::truncate();
        if($trun){
            return redirect()->route('today_sale');
        }

        return view('sale.index');  
    }

    public function today_sale()
    {

        $date = Carbon::now()->toDateString();
        $data = SaleModel::whereDate('sale_date', $date)
                                ->orderBy('sale_pk', 'desc')
                                ->get();

        if($data){

            return view('sale.today_sale', compact('data'));
        }
        return view('sale.index');

    }

    public function yesterday_sale()
    {

        $date = Carbon::now()->yesterday()->toDateString();
        $data = SaleModel::whereDate('sale_date', $date)
                                ->orderBy('sale_pk', 'desc')
                                ->get();
        if($data){
            return view('sale.yesterday', compact('data'));
        }
        return view('sale.index');

    }

    public function this_month_sale()
    {

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth(); 
        $data = SaleModel::whereBetween('sale_date', [$startOfMonth, $endOfMonth])
                                ->orderBy('sale_pk', 'desc')
                                ->get();
        if($data){
            return view('sale.this_month', compact('data'));
        }
        return view('sale.index');

    }

    public function last_month_sale()
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        $data = SaleModel::whereBetween('sale_date', [$startOfLastMonth, $endOfLastMonth])
                                ->orderBy('sale_pk', 'desc')
                                ->get();
        if($data){
            return view('sale.last_month', compact('data'));
        }
        return view('sale.index');
    }

    public function all_sale()
    {
        $data = SaleModel::orderBy('sale_pk', 'desc')->get();
        if($data){
            return view('sale.all', compact('data'));
        }
        return view('sale.index');
    }

    public function sale_detail($id)
    {
        $data = SaleModel::with('customer')->find($id);
        $sale_products = SaleProductsModel::where('sale_fk',$id)->with('product')->get();

        if($data){
            return view('sale.details', compact('data', 'sale_products'));
        }
        return view('sale.index');

    }

    public function sale_update($id)
    {
        $data = SaleModel::with('customer')->find($id);
        $sale_products = SaleProductsModel::where('sale_fk',$id)->with('product')->get();
        $products = ProductModel::where('status', 'active')->get();

        if($data){
            return view('sale.update', compact('data', 'sale_products', 'products'));
        }
        return view('sale.index');
    }

    public function sale_product_update(Request $req, $id,$sale_pk)
    {
        $sale_product = SaleProductsModel::find($id);
        if($sale_product){
            $sale_product->rate = $req->query('rate');
            $sale_product->qty = $req->query('qty');
            $sale_product->amount = $req->query('rate') * $req->query('qty');
    
            $sale_product->save();

            
            $sale = SaleProductsModel::where('sale_fk', $sale_pk)->get();
            $res_data = $sale->toArray();
            $sale_data = SaleModel::find($sale_pk);
            $sale_data->count = count($res_data);
            $sale_data->save();

            return redirect()->route('sale_update', $sale_pk);
        }
        return view('sale.index');
    }

    public function sale_update_save(Request $req, $id)
    {
        $req->validate([
            'paid_amt' => 'numeric'
        ]);
        
        $sale = SaleModel::find($id);

        if($sale){
            $sale->sale_date = $req->sale_date;
            $sale->paid_amt = $req->paid_amt;
            $sale->total_amount = $req->total_amount;
            $sale->pending_amt = $req->total_amount - $req->paid_amt;
            $sale->remark = $req->remark;
            $sale->save();
            return redirect()->route('sale_detail', $id);
        }
        return view('sale.index');
    }

    public function sale_delete($id)
    {
        $data = SaleModel::find($id);

        if ($data) {
            $sale_products = SaleProductsModel::where('sale_fk', $id)->get();

            foreach($sale_products as $sale_product){
                $product = ProductModel::find($sale_product->product_fk);

                if($product){
                    $product->qty += $sale_product->qty;
                    // if ($product->qty < 0) {
                    //     $product->qty = 0;
                    // }
                    $product->save();
                }
            }
             // Delete the purchase record
            $data->delete();

            // Delete all related purchase products
            SaleProductsModel::where('sale_fk', $id)->delete();
            
            return redirect()->route('sale');
        }
        return view('sale.index');
    }

    public function sale_print($id)
    {
        $data = SaleModel::with('customer')->find($id);
        $sale_products = SaleProductsModel::where('sale_fk',$id)->with('product')->get();

        if ($data) {
            return view('sale.print', compact('data', 'sale_products'));
        }
        return view('sale.index');
    }
    
}
