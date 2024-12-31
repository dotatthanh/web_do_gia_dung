<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropColumn('size');
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('size');
        });
        Schema::dropIfExists('sizes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->string('size')->nullable();
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->string('size')->nullable();
        });
        Schema::create('sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->string('name');
        });
    }
}
