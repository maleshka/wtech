<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingBasket extends Model
{
    protected $table = 'shopping_basket';
    protected $fillable = ['id_user', 'id_product', 'product_quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
