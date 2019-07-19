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
            $table->bigIncrements('id');
            $table->string('description',20);
            $table->string('code')->unique();
            $table->bigInteger('type_id')->unsigned();
            $table->double('price',8,2)->default(0.0);
            $table->boolean('available')->default(true);
            $table->timestamps();

            $table->foreign('type_id')
                    ->references('id')
                    ->on('type_product')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
