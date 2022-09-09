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
                'phone' => '1',
                'password' => bcrypt('1'),
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'User123',
                'phone' => '1',
                'password' => bcrypt('1'),
                'point' => 0,
            ]
        ]);

        // DB::table('products')->insert([
        //     [
        //         'name' => 'Admin',
        //         'phone' => '1',
        //         'password' => bcrypt('123456'),
        //     ]
        // ]);
    }
}
