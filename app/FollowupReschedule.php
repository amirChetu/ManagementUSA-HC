<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to followup_reschedules tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class FollowupReschedule extends Model {

    use SoftDeletes;

    protected $table = 'followup_reschedules';
    
    /**
    * This function create linking between appointments table and followup_reschedules table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointment() {
        return $this->belongsTo('App\Appointment', 'new_appointment_id')->select('id', 'apptTime');
    }

}
