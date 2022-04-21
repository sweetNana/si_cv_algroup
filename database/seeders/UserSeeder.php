<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        // User::create([
        //     'name' => 'Super Admin',
        //     'role' => 'superadmin',
        //     'email' => 'superadmin@gmail.com',
        //     'password' => bcrypt('superadmin'),
        //     'remember_token' => Str::random(60),
        // ]);
        $users =  [
            [
                'name' => 'Super Admin',
                'role' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('superadmin'),
                'remember_token' => Str::random(60),
            ],
            [
                'name' => 'Staf',
                'role' => 'staf',
                'email' => 'staf@gmail.com',
                'password' => bcrypt('staf'),
                'remember_token' => Str::random(60),
            ],
            [
                'name' => 'Ketua',
                'role' => 'ketua',
                'email' => 'ketua@gmail.com',
                'password' => bcrypt('ketua'),
                'remember_token' => Str::random(60),
            ],
            [
                'name' => 'Admin',
                'role' => 'staf',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'remember_token' => Str::random(60),
            ],
            [
                'name' => 'Maman',
                'role' => 'staf',
                'email' => 'maman@gmail.com',
                'password' => bcrypt('maman'),
                'remember_token' => Str::random(60),
            ],
            [
                'name' => 'Rainad',
                'role' => 'ketua',
                'email' => 'rainad@gmail.com',
                'password' => bcrypt('rainad'),
                'remember_token' => Str::random(60),
            ],
            [
                'name' => 'Azmi',
                'role' => 'ketua',
                'email' => 'azmi@gmail.com',
                'password' => bcrypt('azmi'),
                'remember_token' => Str::random(60),
            ]
          ];

          User::insert($users);
    }
}
