<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoAccount extends Model
{
    use HasFactory;
    protected $table = 'info_account';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'birthday',
        'gender',
        'age',
        'image_url',
    ];
}
