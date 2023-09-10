<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected  $primaryKey = 'id';
    protected $fillable = [
        'name' => 'name',
        'slug' => 'slug',
    ];

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Permission::class,'roles_permissions')->withTimestamps();

    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(User::class,'users_roles')->withTimestamps();

    }
}
