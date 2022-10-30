<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    
    protected $fillable = ['title', 'link', 'parent_id', 'order'];

    public  static function boot() {
        parent::boot();

        static::deleting(function($c) {
            $c->childs->each(function($child) {
                $child->delete();
            });
            return true;
        });
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id', 'id')->orderBy('order');
    }
}
