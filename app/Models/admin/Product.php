<?php

namespace App\Models\admin;
use App\Models\admin\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Category;
use App\Models\admin\CategoryProduct;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = 
       [
        'name',
        'slug',
        'price',
        'category_id',
        'thumbnail',
        'discount',
        'stock',
        'tag',
        'desce',
        'brand_id',
       ];
       

    public function categories(){
        return $this->belongsToMany(Category::class,'category_products','id_product','id_category')->withTimestamps();
    }
    
    public function brands(){
        return $this->belongsTo(Brand::class);
    }
     
}
