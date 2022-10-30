<?php

namespace App\Models;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static $_tree = [];
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_parent_id',
        'status',
        'created_at',
        'updated_at'
    ];
    use HasFactory;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'category';
    }

    static function getTree(){
        $all = self::getAllCategory();
        self::_recursive_child($all);
        return self::$_tree;
    }

    static function listCategoryIdsChild($categoryId = [], $parentId = 0) {
        $all = self::getAllCategory();
        return self::_recursive_id_child($categoryId, $all, $parentId);
    }
    private static function _recursive_child($all = [], $parentId = 0, $prefix = '') {
        if (!empty($all)) foreach ($all as $key => $item) {
            if ($item->category_parent_id == (int) $parentId) {
                self::$_tree[$item->id] = (object)[
                    'id' => $item->id,
                    'title' => $prefix.$item->title
                ];
                self::_recursive_child($all, $item->id, $prefix. '--');
            }
        }
    }

    public function categoryParent()
    {
        return $this->belongsTo(Category::class, 'category_parent_id');
    }
    private static function _recursive_id_child($categoryId = [], $all , $parentId = 0) {
        if (!empty($all)) foreach ($all as $key => $item) {
            if ($item->category_parent_id === $parentId) {
                $categoryId = self::listCategoryIdsChild($categoryId, $all, $item->id);
                array_push($categoryId, $item->id);
            }
        }
        return $categoryId;
    }


    public static function getAllCategory()
    {
        // return Cache::remember(':categories', 15 * 60, function () {
            
        // });
        return parent::where('status', 1)->get();
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'category_parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')
        ->whereHas('supplier', function($q){
            $q->where('status', '=', '1');
        })->where('status', 1);
    }
}
