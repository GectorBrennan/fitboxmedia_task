<?php
namespace App\Models;


class OrderProduct extends AbstractEntity
{

    protected $table = 'order_product';

    protected $hidden = ['id', 'order_id', 'product_id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}