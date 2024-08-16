<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'customer_pk';
    public $timestamps = false;

    public function customer()
    {
        return $this->hasMany(SaleModel::class);
    }
}
