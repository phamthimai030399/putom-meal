<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = true;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'order_detail';
        $this->attributes['total_money'] = 10;
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
