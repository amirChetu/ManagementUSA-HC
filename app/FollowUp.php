<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to followups tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class FollowUp extends Model {

    use SoftDeletes;
	
    protected $table = 'followups';
    protected $fillable = [
        'id',
        'appt_id',
        'created_by',
        'action',
        'status',
        'comment',
        'followup_later_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
    * This function create linking between appointments table and followups table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appt_id')->select('id', 'apptTime', 'patient_id', 'doctor_id', 'comment');
    }
    
    /**
    * This function create linking between followup_schedules table and followups table.
    *
    * @parms void;
    *
    * @return null
    */
    public function schedule() {
        return $this->hasOne('App\FollowupReschedule', 'followup_id');
    }
    
    /**
    * This function create linking between followup_status table and followups table.
    *
    * @parms void;
    *
    * @return null
    */
    public function followupStatus() {
        return $this->belongsTo('App\FollowupStatus', 'action')->select('id', 'title');
    }
}
