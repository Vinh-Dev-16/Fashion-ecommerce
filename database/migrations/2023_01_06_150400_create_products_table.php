<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->unique();
            $table->string('made_by')->unique();
            $table->integer('id_category')->nullable();
            $table->integer('id_year')->nullable();
            $table->string('color');
            $table->string('size');
            $table->string('day_discount')->nullable();
            $table->integer('price');
            $table->decimal('discount');
            $table->integer('stock');
            $table->string('thumbnail');
            $table->string('desce');
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
