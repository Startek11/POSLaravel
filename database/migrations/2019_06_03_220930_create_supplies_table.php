<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',20);
            $table->string('code')->unique();
            $table->bigInteger('provider_id')->unsigned();
            $table->string('description',30);
            $table->integer('stock')->default(0);
            $table->double('unitPrice',8,2)->default(0.0);
            $table->boolean('available')->default(true);
            $table->timestamps();

            $table->foreign('provider_id')
                    ->references('id')
                    ->on('providers')
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
        Schema::dropIfExists('supplies');
    }
}
