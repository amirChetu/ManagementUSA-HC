<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to AdamsQuestionary.
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class AdamsQuestionary extends Model
{
    use SoftDeletes;

    protected $table = 'adams_questionaires';

    protected $fillable = [
        'patient_id',
        'libido_rate',
        'energy_rate',
        'strength_rate',
        'enjoy_rate',
        'happiness_rate',
        'erection_rate',
        'performance_rate',
        'sleep_rate',
        'sport_rate',
        'lost_height_rate',
        'created_at',
        'updated_at'
    ];
    
    /**
    * This function create linking between user table and adams_questionaires table.
    *
    * @parms void;
    *
    * @return null
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'patient_id');
    }	
}
