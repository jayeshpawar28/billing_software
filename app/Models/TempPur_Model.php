<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPur_Model extends Model
{
    use HasFactory;

    protected $table = 'temp_purchase';
    protected $primaryKey = 'temp_purchase_pk';
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_fk');
    }

}
