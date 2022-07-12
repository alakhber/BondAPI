<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    
    public function run()
    {
        PurchaseOrder::create([
            'bond_id'=>1,
            'order_date'=>'2021-11-23',
            'bond_received'=>10,
        ]);
    }
}
