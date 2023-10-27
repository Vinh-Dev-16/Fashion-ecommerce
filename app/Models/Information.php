<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Information extends Model
{
    use HasFactory;
    protected $table = 'info_accounts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'birthday',
        'province',
        'district',
        'address',
        'commune',
        'district_id',
        'commune_id',
        'province_id',
        'address',
        'gender',
        'hobbies',
        'description',
        'avatar',
    ];

    public function user(){
        return $this->belongsTo(User::class,);
    }
}
