<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseProductsModel extends Model
{
    use HasFactory;

    protected $table = 'purchase_product';
    protected $primaryKey = 'purchase_product_pk';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_fk');
    }

}
