<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to patient_vitamin_list tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class PatientVitaminList extends Model
{
    use SoftDeletes;

    protected $table = 'patient_vitamin_lists';

    protected $fillable = [
        'patient_id',
        'name',
        'dosage',
        'how_often',
        'taken_for'		
    ];
    
    /**
    * This function create linking between users table and patient_vitamin_list table.
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
