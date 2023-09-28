<?php

namespace App\Models;

use App\Models\admin\FeedBack;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = [
        'user_id',
        'feed_back_id',
    ];

    public function feedback(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FeedBack::class);
    }
}
