<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fullname',
        'user_id',
        'phone',
        'address',
        'note',
        'subtotal',
        'status',
        'total_money',
    ];

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
