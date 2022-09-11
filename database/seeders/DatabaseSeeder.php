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
                'name' => 'ROOT',
                'phone' => 'ROOT',
                'password' => bcrypt('root'),
            ],
            [
                'name' => 'Admin01',
                'phone' => '1',
                'password' => bcrypt('1'),
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'User01',
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
