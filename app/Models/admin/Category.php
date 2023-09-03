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
        'slug',
        'name',
        'parent_id'
    ];
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'category_products','id_category','id_product');
    }

   public function parentCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
   {
         return $this->hasMany(Category::class, 'parent_id');
   }
}
