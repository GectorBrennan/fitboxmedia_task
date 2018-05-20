<?php
/**
 * Created by PhpStorm.
 * User: gectorgrundy
 * Date: 19.05.18
 * Time: 23:50
 */

namespace App\Models;


use App\Models\Traits\EloquentHashids;

class Order extends AbstractEntity
{
    use EloquentHashids;

    protected $table = 'orders';

    protected $fillable = ['user_id'];
    protected $hidden = ['id', 'user_id'];

    protected $appends = ['user_hash'];

    public function getUserHashAttribute()
    {
        return \Hashids::encode($this->attributes['user_id']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}