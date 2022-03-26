<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->bigInteger('price');
        $table->integer('stok');
        $table->bigInteger('category_id')->unsigned();
        $table->bigInteger('user_id')->unsigned();
        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('catproduct');
        $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
