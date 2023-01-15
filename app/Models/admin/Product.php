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
        'price',
        'brand_id',
        'thumbnail',
        'discount',
        'stock',
        'desce'
       ];

    public function categories(){
        return $this->belongsToMany(Category::class,'category_products','id_product','id_category');
    }
    
    public function brands(){
        return $this->belongsTo(Brand::class);
    }
}
