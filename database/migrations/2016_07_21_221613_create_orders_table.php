<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_unique_id', 31)->commnet('Randomly generated value for complete Order');
            $table->integer('payment_id');
            $table->integer('category_id');
            $table->string('category');
            $table->string('package_type');
            $table->decimal('price',10,2);
            $table->decimal('discount_price',10,2);
            $table->boolean('status');
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
        Schema::drop('orders');
    }
}
