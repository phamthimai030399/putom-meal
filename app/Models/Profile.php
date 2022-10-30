<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $dates = ['displayed_at'];
    

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'profile';
    }
    public function account()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'profile_id');
    }
}
