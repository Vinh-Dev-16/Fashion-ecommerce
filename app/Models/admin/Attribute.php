<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\ValueAttribute;
class Attribute extends Model
{
    use HasFactory;
    
    protected $table = 'attribute';
    protected $primaryKey = 'id';
    protected $fillable = [
        'value'
    ];
   
    public function valuesAttributes(){
        return $this->hasMany(ValueAttribute::class, 'attribute_id', 'id');
    }
}
