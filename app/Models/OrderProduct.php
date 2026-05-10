<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'id_order',
        'id_product',
        'product_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
