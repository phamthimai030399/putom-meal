<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $dates = ['displayed_at'];
    

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'cart';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
