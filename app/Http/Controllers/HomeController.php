<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\PurchaseModel;
use App\Models\SaleModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $sale = SaleModel::orderBy('sale_pk', 'desc')->get();
        $purchase = PurchaseModel::orderBy('purchase_pk', 'desc')->get();
        $customer = CustomerModel::where('status', 'active')->get();
        $supplier = SupplierModel::where('status', 'active')->get();
        return view('home.index', compact('sale', 'purchase','customer','supplier'));
    }
}
