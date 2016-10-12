<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to medical_histories tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class MedicalHistory extends Model
{
    use SoftDeletes;
	
    protected $table = 'medical_histories';
    protected $fillable = [
        'patient_id',
        'cardiovascular',
        'hypertension',
        'enocrine_disorder',
        'prostate',
        'lipid',
        'cancer_form',
        'smoke_status',
        'smoke_often',
        'smoke_quantity',
        'drink_status',
        'drink_often',
        'drink_quantity',
        'activity_level',
        'exercise_status',
        'exercise_often',
        'deficiency_status',
        'chemical_dependency',
        'blood_disorder',
        'orthopedic_disorder',
        'known_deficiency',
        'carpal_syndrome',
        'immune_disorder',
        'heart_disease',
        'lung_disorder',
        'cancer_status',
        'surgeries',
        'renal',
        'upper',
        'allergies',
        'genital',
        'retention',
        'endocrine',
        'hyperlipidema',
        'healing',
        'neurological',
        'emotional',
        'hypertention_hbp',
        'other_illness',
        'rthritis',
        'recreational_drug',
        'blood_test',
        'health_isurance',
        'kind_of_hi',
        'medication',
        'created_at',
        'updated_at'		
    ];
    
    
    /**
    * This function create linking between users table and medical_histories table.
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
