<?php

namespace App;
use App\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientMedicationList extends Model
{
	use SoftDeletes;
	
	protected $table = 'patient_medication_lists';
    protected $fillable = [
		'patient_id',
		'name',
		'dosage',
		'how_often',
		'taken_for'		
	];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
      
}
