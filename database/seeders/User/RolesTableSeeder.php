<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $roles = json_decode(
            File::get(storage_path('master/permission/roles.json'))
        );

        $model = config('roles.models.role');

        /*
         * Add Role Items
         *
         */
        foreach ($roles as $role) {
            $model::updateOrCreate(
                ['slug' => $role->slug],
                [
                    'name'        => $role->name,
                    'description' => $role->description,
                    'level'       => $role->level,
                ]
            );
        }
    }
}
