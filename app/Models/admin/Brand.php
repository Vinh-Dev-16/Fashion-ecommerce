<?php

namespace App\Models\admin;
use App\Models\admin\Product;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
    ];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {

         return $this->hasMany(Product::class);
    }
    public function vouchers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Voucher::class);
    }
}
