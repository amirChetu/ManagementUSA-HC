<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to patient_details tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Patient extends Model {
	
    use SoftDeletes;
	
    protected $table = 'patient_details';
    protected $fillable = [
        'user_id',
        'dob',
        'gender',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'zipCode',
        'image',
        'employer',
        'occupation',
        'marital_status',
        'mobile',
        'call_time',
        'driving_license',
        'employer',
        'height',
        'weight',
        'employment_place',
        'primary_physician',
        'physician_phone',
        'payment_bill',
        'never_treat_status',
        'form_status',
        'location_id',
        'hash'
    ];
    
    /**
    * This function create linking between users table and patient_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
            return $this->belongsTo('App\User', 'user_id');
    }	
    
    /**
    * This function create linking between appointments table and patient_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appointment() {
        return $this->hasOne('App\Appointment', 'patient_id');
    }
    
    /**
    * This function create linking between users table and patient_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patient() {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    /**
    * This function create linking between states table and patient_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patientStateName() {
        return $this->belongsTo('App\State', 'state');
    }
    
    /**
    * This function create linking between locations table and patient_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patientLocationName() {
        return $this->belongsTo('App\Location', 'location_id');
    }
}
