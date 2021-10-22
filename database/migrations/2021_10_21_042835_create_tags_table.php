<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->collation('utf8mb4_unicode_ci');
            $table->string('slug')->index()->collation('utf8mb4_unicode_ci');
            $table->text('content')->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('meta_title',255)->collation('utf8mb4_unicode_ci')->nullable(); // keyword for SEO
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
        Schema::dropIfExists('tags');
    }
}
