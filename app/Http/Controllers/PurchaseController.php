<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\PurchaseProductsModel;
use App\Models\TempPur_Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchase_save(Request $req)
    {
        $temp_data = TempPur_Model::orderBy('temp_purchase_pk', 'ASC')->get();
        $res_data = $temp_data->toArray();

        //Code for bill number
        $lastPurchase = PurchaseModel::orderBy('purchase_pk', 'desc')->first();
        $lastBillNo = $lastPurchase ? $lastPurchase->bill_no : 0;
        $newBillNo = $lastBillNo + 1;

        //Code for bill number

        $purchase_data = new PurchaseModel();
        $purchase_data->purchase_date = $req->purchase_date;
        $purchase_data->supplier_fk = $req->supplier_fk;
        $purchase_data->remark = $req->remark;
        $purchase_data->count = count($res_data);
        $purchase_data->total_amount = $req->total_amount;
        $purchase_data->paid_amt = $req->paid_amt;
        $purchase_data->pending_amt = $req->pending_amt;
        $purchase_data->bill_no = $newBillNo;
        $purchase_data->save();

        $purchase_fk = $purchase_data->purchase_pk; 

        foreach($res_data as $row){
            $purchase_product = new PurchaseProductsModel();
            $purchase_product->purchase_fk = $purchase_fk;
            $purchase_product->qty = $row['qty'];
            $purchase_product->rate = $row['rate'];
            $purchase_product->amount = $row['amount'];
            $purchase_product->product_fk = $row['product_fk'];
            $purchase_product->save();

             // Update stock and Last action in the product table
            $product = ProductModel::find($row['product_fk']);
            if ($product) {
                $product->qty += $row['qty']; 
                $product->last_action = 'Purchase';
                $product->save();
            }
        }

        $trun = TempPur_Model::truncate();
        if($trun){
            return redirect()->route('today_purchase');
        }

        return view('purchase.index');
        
    }

    public function today_purchase()
    {

        $date = Carbon::now()->toDateString();
        $data = PurchaseModel::whereDate('purchase_date', $date)
                                ->orderBy('purchase_pk', 'desc')
                                ->get();

        if($data){

            return view('purchase.today_purchase', compact('data'));
        }
        return view('purchase.index');

    }

    public function yesterday_purchase()
    {

        $date = Carbon::now()->yesterday()->toDateString();
        $data = PurchaseModel::whereDate('purchase_date', $date)
                                ->orderBy('purchase_pk', 'desc')
                                ->get();
        if($data){
            return view('purchase.yesterday', compact('data'));
        }
        return view('purchase.index');

    }

    public function this_month_purchase()
    {

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth(); 
        $data = PurchaseModel::whereBetween('purchase_date', [$startOfMonth, $endOfMonth])
                                ->orderBy('purchase_pk', 'desc')
                                ->get();
        if($data){
            return view('purchase.this_month', compact('data'));
        }
        return view('purchase.index');

    }

    public function last_month_purchase()
    {
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        $data = PurchaseModel::whereBetween('purchase_date', [$startOfLastMonth, $endOfLastMonth])
                                ->orderBy('purchase_pk', 'desc')
                                ->get();
        if($data){
            return view('purchase.last_month', compact('data'));
        }
        return view('purchase.index');
    }

    public function all_purchase()
    {
        $data = PurchaseModel::orderBy('purchase_pk', 'desc')->get();
        if($data){
            return view('purchase.all', compact('data'));
        }
        return view('purchase.index');
    }

    public function purchase_detail($id)
    {
        $data = PurchaseModel::with('supplier')->find($id);
        $purchse_products = PurchaseProductsModel::where('purchase_fk',$id)->with('product')->get();

        if($data){
            return view('purchase.details', compact('data', 'purchse_products'));
        }
        return view('purchase.index');

    }

    public function update($id)
    {
        $data = PurchaseModel::with('supplier')->find($id);
        $purchse_products = PurchaseProductsModel::where('purchase_fk',$id)->with('product')->get();
        $products = ProductModel::where('status', 'active')->get();

        if($data){
            return view('purchase.update', compact('data', 'purchse_products', 'products'));
        }
        return view('purchase.index');

    }

    public function purchase_delete($id)
    {
        $data = PurchaseModel::find($id);

        if ($data) {
            $purchase_products = PurchaseProductsModel::where('purchase_fk', $id)->get();

            foreach($purchase_products as $purchase_product){
                $product = ProductModel::find($purchase_product->product_fk);

                if($product){
                    $product->qty -= $purchase_product->qty;
                    if ($product->qty < 0) {
                        $product->qty = 0;
                    }
                    $product->save();
                }
            }
             // Delete the purchase record
            $data->delete();

            // Delete all related purchase products
            PurchaseProductsModel::where('purchase_fk', $id)->delete();
            
            return redirect()->route('purchase');
        }
        return view('purchase.index');
    }

    public function purchase_print($id)
    {
        $data = PurchaseModel::with('supplier')->find($id);
        $purchse_products = PurchaseProductsModel::where('purchase_fk',$id)->with('product')->get();

        if ($data) {
            return view('purchase.print', compact('data', 'purchse_products'));
        }
        return view('purchase.index');
    }


    public function new_product_update(Request $req, $id,$purchase_pk)
    {
        $purchase_product = PurchaseProductsModel::find($id);
        $purchase_data = PurchaseModel::find($purchase_pk);
        if($purchase_product){
            $purchase_product->rate = $req->rate;
            $purchase_product->qty = $req->qty;
            $new_amount = $purchase_product->amount = $req->rate * $req->qty;
            $purchase_product->save();

            //code for new product's amount add in purchase total amount
            // $purchase_data->total_amount += $new_amount;
            //code for item count increment in purchase table
            $purchase = PurchaseProductsModel::where('purchase_fk', $purchase_pk)->get();
            $res_data = $purchase->toArray();
            $purchase_data->count = count($res_data);
            $purchase_data->save();

            return redirect()->route('update', $purchase_pk);
        }
        return view('purchase.index');
    }

    public function update_save(Request $req, $id)
    {
        $purchase = PurchaseModel::find($id);

        if($purchase){
            $purchase->purchase_date = $req->purchase_date;
            $purchase->paid_amt = $req->paid_amt;
            $purchase->total_amount = $req->total_amount;
            $purchase->pending_amt = $req->total_amount - $req->paid_amt;
            $purchase->remark = $req->remark;
            $purchase->save();
            return redirect()->route('purchase_detail', $id);
        }
        return view('purchase.index');
    }
}
