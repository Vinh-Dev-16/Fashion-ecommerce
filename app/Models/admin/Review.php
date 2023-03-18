<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'title',
        'content',
        'product_id',
    ];
}
