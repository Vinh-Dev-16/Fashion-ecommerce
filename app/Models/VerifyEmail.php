<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyEmail extends Model
{
    use HasFactory;
    protected $table = 'verify_emails';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'email',
        'otp',
        'set_up_time',
    ];
}
