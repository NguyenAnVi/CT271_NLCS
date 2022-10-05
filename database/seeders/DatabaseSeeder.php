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
                'phone' => '01',
                'password' => bcrypt('01'),
            ],
            [
                'name' => 'Admin02',
                'phone' => '02',
                'password' => bcrypt('02'),
            ],
            [
                'name' => 'Admin03',
                'phone' => '03',
                'password' => bcrypt('03'),
            ],
            [
                'name' => 'Admin04',
                'phone' => '04',
                'password' => bcrypt('04'),
            ],
            [
                'name' => 'Admin05',
                'phone' => '05',
                'password' => bcrypt('05'),
            ],
            [
                'name' => 'Admin06',
                'phone' => '06',
                'password' => bcrypt('06'),
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'User01',
                'phone' => '1',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User02',
                'phone' => '2',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User03',
                'phone' => '3',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User04',
                'phone' => '4',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User05',
                'phone' => '5',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User06',
                'phone' => '6',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User07',
                'phone' => '7',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User08',
                'phone' => '8',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User09',
                'phone' => '9',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User10',
                'phone' => '10',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User11',
                'phone' => '11',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User12',
                'phone' => '12',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
        ]);

        DB::table('saleoffs')->insert([
            [
                'name' => 'NONE',
                'amount' => 0,
                'percent' => 0,
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-04 15:43:00',
                'imageurl' => ''
            ],
            [
                'name' => 'Siêu deal vui khỏe - Dành cho sản phẩm Chăm sóc cá nhân',
                'amount' => '55000',
                'percent' => 0,
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/1.webp'
            ],
            [
                'name' => 'Siêu deal vui khỏe - Dành cho các sản phẩm chăm sóc sắc đẹp',
                'amount' => 0,
                'percent' => '5',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/2.webp'
            ],
            [
                'name' => 'KM khi mua Solga',
                'amount' => 0,
                'percent' => '30',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/3.webp'
            ],
            [
                'name' => 'Tri ân khách hàng',
                'amount' => 0,
                'percent' => '30',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/4.jpg'
            ],
            [
                'name' => 'Black Friday',
                'amount' => '50000',
                'percent' => 0,
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/5.jpg'
            ],
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
