<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = 
       [
        'name',
        'made_by',
        'made_day',
        'price',
        'thumbnail',
        'size',
        'color',
        'id_year',
        'id_category',
        'id_brand',
        'discount',
        'day_discount',
        'stock',
        'desce'
       ];
}
