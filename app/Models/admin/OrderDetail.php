<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
       'user_id',
       'fullname',
       'phone',
       'address',
       'subtotal',
       'total_money',
    ];
}
