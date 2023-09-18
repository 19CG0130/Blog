<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Admin',
            'email'=>'Admin@gmail.com',
            'password'=>Hash::make('123'),
            'img'=>'default.jpg',
            'nickname'=>'admin'
        ]);

        DB::table('users')->insert([
            'name'=>'Juan',
            'email'=>'Juan@gmail.com',
            'password'=>Hash::make('123'),
            'img'=>'default.jpg',
            'nickname'=>'Juan003'
        ]);
    }
}
