<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}