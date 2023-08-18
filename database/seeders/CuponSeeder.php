<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'user_id' => '3',
            'coupon_code' => 'DM',
            'description' => 'Data Dumy',
            'expired' => '2030-03-20',
            'status' => '1',
            'discount' => '20',
        ]);
    }
}
