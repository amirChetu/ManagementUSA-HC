<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to sales tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Sale extends Model
{
    use SoftDeletes;
    
    protected $fillable = 
    [
        'description',
        'status',
        'cash',
        'credit_cd',
        'credit_cd2',
        'credit_cd3',
        'check',
    ];
    
    /**
    * This function create linking between users table and sales table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }	
    
    /**
    * This function create linking between users table and sales table.
    *
    * @parms void;
    *
    * @return null
    */
    public function seller(){
        return $this->belongsTo('App\User');
    }
    
    /**
    * This function create linking between appointments table and sales table.
    *
    * @parms void;
    *
    * @return null
    */
    public function appt(){
        return $this->belongsTo('App\Appointment');
    }
}
