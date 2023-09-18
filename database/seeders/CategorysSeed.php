<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorysSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<10;$i++){
        DB::table('categorys')->insert([
            'category'=>'Categoria '.($i+1),
            'slug'=>'categoria_'.($i+1),
            'created_at'=>date('Y-m-d h:m:s')
        ]);
    }//Llave for
    }
}
