<?php

namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;
trait HasPermissionTrait {

    public function getAllPermissions($permission) {
        return Permission::whereIn('slug', $permission)->get();
    }

    protected function hasPermission($permission): bool
    {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }
    public function hasRole( ... $roles ): bool
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function withdrawPermissionsTo( ... $permissions ): static
    {

        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;

    }

    public function refreshPermissions( ... $permissions ): \App\Models\User
    {

        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function givePermissionsTo(... $permissions): static
    {

        $permissions = $this->getAllPermissions($permissions);
        if($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function hasPermissionTo($permission): bool
    {

        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }
    public function hasPermissionThroughRole($permission): bool
    {

        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Role::class,'users_roles');

    }
    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Permission::class,'users_permissions');

    }
}
