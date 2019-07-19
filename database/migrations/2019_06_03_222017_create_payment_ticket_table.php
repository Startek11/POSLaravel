<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sale_code')->unique();
            $table->string('code')->unique();
            $table->string('client_document',8);
            $table->string('client_name',30);
            $table->timestamps();

            $table->foreign('sale_code')
                    ->references('code')
                    ->on('sales')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_ticket');
    }
}
