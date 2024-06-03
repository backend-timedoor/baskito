<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = config('roles.models.role')::where('slug', '=', 'super.admin')->first();
        $userClass = config('roles.models.defaultUser');

        $this->command->info('Here is your admin details to login:');
        $this->command->info('----------------------------');

        foreach (config('auth.default_admins', []) as $key => $value) {
            $email = $value['email'] ?? null;

            if (! $email) {
                continue;
            }

            $pass  = Random::generate(12, '0-9a-zA-Z!@#$%&*()_+{}[]');
            $admin = $userClass::firstOrCreate([
                'email' => $value['email'],
            ], [
                'name'     => $value['name'] ?? '',
                'password' => $pass,
            ]);

            $this->command->warn("Email    : {$admin->email}");
            $this->command->warn("Password : {$pass}");
            $this->command->info('----------------------------');

            $admin->attachRole($adminRole);
        }
    }
}
