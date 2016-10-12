<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to erectile_dysfunctions tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class ErectileDysfunction extends Model
{
    use SoftDeletes;
	
    protected $table = 'erectile_dysfunctions';
    protected $fillable = [
        'id',
        'patient_id',
        'sex_status',
        'sex_often',
        'sex_with',
        'pronography',
        'prostate_removal',
        'nerve_damage',
        'erectile',
        'implant',
        'penis_pump',
        'recreational',
        'ejaculate',
        'medicine_used',
        'sickle',
        'dwarfing',
        'hiv',
        'sex_medicine',
        'medicine_name',
        'medicine_work',
        'last_used',
        'still_work',
        'side_effect',
        'erection_time',
        'erection_kind',
        'erection_strength',
        'activity_score',
        'stimulation_score',
        'intercourse_score',
        'maintain_score',
        'difficult_score',
        'created_at',
        'updated_at'	
    ];
    
    /**
    * This function create linking between users table and erectile_dysfunctions table.
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
