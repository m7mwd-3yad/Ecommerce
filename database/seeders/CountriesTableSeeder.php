<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ['name' => 'Afghanistan', 'code' => 'AF', 'continent' => 'Asia', 'currency' => 'AFN'],
            ['name' => 'Albania', 'code' => 'AL', 'continent' => 'Europe', 'currency' => 'ALL'],
            ['name' => 'Algeria', 'code' => 'DZ', 'continent' => 'Africa', 'currency' => 'DZD'],
            ['name' => 'Andorra', 'code' => 'AD', 'continent' => 'Europe', 'currency' => 'EUR'],
            ['name' => 'Angola', 'code' => 'AO', 'continent' => 'Africa', 'currency' => 'AOA'],
            ['name' => 'Argentina', 'code' => 'AR', 'continent' => 'South America', 'currency' => 'ARS'],
            ['name' => 'Australia', 'code' => 'AU', 'continent' => 'Oceania', 'currency' => 'AUD'],
            ['name' => 'Austria', 'code' => 'AT', 'continent' => 'Europe', 'currency' => 'EUR'],
            ['name' => 'Bahrain', 'code' => 'BH', 'continent' => 'Asia', 'currency' => 'BHD'],
            ['name' => 'Bangladesh', 'code' => 'BD', 'continent' => 'Asia', 'currency' => 'BDT'],
            ['name' => 'Belgium', 'code' => 'BE', 'continent' => 'Europe', 'currency' => 'EUR'],
            ['name' => 'Brazil', 'code' => 'BR', 'continent' => 'South America', 'currency' => 'BRL'],
            ['name' => 'Canada', 'code' => 'CA', 'continent' => 'North America', 'currency' => 'CAD'],
            ['name' => 'China', 'code' => 'CN', 'continent' => 'Asia', 'currency' => 'CNY'],
            ['name' => 'Egypt', 'code' => 'EG', 'continent' => 'Africa', 'currency' => 'EGP'],
            ['name' => 'France', 'code' => 'FR', 'continent' => 'Europe', 'currency' => 'EUR'],
            ['name' => 'Germany', 'code' => 'DE', 'continent' => 'Europe', 'currency' => 'EUR'],
            ['name' => 'India', 'code' => 'IN', 'continent' => 'Asia', 'currency' => 'INR'],
            ['name' => 'Iraq', 'code' => 'IQ', 'continent' => 'Asia', 'currency' => 'IQD'],
            ['name' => 'Italy', 'code' => 'IT', 'continent' => 'Europe', 'currency' => 'EUR'],
            ['name' => 'Japan', 'code' => 'JP', 'continent' => 'Asia', 'currency' => 'JPY'],
            ['name' => 'Kuwait', 'code' => 'KW', 'continent' => 'Asia', 'currency' => 'KWD'],
            ['name' => 'Lebanon', 'code' => 'LB', 'continent' => 'Asia', 'currency' => 'LBP'],
            ['name' => 'Saudi Arabia', 'code' => 'SA', 'continent' => 'Asia', 'currency' => 'SAR'],
            ['name' => 'United States', 'code' => 'US', 'continent' => 'North America', 'currency' => 'USD'],
        ];

        DB::table('countries')->insert($countries);
    }
}
