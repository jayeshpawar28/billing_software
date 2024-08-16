<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProductsModel extends Model
{
    use HasFactory;

    protected $table = 'sale_product';
    protected $primaryKey = 'sale_product_pk';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_fk');
    }
}
