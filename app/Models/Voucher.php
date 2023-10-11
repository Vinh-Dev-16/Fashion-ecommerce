<?php

namespace App\Models;

use App\Models\admin\Brand;
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
        'quantity',
        'percent',
        'max',
        'min_price',
        'start_date',
        'end_date',
        'type',
        'price'
    ];

    public function brands(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'brands_vouchers', 'voucher_id', 'brand_id');
    }
}
