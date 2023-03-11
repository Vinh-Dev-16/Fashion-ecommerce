<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;
class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'path',
        'product_id',
    ];

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
