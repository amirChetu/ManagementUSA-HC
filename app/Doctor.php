<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to doctor_details tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Doctor extends Model
{
    use SoftDeletes;
	
    protected $table = 'doctor_details';
    protected $fillable =
    [
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
        'specialization'
    ];
    
    /**
    * This function create linking between users table and doctor_details table.
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
    * This function create linking between users table and doctor_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function doctor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    /**
    * This function create linking between states table and doctor_details table.
    *
    * @parms void;
    *
    * @return null
    */
    public function doctorStateName()
    {
        return $this->belongsTo('App\State', 'state');
    }
}
