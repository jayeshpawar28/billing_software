<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempSale_Model extends Model
{
    use HasFactory;

    protected $table = 'temp_sale';
    protected $primaryKey = 'temp_sale_pk';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_fk');
    }
}
