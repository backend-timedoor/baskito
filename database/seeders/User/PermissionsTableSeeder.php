<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $permissions = json_decode(
            File::get(storage_path('master/permission/permissions.json'))
        );

        $model = config('roles.models.permission');

        /*
         * Add Permission Items
         *
         */
        foreach ($permissions as $permission) {
            $model::updateOrCreate(
                ['slug' => $permission->slug],
                [
                    'name'        => $permission->name,
                    'description' => $permission->description,
                    'model'       => $permission->model,
                ]
            );
        }
    }
}
