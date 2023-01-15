<?php

namespace App\Models\admin;
use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'product_id',
        'logo',
    ];
    
    public function products(){
         
         return $this->hasMany(Product::class);
    }
}
