<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to states tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class State extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';
    
    /**
    * This function create linking between user_details table and states table.
    *
    * @parms void;
    *
    * @return null
    */
    public function userState()
    {
        return $this->hasMany('App\UserDetail', 'state');
    }
    
    /**
    * This function create linking between doctor_details table and states table.
    *
    * @parms void;
    *
    * @return null
    */
    public function doctorState()
    {
        return $this->hasMany('App\Doctor', 'state');
    }
    
    /**
    * This function create linking between patient_details table and states table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patientState()
    {
        return $this->hasMany('App\Patient', 'state');
    }
}
