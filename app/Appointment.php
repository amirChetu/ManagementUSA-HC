<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to API Data
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Appointment extends Model {
    use SoftDeletes;

    protected $table = 'appointments';

    protected $fillable = [
        'id',
        'relative_id',
        'apptTime',
        'appt_source',
        'request_id',
        'status',
        'email_invitation',
        'created_by',
        'last_updated_by',
        'patient_id',
        'doctor_id',
        'comment',
        'patient_status',
        'progress_status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
    * This function create linking between user table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }

    /**
    * This function create linking between appointment_requests table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointmentRequest(){
        return $this->belongsTo('App\AppointmentRequest', 'request_id');
    }

    /**
    * This function create linking between followups table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function followup(){
        return $this->hasOne('App\FollowUp', 'appt_id');
    }

    /**
    * This function create linking between lab_reports table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function labReports(){
        return $this->hasMany('App\LabReport', 'appointments_id');
    }

    /**
    * This function create linking between user table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function setter() {
        return $this->belongsTo('App\User', 'marketer');
    }

    /**
    * This function create linking between user table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patient() {
        return $this->belongsTo('App\User', 'patient_id');
    }

    /**
    * This function create linking between user table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function doctor() {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    /**
    * This function create linking between sale table and appointments table.
    *
    * @parms void;
    *
    * @return null
    */
    public function sale() {
        return $this->hasMany('App\Sale', 'appt');
    }

    /**
    * This function is used to delete the appointment from all related tables.
    *
    * @parms void;
    *
    * @return null
    */
    protected static function boot() {
        parent::boot();
        static::deleting(function($appointment) {
            $appointment->followup()->delete();
            $appointment->labReports()->delete();
            $appointment->sale()->delete();
        });
    }
}
