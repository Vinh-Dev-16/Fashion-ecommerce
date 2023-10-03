<?php

namespace App\Models;

use App\Models\admin\FeedBack;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageFeedBack extends Model
{
    use HasFactory;
    protected $table = 'images_feedbacks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'path',
        'feedback_id',
    ];

    public function feedbacks(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FeedBack::class, 'feedback_id');
    }
}
