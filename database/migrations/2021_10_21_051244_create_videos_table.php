<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // tieu de
            $table->string('description'); // mo ta
            $table->integer('length'); // do dai video second
            $table->integer('views'); // luot xem
            $table->string('thumbnail_url'); // link anh thumbnail
            $table->integer('user_id')->default(0); // ID user post video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
