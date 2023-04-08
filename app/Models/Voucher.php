<?php

namespace App\Models;

use App\Models\admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'voucher';
    protected $primaryKey = 'id';
    protected $fillable = [
        'value',
        'product_id',
        'quantity',
        'percent',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
