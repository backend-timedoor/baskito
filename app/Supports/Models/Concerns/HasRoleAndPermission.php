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

        $key = $this->getPermissionsCacheKey();
        $cb  = function () {
            return $this->rolePermissions()->get()->merge($this->userPermissions()->get());
        };

        $this->permissions = $key ? Cache::tags(['permissions'])->rememberForever($key, $cb) : $cb();

        return $this->permissions;
    }

    /**
     * Return `null` if model doesn't exist in database yet.
     */
    public function getPermissionsCacheKey(): ?string
    {
        $key = cast_to_string($this->getKey());

        return $this->exists ? "{$this->getTable()}:{$key}:permissions" : null;
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

        if ($this->getPermissionsCacheKey()) {
            Cache::forget($this->getPermissionsCacheKey());
        }
    }

    /**
     * Sync roles for a user.
     *
     * @param  array<int, string|int>|\Illuminate\Database\Eloquent\Collection<int, \jeremykenedy\LaravelRoles\Models\Role>  $roles
     * @return array<string, int|string[]>|array{attached: int|string[], detached: int|string[], updated: int|string[]}
     */
    public function syncRoles($roles)
    {
        $this->resetRoles();

        return $this->roles()->sync($roles);
    }
}
