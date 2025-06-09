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
                'is_mail_confirmed' => true,
                'current_streak' => 0,
                'last_connection' => null,
                'registration_key_id' => 1
            ],
            [
                'id' => 2,
                'surname' => 'Chautems',
                'firstname' => 'Emma',
                'nickname' => 'emma',
                'email' => 'emma.chautems@heig-vd.ch',
                'email_verified_at' => null,
                'password' => Hash::make('Heig2025'),
                'is_mail_confirmed' => true,
                'current_streak' => 0,
                'last_connection' => null,
                'registration_key_id' => 1
            ],
            [
                'id' => 3,
                'surname' => 'Pottier',
                'firstname' => 'Cristian',
                'nickname' => 'cristpttr',
                'email' => 'cristian.pottier@heig-vd.ch',
                'email_verified_at' => null,
                'password' => Hash::make('Heig2025'),
                'is_mail_confirmed' => true,
                'current_streak' => 0,
                'last_connection' => null,
                'registration_key_id' => 1
            ],
            [
                'id' => 4,
                'surname' => 'Bossel',
                'firstname' => 'Malory',
                'nickname' => 'malo',
                'email' => 'malory.bossel@heig-vd.ch',
                'email_verified_at' => null,
                'password' => Hash::make('Heig2025'),
                'is_mail_confirmed' => true,
                'current_streak' => 0,
                'last_connection' => null,
                'registration_key_id' => 2
            ],
            [
                'id' => 5,
                'surname' => 'Crettex',
                'firstname' => 'Lorie',
                'nickname' => 'lolo',
                'email' => 'lorie.crettex@heig-vd.ch',
                'email_verified_at' => null,
                'password' => Hash::make('Heig2025'),
                'is_mail_confirmed' => true,
                'current_streak' => 0,
                'last_connection' => null,
                'registration_key_id' => 2
            ],
        ]);
    }
}
