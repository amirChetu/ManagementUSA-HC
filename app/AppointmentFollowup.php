<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Appointment Followup
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class AppointmentFollowup extends Model
{
    use SoftDeletes;
	
    protected $table = 'appointment_followups';
    protected $fillable = [
        'appt_id',
        'reason_id',
        'comment',
        'status'
    ];
    
    /**
    * This function create linking between web_leads table and appointment_followups table.
    *
    * @parms void;
    *
    * @return null
    */
    public function web_lead() {        
        return $this->belongsTo('App\WebLead', 'appt_id');
    }
    
    /**
    * This function create linking between telemarketing_calls table and appointment_followups table.
    *
    * @parms void;
    *
    * @return null
    */
    public function telemarketing() {        
        return $this->belongsTo('App\TelemarketingCall', 'appt_id');
    }

}
