<?php
/**
 * Created by PhpStorm.
 * User: gectorgrundy
 * Date: 19.05.18
 * Time: 17:22
 */

namespace App\Models;


use App\Models\Traits\EloquentHashids;

class Product extends AbstractEntity
{
    use EloquentHashids;

    protected $table = 'products';
    protected $fillable = ['title', 'cost'];
    protected $hidden = ['id'];

}