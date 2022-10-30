<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'order';
    }
    public function person()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
