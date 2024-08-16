<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    use HasFactory;

    protected $table = 'purchase';
    protected $primaryKey = 'purchase_pk';
    public $timestamps = false;

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_fk');
    }
}
