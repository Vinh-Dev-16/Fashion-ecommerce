<?php

namespace App\Models\admin;

use App\Models\admin\Brand;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Category;
use App\Models\admin\Image;
use App\Models\admin\ValueAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\admin\FeedBack;
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
            'tags',
            'view',
            'count',
            'weight',
        ];


    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'id_product', 'id_category')->withTimestamps();
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function orderDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function wishlists(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    public function feedbacks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FeedBack::class);
    }

    public function attributevalues(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ValueAttribute::class, 'product_attribute_value', 'product_id', 'attribute_value_id')->withTimestamps();
    }

    public function materials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Material::class);
    }
}
