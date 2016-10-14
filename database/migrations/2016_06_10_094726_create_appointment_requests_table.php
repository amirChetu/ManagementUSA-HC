<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('marketing_phone',15);
            $table->string('call_time', 31);
            $table->string('comment');
            $table->integer('created_by');
            $table->tinyInteger('appt_source')->default(0)->comment('1=>Web_leads, 2=> Marketing calls, 3=> Walikins');
            $table->date('followup_date');
            $table->tinyInteger('followup_status')->default(0)->comment('0=> Not Show , 1=>Show in Listing');
            $table->tinyInteger('status')->nullable()->comment('0=>Set, 1=>No Set');
            $table->tinyInteger('noSetStatus')->comment('0 => Next Appointment, 1 => End Appointment');
            $table->integer('location_id');
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
        //
    }
}
