<?php

namespace App\Models\admin;
use App\Models\admin\Product;
use App\Models\admin\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_product',
        'id_category',
    ];
}
