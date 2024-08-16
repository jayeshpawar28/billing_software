<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Models\PurchaseModel;
use App\Models\SaleModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report()
    {
        return view('report.index');
    }

    public function sale_report()
    {
        $data = SaleModel::orderBy('sale_pk', 'desc')->get();
        $customers = CustomerModel::where('status', 'active')->get();

        if($data){
            return view('report.sale_report', compact('data', 'customers'));
        }
        return view('report.index');
    }

    public function sale_filter(Request $req)
    {
        $customers = CustomerModel::where('status', 'active')->get();
        $query = SaleModel::query();
        
        // Filter by selected customer
        if ($req->filled('customer_fk') && $req->customer_fk > 0) {
            $query->where('customer_fk', $req->customer_fk);
        }

        // Filter by date range
        if ($req->filled('fromDate') && $req->filled('toDate')) {
        $query->whereBetween('sale_date', [$req->fromDate, $req->toDate]);
        }

        // Filter by remark
        if ($req->filled('remark')) {
            $query->where('remark', 'LIKE', '%' . $req->remark . '%');
        }

        // Fetch filtered data
        $data = $query->orderBy('sale_pk', 'desc')->get();

        // Return view with filtered data and customers
        return view('report.sale_report', compact('data', 'customers', 'req'));
    }

    public function purchase_report()
    {
        $data = PurchaseModel::orderBy('purchase_pk', 'desc')->get();
        $suppliers = SupplierModel::where('status', 'active')->get();

        if($data){
            return view('report.purchase_report', compact('data', 'suppliers'));
        }
        return view('report.index');
    }

    public function purchase_filter(Request $req)
    {
        $suppliers = SupplierModel::where('status', 'active')->get();
        $query = PurchaseModel::query();
        
        // Filter by selected supplier
        if ($req->filled('supplier_fk') && $req->supplier_fk > 0) {
            $query->where('supplier_fk', $req->supplier_fk);
        }

        // Filter by date range
        if ($req->filled('fromDate') && $req->filled('toDate')) {
        $query->whereBetween('purchase_date', [$req->fromDate, $req->toDate]);
        }

        // Filter by remark
        if ($req->filled('remark')) {
            $query->where('remark', 'LIKE', '%' . $req->remark . '%');
        }

        // Fetch filtered data
        $data = $query->orderBy('purchase_pk', 'desc')->get();

        // Return view with filtered data and customers
        return view('report.purchase_report', compact('data', 'suppliers'));
    }
}
