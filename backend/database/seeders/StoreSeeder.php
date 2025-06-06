<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::insert([
            [
                'id' => 1,
                'name' => 'Heig',
                'address' => 'Avenue des Sport 20',
                'zip_code' => '1401',
                'city' => 'Yverdon-les-Bains',
                'email' => 'florian.salvi@heig-vd.ch',
                'phone' => '0792946303',
                'market_id' => 1
            ]
        ]);
    }
}
