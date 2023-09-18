<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostMediaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('post_media')->insert([
            'file'=>'File 1',
            'content'=>'Mi primer post media',
            'description'=>'Description',
            
            'id_post'=>2
        ]);
    }
}
