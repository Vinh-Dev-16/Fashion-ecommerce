<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
       'order_id',
       'product_id',
       'name',
       'quantity',
       'sale',
       'discount',
       'size',
       'color',
       'price',
       'total_money',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
