<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('day')->useCurrent()->unique();
            $table->double('capital',8,2)->default(0.0);
            $table->double('totalSales',8,2)->default(0.0);
            $table->double('salesCash',8,2)->default(0.0);
            $table->double('salesCard',8,2)->default(0.0);
            $table->date('closed_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_boxes');
    }
}
