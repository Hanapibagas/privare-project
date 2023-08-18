<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'roles' => 'admin',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'owener',
            'alamat' => 'jln.dumy',
            'roles' => 'owner',
            'email' => 'owener@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'hanapi',
            'roles' => 'user',
            'alamat' => 'jln.dumy',
            'email' => 'hanapi@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
