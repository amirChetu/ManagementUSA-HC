<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Appointment Request
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class AppointmentRequest extends Model
{
    use SoftDeletes;
	
    protected $table = 'appointment_requests';

    protected $fillable = [
        'id',
        'user_id',
        'marketing_phone',
        'call_time',
        'comment',
        'created_by',
        'appt_source',
        'followup_date',
        'followup_status',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'noSetStatus'
    ];
    
    /**
    * This function create linking between users table and appointment_requests table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patient() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    /**
    * This function create linking between appointment_request table and appointment_requests table.
    *
    * @parms void;
    *
    * @return null
    */
    public function noSetReason(){
        return $this->hasOne('App\AppointmentReason', 'request_id');
    }   
    
    /**
    * This function create linking between users table and appointment_requests table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }	
    
    /**
    * This function create linking between appointments table and appointment_requests table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointment(){
        return $this->hasOne('App\Appointment', 'request_id');
    }
    
    /**
    * This function create linking between appointment_reasons table and appointment_requests table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointmentReasons(){
        return $this->hasMany('App\AppointmentReason', 'request_id');
    }
    
    /**
    * This function is used to delete all the appointments on the basis of appointment_request_id.
    *
    * @parms void;
    *
    * @return null
    */
    protected static function boot() {
        parent::boot();
        static::deleting(function($appointmentRequest) {	
            $appointmentRequest->appointmentReasons()->delete();

            // check if appointment was set and if so delete the appointment
            if($appointmentRequest->status == 0){			
                $apptReq = Appointment::where('request_id', '=', $appointmentRequest->id)->firstOrFail();
                Appointment::destroy($apptReq->id);
            }
        });
    }
    
    /**
    * This function create linking between locations table and appointment_requests table.
    *
    * @parms void;
    *
    * @return null
    */
    public function locations(){
        return $this->belongsTo('App\Location', 'location_id');
    }
}
