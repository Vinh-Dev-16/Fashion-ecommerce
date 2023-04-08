<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Information extends Model
{
    use HasFactory;
    protected $table = 'infoaccounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'address',
        'birthday',
        'gender',
        'hobbies',
        'description',
        'avatar',
    ];

    public function user(){
        return $this->belongsTo(User::class,);
    }
}
