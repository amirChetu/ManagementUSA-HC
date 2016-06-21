<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('web_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');  
            $table->string('last_name');
            $table->string('email');  
            $table->string('phone');  
            $table->string('location');  
            $table->timestamp('requested_date');  
            $table->string('call_time');  
            $table->tinyInteger('status')->comment('0=> Pending, 1=>Completed');  
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
        //
    }
}