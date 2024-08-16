<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function suppliers_view()
    {
        return view('master.suppliers_view');
    }

    public function supplier_save(Request $req)
    {
        $req->validate([
            'supplier_name' => 'required|string',
            'mobile' => 'required|numeric',
        ]);

       $data = new SupplierModel();

       $data->supplier_name = $req->supplier_name;
       $data->address = $req->address;
       $data->mobile = $req->mobile;
       $data->remark = $req->remark;
    
       $save = $data->save();

       if($save){
            return redirect('supplier_list');
       }

       return view('suppliers');
    }

    public function supplier_list()
    {
        $data = SupplierModel::where('status', 'active')->get();
        return view('master.supplier_list', compact('data'));
    }

    public function supplier_update_view($id)
    {
        $supplier  = SupplierModel::find($id);
        return view('master.suppliers_view', compact('supplier'));
    }

    public function supplier_update(Request $req, $id)
    {
        $req->validate([
            'supplier_name' => 'required|string',
            'mobile' => 'required|numeric',
        ]);

        $supplier = SupplierModel::find($id);

        if($supplier){
            $supplier->supplier_name = $req->supplier_name;
            $supplier->address = $req->address;
            $supplier->mobile = $req->mobile;
            $supplier->remark = $req->remark;

            $supplier->save();

            return redirect()->route('supplier_list');
        }

        return view('master.suppliers_view');

    }

    public function supplier_delete($id)
    {
        $supplier = SupplierModel::find($id);

        if($supplier){
            $supplier->status = 'inactive';
            $supplier->save();
        }

        return redirect()->route('supplier_list');

    }
}
