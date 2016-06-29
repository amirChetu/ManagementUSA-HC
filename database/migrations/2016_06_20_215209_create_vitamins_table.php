<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitamins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');            
            $table->tinyInteger('needle_afraid')->nullable()->comment('0=>No, 1=> Yes');            
            $table->string('afraid_limit'); 
            $table->string('injectable_type');
            $table->string('total_wellness');            
            $table->tinyInteger('weight_supplement')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('vitamin_knowledge');
            $table->tinyInteger('vitamin_taken')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('wellness_tested')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('vitamin_drip')->nullable()->comment('0=>No, 1=> Yes');
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