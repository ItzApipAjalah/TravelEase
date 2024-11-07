<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\type;

class UserAccount extends Seeder
{
    /**
 * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('121212345'),
            'type' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'officer',
            'email' => 'officer@email.com',
            'password' => Hash::make('121212346'),
            'type' => 'officer'
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => Hash::make('121212347'),
            'type' => 'user'
        ]);


    }
}
