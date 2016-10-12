<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to priapus tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Priapus extends Model
{
    use SoftDeletes;
	
    protected $table = 'priapus';
    protected $fillable = [
        'id',
        'patient_id',
        'abnormal',
        'abnormal_type',
        'priapus_goal',
        'prp_before',
        'pump_past',
        'implant_surgery',
        'pre_activity_score',
        'prp_stimulation_score',
        'prp_intercourse_score',
        'prp_maintain_score',
        'prp_difficult_score',
        'created_at',
        'updated_at'	
    ];
    
    /**
    * This function create linking between users table and priapus table.
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
