<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->collation('utf8mb4_unicode_ci');
            $table->string('slug')->index()->collation('utf8mb4_unicode_ci');
            $table->integer('stock')->default(0);
            $table->integer('price')->default(0);
            $table->text('description')->collation('utf8mb4_unicode_ci')->nullable(); // mô tả sản phẩm
            $table->integer('user_id')->default(0); // ID user
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
        Schema::dropIfExists('products');
    }
}
