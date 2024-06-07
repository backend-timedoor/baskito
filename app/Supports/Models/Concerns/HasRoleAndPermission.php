<?php

namespace App\Supports\Models\Concerns;

use Illuminate\Support\Facades\Cache;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission as BaseTrait;

trait HasRoleAndPermission
{
    use BaseTrait;

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function getPermissions()
    {
        if ($this->permissions) {
            return $this->permissions;
        }

        $this->permissions = Cache::tags(['permissions'])->rememberForever($this->getPermissionsCacheKey(), function () {
            return $this->rolePermissions()->get()->merge($this->userPermissions()->get());
        });

        return $this->permissions;
    }

    public function getPermissionsCacheKey(): string
    {
        $key = cast_to_string($this->getKey());

        return "{$this->getTable()}:{$key}:permissions";
    }

    /**
     * @return void
     */
    protected function resetRoles()
    {
        $this->roles = null;
        if (method_exists($this, 'unsetRelation')) {
            $this->unsetRelation('roles');
        } else {
            unset($this->relations['roles']);
        }

        Cache::forget($this->getPermissionsCacheKey());
    }
}
