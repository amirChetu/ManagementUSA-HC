<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to Appointment Reason
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class AppointmentReason extends Model
{
    use SoftDeletes;

    protected $table = 'appointment_reasons';
    protected $fillable = [
        'id',
        'patient_id',
        'reason_id',
        'created_at',
        'updated_at'
    ];
    
    /**
    * This function create linking between users table and appointment_reasons table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }
    
    /**
    * This function create linking between appointments table and appointment_reasons table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointment(){
        return belongsTo('App/Appointment', 'request_id');
    }
    
    /**
    * This function create linking between appointment_requests table and appointment_reasons table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointmentRequest(){
        return $this->belongsTo('App/AppointmentRequest', 'request_id');
    }

    /**
    * hasOne Relationship Method for accessing the Appointment Reason
    *
    * @return QueryBuilder Object
    */
    public function reasonCode()
    {
        return $this->belongsTo('App\ReasonCode', 'reason_id')->select(array('id', 'reason'));
    }
}
