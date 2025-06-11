<?php

namespace Database\Seeders;

use App\Models\RegistrationKey;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MarketSeeder::class,
            StoreSeeder::class,
            RegistrationKeySeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ModuleSeeder::class,
            TextBlockSeeder::class,
            VideoBlockSeeder::class,
            ImageBlockSeeder::class,
            LearningBlockSeeder::class,
            TestDataSeeder::class
        ]);
    }
}
