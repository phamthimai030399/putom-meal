<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = ['title', 'slug', 'description', 'thumbnail', 'category_id', 'supplier_id', 'price_origin', 'price_sell', 'unit_of_measure', 'unit_of_sell', 'status'];
    

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'product';
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
