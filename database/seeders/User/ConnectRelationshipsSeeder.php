<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissionModel = config('roles.models.permission');
        $roleModel       = config('roles.models.role');

        $rolePermissions = json_decode(
            File::get(storage_path('master/permission/role-permission.json'))
        );

        /**
         * Attach Permissions to Roles.
         */
        foreach ($rolePermissions as $relation) {
            $role = $roleModel::firstWhere('slug', $relation->role);

            $permissions = $permissionModel::whereIn('slug', $relation->permissions)->get();

            $role->syncPermissions($permissions);
        }

        Cache::tags(['permissions'])->flush();
    }
}
