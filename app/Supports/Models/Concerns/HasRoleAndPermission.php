<?php

namespace App\Supports\Models\Concerns;

use Illuminate\Support\Facades\Cache;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission as BaseTrait;

trait HasRoleAndPermission
{
    use BaseTrait;

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
        return "{$this->getTable()}:{$this->getKey()}:permissions";
    }

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
