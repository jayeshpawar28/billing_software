<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleModel extends Model
{
    use HasFactory;

    protected $table = 'sale';
    protected $primaryKey = 'sale_pk';
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_fk');
    }
}
