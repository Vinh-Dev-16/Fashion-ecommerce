<?php

namespace App\Models\admin;
use App\Models\admin\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Category;
use App\Models\admin\Image;
use App\Models\admin\ValueAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\admin\Review;
use App\Models\OrderDetail;
use App\Models\Voucher;
use App\Models\Wishlist;

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
        'sale',
        'desce',
        'brand_id',
       ];
       

    public function categories(){
        return $this->belongsToMany(Category::class,'category_products','id_product','id_category')->withTimestamps();
    }
    
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
    public function vouchers(){
        return $this->hasMany(Voucher::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function attributevalues()
    {
        return $this->belongsToMany(ValueAttribute::class,'product_attribute_value', 'product_id','attribute_value_id')->withTimestamps();
    }
}
