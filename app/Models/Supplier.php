<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'created_at',
        'updated_at'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'supplier';
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id')
        ->whereHas('category', function($q){
            $q->where('status', '=', '1');
        })->where('status', 1);
    }
}
