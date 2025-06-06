<?php

namespace Database\Seeders;

use App\Models\RegistrationKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RegistrationKey::insert([
            [
                'id' => 1,
                'key' => 'heig-vd',
                'store_id' => 1
            ]
        ]);
    }
}
