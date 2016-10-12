<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration {

    public function up() {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('relative_id')->comment('Appointment Request Id');
            $table->datetime('apptTime'); //appointment_time
            $table->integer('appt_source');
            $table->integer('request_id');
            $table->tinyInteger('status')->default(1)->comment('1=>Active, 2=>Reschedule, 3=>Cancel, 4=>Confirm, 5=> Never Treat, 6=>Followup Later');
            $table->tinyInteger('email_invitation');
            $table->integer('createdBy')->unsigned; //user_id
            $table->integer('lastUpdatedBy')->unsigned;
            $table->integer('patient_id')->unsigned;
            $table->integer('doctor_id')->unsigned;
            $table->text('comment');
            $table->tinyInteger('progress_status')->comment('1=>Send to Lab, 2=> Waiting for Report, 3=> Ready Lab Report, 4=> New Appointment after lab report');
            $table->tinyInteger('patient_status')->default(0)->comment('1=>Show, 2=>No Show');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('appointments');
    }

}
