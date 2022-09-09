<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'User',
                'phone' => '0939963285',
                // 'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                // 'address' => 'VinhPhu - ThoaiSon - AnGiang',
                'point' => 0,
            ]
        ]);
    }
}
