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
            $table->integer('child_id');
            $table->integer('m_id')->nullable();
            $table->string('p_name');
            $table->longText('description')->nullable();
             $table->longText('long_description')->nullable();
            $table->float('price');
            $table->integer('qty');
             $table->float('discount');
            $table->integer('available_qty');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('status')->default('off');
            $table->string('path')->nullable();
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
