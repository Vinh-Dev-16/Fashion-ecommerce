<?php

namespace App\Models\admin;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Product;
class FeedBack extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'title',
        'rate',
        'content',
        'product_id',
    ];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class);
    }
}
