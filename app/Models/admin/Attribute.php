<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\ValueAttribute;
class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'value',
        'slug'
    ];

    public function valuesAttributes(){
        return $this->hasMany(ValueAttribute::class, 'attribute_id', 'id');
    }

}
