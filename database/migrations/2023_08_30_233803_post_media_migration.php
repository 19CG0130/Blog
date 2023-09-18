<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_media',function(Blueprint $table){
            $table->increments('id');
            $table->string('file');
            $table->string('content');
            $table->string('description');

            $table->integer('id_post')->unsigned();
            $table->foreign('id_post')->references('id')->on('posts');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_media');
    }
};
