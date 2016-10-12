<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to weight_loss tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class WeightLoss extends Model
{
    use SoftDeletes;
	
    protected $table = 'weight_loss';
    protected $fillable = [
        'id',
        'patient_id',
        'weight_surgeries',
        'surgeries_kind',
        'weight_supplement',
        'supplement_type',
        'liver_disease',
        'diabetes',
        'thyroid_treated',
        'hormone_treated',
        'seizures',
        'kidney_disorder',
        'eating_disorder',
        'frequently_eat',
        'eat_more',
        'created_at',
        'updated_at'	
    ];
    
    /**
    * This function create linking between users table and weight_loss table.
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
