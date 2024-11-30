<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'customer_name' => 'Mark Doe',
                'email' => 'mark@example.com',
                'phone' => '1234566',
                'status' => 'Pending',
                'amount' => 21.10,
                'date_purchased' => '2023-08-26',
            ],
            [
                'customer_name' => 'Mark Doe',
                'email' => 'mark@example.com',
                'phone' => '1234566',
                'status' => 'Delivered',
                'amount' => 1540.20,
                'date_purchased' => '2023-08-24',
            ],
            [
                'customer_name' => 'Mark Doe',
                'email' => 'markl@example.com',
                'phone' => '1234556',
                'status' => 'Delivered',
                'amount' => 1540.20,
                'date_purchased' => '2023-08-26',
            ],
        ]);
    }
}

