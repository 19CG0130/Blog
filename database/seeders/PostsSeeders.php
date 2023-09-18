<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'title'=>'Post 1',
            'content'=>'Mi primer post',
            'img'=>'default.jpg',
            'slug'=>'post_1',
            'likes'=>0,
            'id_user'=>2,
            'id_category'=>7
        ]);

        DB::table('posts')->insert([
            'title'=>'Post 2',
            'content'=>'Mi Segundo post',
            'img'=>'default.jpg',
            'slug'=>'post_2',
            'likes'=>4,
            'id_user'=>2,
            'id_category'=>4
        ]);
    }
}
