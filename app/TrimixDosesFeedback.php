<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class is used to handle all the data related to trimix_dose_feedbacks tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class TrimixDosesFeedback extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trimix_dose_feedbacks';
    protected $fillable = [
        'trimix_dose_id',
        'agent_id',
        'time',
        'percentage',
        'pain',
        'antidote',
        'notes'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
    
    /**
    * This function create linking between trimix_doses table and trimix_dose_feedbacks table.
    *
    * @parms void;
    *
    * @return null
    */
    public function trimixDose() 
    {
        return $this->belongsTo('App\TrimixDose', 'trimix_dose_id');
    }
}
