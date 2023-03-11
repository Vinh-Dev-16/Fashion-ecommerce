<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Attribute;
class ValueAttribute extends Model
{
    use HasFactory;
    protected $table = 'attribute_value';
    protected $primaryKey = 'id';
    protected $fillable = [
        'value',
        'attribute_id',
    ];

    public function attributes(){
        return $this ->belongsTo(Attribute::class,'attribute_id', 'id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,'product_attribute_value','product_id','attribute_value_id','id')->withTimestamps();
    }
}
