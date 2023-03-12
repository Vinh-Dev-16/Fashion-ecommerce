<?php

namespace App\Models\admin;
use App\Models\admin\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Category;
use App\Models\admin\Image;
use App\Models\admin\ValueAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = 
       [
        'name',
        'slug',
        'price',
        'discount',
        'stock',
        'desce',
        'brand_id',
       ];
       

    public function categories(){
        return $this->belongsToMany(Category::class,'category_products','id_product','id_category')->withTimestamps();
    }
    
    public function brands(){
        return $this->belongsTo(Brand::class);
    }
    
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function attributevalues()
    {
        return $this->belongsToMany(ValueAttribute::class,'product_attribute_value', 'product_id','attribute_value_id')->withTimestamps();
    }
}
