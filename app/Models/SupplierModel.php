<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_pk';
    public $timestamps = false;

    public function supplier()
    {
        return $this->hasMany(PurchaseModel::class);
    }
}
