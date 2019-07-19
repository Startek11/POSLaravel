<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('ticket_code')->unique();
            $table->double('subTotal',8,2)->default(0.0);
            $table->double('igv',8,2)->default(0.0);
            $table->double('total',8,2)->default(0.0);
            $table->double('moneyCash',8,2)->default(0.0);
            $table->double('moneyCard',8,2)->default(0.0);
            $table->enum('payMethod',['CASH','CARD','BOTH'])->default('CASH');
            $table->timestamps();

            $table->foreign('ticket_code')
                    ->references('code')
                    ->on('tickets')
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
        Schema::dropIfExists('sales');
    }
}
