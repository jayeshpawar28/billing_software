<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_pk';
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(TempPur_Model::class);
    }

    public function purchaseProducts()
    {
        return $this->hasMany(PurchaseProductsModel::class);
    }

}
