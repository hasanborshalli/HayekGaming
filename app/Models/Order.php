<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'mobile',
        'second_mobile',
        'city',
        'street',
        'building',
        'floor',
        'remarks',
        'total',
    ];
    public function products()
    {
        return $this->hasMany(order_item::class, 'order_id');
    }
}