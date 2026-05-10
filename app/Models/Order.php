<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id_user',
        'total_price',
        'delivery_method',
        'payment_method',
        'first_name',
        'email',
        'phone',
        'street',
        'city',
        'postal',
        'region',
        'country',
        'is_active',
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'id_order');
    }
}
