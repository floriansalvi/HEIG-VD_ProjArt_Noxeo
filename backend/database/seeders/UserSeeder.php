<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => 1,
                'surname' => 'Salvi',
                'firstname' => 'Florian',
                'nickname' => 'floflo',
                'email' => 'florian.salvi@heig-vd.ch',
                'email_verified_at' => null,
                'password' => Hash::make('Heig2025'),
                'is_mail_confirmed' => false,
                'current_streak' => 0,
                'last_connection' => null,
                'registration_key_id' => null
            ]
        ]);
    }
}
