<?php

namespace App\Models\admin;
use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\CategoryProduct;
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'parent_id'
    ];
    public function products(){
        return $this->belongsToMany(Product::class,'category_products','id_category','id_product');
    }  
}
