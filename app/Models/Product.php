<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = 
       [
        'name',
        'made_by',
        'price',
        'thumbnail',
        'size',
        'color',
        'id_year',
        'id_category',
        'discount',
        'day_discount',
        'stock',
        'desce'
       ];
    
}
