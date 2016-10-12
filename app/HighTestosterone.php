<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to high_testosterones tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class HighTestosterone extends Model
{
    use SoftDeletes;
	
    protected $table = 'high_testosterones';
    protected $fillable = [
        'id',
        'patient_id',
        'harmone_therapy',
        'harmone_therapy_type',
        'usa_military',
        'lack_increment',
        'increase_fat',
        'depression',
        'mood_increment',
        'sleep_difficulty',
        'wrinkle_increment',
        'sagging_increment',
        'hot_flash',
        'loss_activity',
        'stess_increment',
        'loss_interest',
        'loose_skin',
        'exercise_ability',
        'memory_decrement',
        'loss_muscle',
        'endurance',
        'muscle_decrement',
        'loss_hair',
        'sense_decrement',
        'testicle_decrement',
        'shrinkage',
        'osteoporosis',
        'intolerance',
        'unexplained_weight',
        'created_at',
        'updated_at'	
    ];
    
    /**
    * This function create linking between users table and high_testosterones table.
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
