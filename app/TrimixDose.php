<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class is used to handle all the data related to trimix_doses tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class TrimixDose extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trimix_doses';
    protected $fillable = [
        'patient_id',
        'agent_id',
        'dose_type',
        'quantity',
        'doctor',
        'amount1',
        'medicationA1',
        'amount2',
        'medicationA2',
        'amount3',
        'medicationB1',
        'amount4',
        'medicationB2',
        'antidote',
        'dose_start_date',
        'dose_end_date',
        'permanent_dose_status'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
    
    /**
    * This function create linking between users table and trimix_doses table.
    *
    * @parms void;
    *
    * @return null
    */
    public function patient() 
    {
        return $this->belongsTo('App\User', 'patient_id');
    }
    
    /**
    * This function create linking between trimix_doses_feedbacks table and trimix_doses table.
    *
    * @parms void;
    *
    * @return null
    */
    public function trimixFeedback() 
    {
        return $this->hasOne('App\TrimixDosesFeedback', 'trimix_dose_id');
    }
    
}
