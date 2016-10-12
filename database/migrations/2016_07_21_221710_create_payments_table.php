<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->increments('id');
            $table->string('order_unique_id', 31);
            $table->integer('patient_id');
            $table->integer('agent_id');
            $table->tinyInteger('payment_type')->comment('0=> Cash In Hand, 1=> Credit Card');
            $table->decimal('total_amount',10,2);
            $table->decimal('paid_amount',10,2);
            $table->tinyInteger('payment_status')->comment('0 = Uncompleted, 1=> Completed with EMI or Total Amount');
            $table->tinyInteger('payment_emi_status')->comment('0 = Main Payment, 1= EMI Installment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
