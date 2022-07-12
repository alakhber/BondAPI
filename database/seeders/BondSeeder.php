<?php

namespace Database\Seeders;

use App\Models\Bond;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BondSeeder extends Seeder
{
   
    public function run()
    {
        Bond::create([
            'emission_date'=>'2021-11-08',
            'turnover_end_date'=>'2022-11-03',
            'nominal'=>100,
            'coupon_redemption_frequency'=>'4',
            'interest_calculation_period'=>'360',
            'coupon_interest'=>10
        ]);

        Bond::create([
            'emission_date'=>'2021-11-08',
            'turnover_end_date'=>'2022-11-07',
            'nominal'=>200,
            'coupon_redemption_frequency'=>'4',
            'interest_calculation_period'=>'364',
            'coupon_interest'=>20
        ]);
        Bond::create([
            'emission_date'=>'2021-11-08',
            'turnover_end_date'=>'2022-11-08',
            'nominal'=>300,
            'coupon_redemption_frequency'=>'4',
            'interest_calculation_period'=>'365',
            'coupon_interest'=>30
        ]);
    }
}
